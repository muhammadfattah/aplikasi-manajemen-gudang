<?php

namespace Modules\GudangCabang\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\GudangCabang\Entities\Cabang;
use Modules\GudangCabang\Entities\Outlet;
use Modules\GudangCabang\Repositories\Admin\Interfaces\PermintaanBarangRepositoryInterface;
use Modules\GudangCabang\Entities\PermintaanBarang;
use Modules\GudangCabang\Entities\StokBarang;

class PermintaanBarangRepository implements PermintaanBarangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $idCabang = '';
        if (!auth()->user()->hasRole(Role::ADMIN)) {
            if (auth()->user()->hasRole(Role::MANAJERCABANG)) {
                $idCabang = Cabang::where('id_manajer', auth()->user()->id)->firstOrFail()->id ?? '';
            } else if (auth()->user()->hasRole(Role::ADMINCABANG)) {
                $idCabang = Cabang::where('id_admin', auth()->user()->id)->firstOrFail()->id ?? '';
            }
        }
        $idOutlet = Outlet::whereHas('cabang', function ($query) use ($idCabang) {
            return $query->where('id_cabang', $idCabang);
        })->first()->id ?? '';
        $barangs = (new PermintaanBarang())->where('id_outlet', $idOutlet);


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
        return PermintaanBarang::where('id', $id)
            ->firstOrFail();
    }

    public function update(PermintaanBarang $permintaanBarangCabang, $params = [])
    {
        return DB::transaction(function () use ($permintaanBarangCabang, $params) {
            if ($params['status'] == 'sedang-dalam-pengiriman') {
                $outlet = Outlet::where('id', $permintaanBarangCabang->id_outlet)->firstOrFail();
                $stokBarang = StokBarang::where('id_cabang', $outlet->id_cabang)->where('id_barang', $permintaanBarangCabang->id_barang)->firstOrFail();
                $stokBarang->update([
                    'stok' => $stokBarang->stok - $permintaanBarangCabang->jumlah
                ]);
            }
            return $permintaanBarangCabang->update([
                'status' => str_replace('-', ' ', $params['status'])
            ]);
        });
    }
}
