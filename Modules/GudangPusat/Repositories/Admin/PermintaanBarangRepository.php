<?php

namespace Modules\GudangPusat\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\GudangPusat\Repositories\Admin\Interfaces\PermintaanBarangRepositoryInterface;
use Modules\GudangPusat\Entities\Cabang;
use Modules\GudangPusat\Entities\PermintaanBarang;
use Modules\GudangPusat\Entities\StokBarang;

class PermintaanBarangRepository implements PermintaanBarangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $barangs = (new PermintaanBarang());


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

    public function update(PermintaanBarang $permintaanBarangPusat, $params = [])
    {
        return DB::transaction(function () use ($permintaanBarangPusat, $params) {
            if ($params['status'] == 'sedang-dalam-pengiriman') {
                $stokBarang = StokBarang::where('id_barang', $permintaanBarangPusat->id_barang)->firstOrFail();
                $stokBarang->update([
                    'stok' => $stokBarang->stok - $permintaanBarangPusat->jumlah
                ]);
            }
            return $permintaanBarangPusat->update([
                'status' => str_replace('-', ' ', $params['status'])
            ]);
        });
    }
}
