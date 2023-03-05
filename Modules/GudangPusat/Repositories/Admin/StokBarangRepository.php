<?php

namespace Modules\GudangPusat\Repositories\Admin;

use Facades\Str;
use DB;
use Modules\GudangPusat\Entities\Barang;
use Modules\GudangPusat\Entities\HistoryGudangPusat;
use Modules\GudangPusat\Entities\KategoriBarang;
use Modules\GudangPusat\Entities\StokBarang;
use Modules\GudangPusat\Entities\Supplier;
use Modules\GudangPusat\Repositories\Admin\Interfaces\StokBarangRepositoryInterface;

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

    public function findAllInTrash($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $barangs = (new Barang())->onlyTrashed()->with('stok');

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

    public function findStokBarangById($id)
    {
        return StokBarang::where('id_barang', $id)
            ->firstOrFail();
    }

    public function create($params = [])
    {
        return DB::transaction(function () use ($params) {
            if ($barang = Barang::create($params)) {
                StokBarang::create([
                    'id_barang' => $barang->id,
                    'stok'      => 0
                ]);
                return $barang;
            }
        });
    }

    public function update(Barang $barang, $params = [])
    {
        return DB::transaction(function () use ($barang, $params) {
            return $barang->update($params);
        });
    }

    public function updateStok(StokBarang $stokbarang, $params = [])
    {
        return DB::transaction(function () use ($stokbarang, $params) {
            $jumlahStok = $stokbarang->stok + $params['jumlah_stok'];

            HistoryGudangPusat::create([
                'id_barang'   => $stokbarang->id_barang,
                'id_supplier' => $params['id_supplier'],
                'jumlah'      => $jumlahStok,
            ]);

            return $stokbarang->update([
                'stok' => $jumlahStok
            ]);
        });
    }

    public function delete($id, $permanentDelete = false)
    {
        $barang  = Barang::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        return DB::transaction(function () use ($barang, $permanentDelete) {
            if ($permanentDelete) {
                return $barang->forceDelete();
            }

            return $barang->delete();
        });
    }

    public function restore($id)
    {
        $barang  = Barang::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        if ($barang->trashed()) {
            return $barang->restore();
        }

        return false;
    }

    public function getListSupplier()
    {
        $supplier = Supplier::all();
        $list = [];
        foreach ($supplier as $a) {
            $list[$a->id] = $a->nama;
        }
        return $list;
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
}
