<?php

namespace Modules\GudangCabang\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;

use Modules\GudangCabang\Repositories\Admin\Interfaces\ReturBarangRepositoryInterface;
use Modules\GudangCabang\Entities\Cabang;
use Modules\GudangCabang\Entities\PermintaanReturPusat;
use Modules\GudangCabang\Entities\StokBarang;

class ReturBarangRepository implements ReturBarangRepositoryInterface
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

        $barangs = (new PermintaanReturPusat())->where('id_cabang', $idCabang);


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
        return PermintaanReturPusat::where('id', $id)
            ->firstOrFail();
    }

    public function update(PermintaanReturPusat $permintaanBarangPusat, $params = [])
    {
        return DB::transaction(function () use ($permintaanBarangPusat, $params) {
            $stokBarang = StokBarang::where('id_cabang', $permintaanBarangPusat->id_cabang)->where('id_barang', $permintaanBarangPusat->id_barang)->first();
            if ($stokBarang) {
                $stokBarang->update([
                    'stok' => $stokBarang->stok - $permintaanBarangPusat->jumlah
                ]);
            } else {
                StokBarang::create([
                    'id_cabang' => $permintaanBarangPusat->id_cabang,
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
