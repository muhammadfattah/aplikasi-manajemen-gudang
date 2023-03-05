<?php

namespace Modules\GudangPusat\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\GudangPusat\Repositories\Admin\Interfaces\PermintaanReturRepositoryInterface;
use Modules\GudangPusat\Entities\PermintaanRetur;
use Modules\GudangPusat\Entities\StokBarang;

class PermintaanReturRepository implements PermintaanReturRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $barangs = (new PermintaanRetur());


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

    public function update(PermintaanRetur $permintaanReturPusat, $params = [])
    {
        return DB::transaction(function () use ($permintaanReturPusat, $params) {
            if ($params['status'] == 'selesai') {
                $stokRetur = StokBarang::where('id_barang', $permintaanReturPusat->id_barang)->firstOrFail();
                $stokRetur->update([
                    'stok' => $stokRetur->stok + $permintaanReturPusat->jumlah
                ]);
            }
            return $permintaanReturPusat->update([
                'status' => str_replace('-', ' ', $params['status'])
            ]);
        });
    }
}
