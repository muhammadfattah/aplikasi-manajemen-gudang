<?php

namespace Modules\Outlet\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;

use Modules\Outlet\Repositories\Admin\Interfaces\ReturBarangRepositoryInterface;
use Modules\Outlet\Entities\Outlet;
use Modules\Outlet\Entities\PermintaanReturCabang;
use Modules\Outlet\Entities\StokBarang;

class ReturBarangRepository implements ReturBarangRepositoryInterface
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

        $barangs = (new PermintaanReturCabang())->where('id_outlet', $idOutlet);


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
        return PermintaanReturCabang::where('id', $id)
            ->firstOrFail();
    }

    public function update(PermintaanReturCabang $permintaanBarangPusat, $params = [])
    {
        return DB::transaction(function () use ($permintaanBarangPusat, $params) {
            $stokBarang = StokBarang::where('id_outlet', $permintaanBarangPusat->id_outlet)->where('id_barang', $permintaanBarangPusat->id_barang)->first();
            if ($stokBarang) {
                $stokBarang->update([
                    'stok' => $stokBarang->stok - $permintaanBarangPusat->jumlah
                ]);
            } else {
                StokBarang::create([
                    'id_outlet' => $permintaanBarangPusat->id_outlet,
                    'id_barang' => $permintaanBarangPusat->id_barang,
                    'stok'      => 0 - $permintaanBarangPusat->jumlah
                ]);
            }
            return $permintaanBarangPusat->update([
                'status' => 'sedang dalam pengiriman'
            ]);
        });
    }
}
