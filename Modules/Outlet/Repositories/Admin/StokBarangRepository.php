<?php

namespace Modules\Outlet\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\Outlet\Entities\KategoriBarang;
use Modules\Outlet\Repositories\Admin\Interfaces\StokBarangRepositoryInterface;
use Modules\Outlet\Entities\Barang;
use Modules\Outlet\Entities\Outlet;
use Modules\Outlet\Entities\PermintaanBarangCabang;
use Modules\Outlet\Entities\PermintaanReturCabang;

class StokBarangRepository implements StokBarangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $barangs = (new Barang())->with('stok');


        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $barangs = $barangs->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $barangs = $barangs->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $barangs->paginate($perPage);
        }

        return $barangs->get();
    }

    public function findById($id)
    {
        return Barang::where('id', $id)
            ->firstOrFail();
    }

    public function update(Barang $barang, $params = [])
    {
        return DB::transaction(function () use ($barang, $params) {
            $idOutlet = '';
            if (!auth()->user()->hasRole(Role::ADMIN)) {
                if (auth()->user()->hasRole(Role::SUPERVISOROUTLET)) {
                    $idOutlet = Outlet::where('id_supervisor', auth()->user()->id)->firstOrFail()->id ?? '';
                }
            }
            $permintaan = PermintaanBarangCabang::create([
                'id_barang' => $barang->id,
                'id_outlet' => $idOutlet,
                'jumlah'    => $params['jumlah_order'],
                'status'    => 'menunggu konfirmasi'
            ]);
            return $permintaan;
        });
    }

    public function update_retur(Barang $barang, $params = [])
    {
        return DB::transaction(function () use ($barang, $params) {
            $idOutlet = '';
            if (!auth()->user()->hasRole(Role::ADMIN)) {
                if (auth()->user()->hasRole(Role::SUPERVISOROUTLET)) {
                    $idOutlet = Outlet::where('id_supervisor', auth()->user()->id)->firstOrFail()->id ?? '';
                }
            }
            $permintaan = PermintaanReturCabang::create([
                'id_barang' => $barang->id,
                'id_outlet' => $idOutlet,
                'jumlah'    => $params['jumlah_retur'],
                'status'    => 'menunggu konfirmasi'
            ]);
            return $permintaan;
        });
    }

    public function getListKategori()
    {
        $kategori = KategoriBarang::all();
        $list = [];
        foreach ($kategori as $a) {
            $list[$a->id] = $a->nama;
        }
        return $list;
    }

    public function getIDOutlet()
    {
        $idOutlet = '';
        if (!auth()->user()->hasRole(Role::ADMIN)) {
            if (auth()->user()->hasRole(Role::SUPERVISOROUTLET)) {
                $idOutlet = Outlet::where('id_supervisor', auth()->user()->id)->firstOrFail()->id ?? '';
            } else {
                $idOutlet = '';
            }
        }
        return $idOutlet;
    }
}
