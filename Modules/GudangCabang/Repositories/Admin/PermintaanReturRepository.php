<?php

namespace Modules\GudangCabang\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\GudangCabang\Entities\Cabang;
use Modules\GudangCabang\Entities\Outlet;
use Modules\GudangCabang\Repositories\Admin\Interfaces\PermintaanReturRepositoryInterface;
use Modules\GudangCabang\Entities\PermintaanRetur;
use Modules\GudangCabang\Entities\StokBarang;

class PermintaanReturRepository implements PermintaanReturRepositoryInterface
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
        $barangs = (new PermintaanRetur())->where('id_outlet', $idOutlet);

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
        return PermintaanRetur::where('id', $id)
            ->firstOrFail();
    }

    public function update(PermintaanRetur $permintaanReturCabang, $params = [])
    {
        return DB::transaction(function () use ($permintaanReturCabang, $params) {
            if ($params['status'] == 'selesai') {
                $outlet = Outlet::where('id', $permintaanReturCabang->id_outlet)->firstOrFail();
                $stokRetur = StokBarang::where('id_cabang', $outlet->id_cabang)->where('id_barang', $permintaanReturCabang->id_barang)->firstOrFail();
                $stokRetur->update([
                    'stok' => $stokRetur->stok + $permintaanReturCabang->jumlah
                ]);
            }
            return $permintaanReturCabang->update([
                'status' => str_replace('-', ' ', $params['status'])
            ]);
        });
    }
}
