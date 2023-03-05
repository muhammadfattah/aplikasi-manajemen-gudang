<?php

namespace Modules\Outlet\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\Outlet\Entities\Outlet;
use Modules\Outlet\Repositories\Admin\Interfaces\OrderBarangRepositoryInterface;
use Modules\Outlet\Entities\PermintaanBarangCabang;
use Modules\Outlet\Entities\StokBarang;

class OrderBarangRepository implements OrderBarangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $idOutlet = '';
        if (!auth()->user()->hasRole(Role::ADMIN)) {
            if (auth()->user()->hasRole(Role::SUPERVISOROUTLET)) {
                $idOutlet = Outlet::where('id_supervisor', auth()->user()->id)->firstOrFail()->id ?? '';
            }
        }

        $barangs = (new PermintaanBarangCabang())->where('id_outlet', $idOutlet);


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
        return PermintaanBarangCabang::where('id', $id)
            ->firstOrFail();
    }

    public function update(PermintaanBarangCabang $permintaanBarangPusat, $params = [])
    {
        return DB::transaction(function () use ($permintaanBarangPusat, $params) {
            $stokBarang = StokBarang::where('id_outlet', $permintaanBarangPusat->id_outlet)->where('id_barang', $permintaanBarangPusat->id_barang)->first();
            if ($stokBarang) {
                $stokBarang->update([
                    'stok' => $stokBarang->stok + $permintaanBarangPusat->jumlah
                ]);
            } else {
                StokBarang::create([
                    'id_outlet' => $permintaanBarangPusat->id_outlet,
                    'id_barang' => $permintaanBarangPusat->id_barang,
                    'stok'      => $permintaanBarangPusat->jumlah
                ]);
            }
            return $permintaanBarangPusat->update([
                'status' => 'selesai'
            ]);
        });
    }
}
