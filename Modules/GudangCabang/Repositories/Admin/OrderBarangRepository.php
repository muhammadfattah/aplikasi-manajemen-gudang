<?php

namespace Modules\GudangCabang\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\GudangCabang\Entities\HistoryGudangCabang;
use Modules\GudangCabang\Entities\KategoriBarang;
use Modules\GudangCabang\Entities\OrderBarang;
use Modules\GudangCabang\Entities\Supplier;
use Modules\GudangCabang\Repositories\Admin\Interfaces\OrderBarangRepositoryInterface;
use Modules\GudangCabang\Entities\Barang;
use Modules\GudangCabang\Entities\Cabang;
use Modules\GudangCabang\Entities\PermintaanBarangPusat;
use Modules\GudangCabang\Entities\StokBarang;

class OrderBarangRepository implements OrderBarangRepositoryInterface
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

        $barangs = (new PermintaanBarangPusat())->where('id_cabang', $idCabang);


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
        return PermintaanBarangPusat::where('id', $id)
            ->firstOrFail();
    }

    public function update(PermintaanBarangPusat $permintaanBarangPusat, $params = [])
    {
        return DB::transaction(function () use ($permintaanBarangPusat, $params) {
            $stokBarang = StokBarang::where('id_cabang', $permintaanBarangPusat->id_cabang)->where('id_barang', $permintaanBarangPusat->id_barang)->first();
            if ($stokBarang) {
                $stokBarang->update([
                    'stok' => $stokBarang->stok + $permintaanBarangPusat->jumlah
                ]);
            } else {
                StokBarang::create([
                    'id_cabang' => $permintaanBarangPusat->id_cabang,
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
