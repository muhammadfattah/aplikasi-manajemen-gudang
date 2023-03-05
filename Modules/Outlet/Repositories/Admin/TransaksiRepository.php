<?php

namespace Modules\Outlet\Repositories\Admin;

use App\Models\Role;
use App\Models\User;
use Facades\Str;
use DB;
use Modules\Outlet\Entities\Barang;
use Modules\Outlet\Entities\Outlet;
use Modules\Outlet\Entities\StokBarang;
use Modules\Outlet\Entities\Transaksi;
use Modules\Outlet\Repositories\Admin\Interfaces\TransaksiRepositoryInterface;

class TransaksiRepository implements TransaksiRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $idOutlet = '';
        if (!auth()->user()->hasRole(Role::ADMIN)) {
            if (auth()->user()->hasRole(Role::SUPERVISOROUTLET)) {
                $idOutlet = Outlet::where('id_supervisor', auth()->user()->id)->first()->id ?? '';
            }
        }

        $transaksis = (new Transaksi())->where('id_outlet', $idOutlet);

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $transaksis = $transaksis->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $transaksis = $transaksis->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $transaksis->paginate($perPage);
        }

        return $transaksis->get();
    }

    public function findById($id)
    {
        return Transaksi::where('id', $id)
            ->firstOrFail();
    }

    public function create($params = [])
    {
        return DB::transaction(function () use ($params) {
            $idOutlet = '';
            if (!auth()->user()->hasRole(Role::ADMIN)) {
                if (auth()->user()->hasRole(Role::SUPERVISOROUTLET)) {
                    $idOutlet = Outlet::where('id_supervisor', auth()->user()->id)->first()->id ?? '';
                }
            }
            $stokBarang = StokBarang::where('id_outlet', $idOutlet)->where('id_barang', $params['id_barang'])->first();
            if ($stokBarang) {
                $stokBarang->update([
                    'stok' => $stokBarang->stok - $params['jumlah']
                ]);
            } else {
                StokBarang::create([
                    'id_outlet' => $idOutlet,
                    'id_barang' => $params['id_barang'],
                    'stok'      => 0 - $params['jumlah']
                ]);
            }
            if ($transaksi = Transaksi::create([
                'id_barang' => $params['id_barang'],
                'id_outlet' => $idOutlet,
                'jumlah'    => $params['jumlah'],
            ])) {
                return $transaksi;
            }
        });
    }

    public function getListBarang()
    {
        $barang = Barang::all();
        $list = [];
        foreach ($barang as $a) {
            $list[$a->id] = $a->nama;
        }
        return $list;
    }
}
