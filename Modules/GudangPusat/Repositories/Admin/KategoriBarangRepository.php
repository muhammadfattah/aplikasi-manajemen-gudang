<?php

namespace Modules\GudangPusat\Repositories\Admin;

use Facades\Str;
use DB;
use Modules\GudangPusat\Entities\KategoriBarang;
use Modules\GudangPusat\Repositories\Admin\Interfaces\KategoriBarangRepositoryInterface;

class KategoriBarangRepository implements KategoriBarangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suppliers = (new KategoriBarang());

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $suppliers = $suppliers->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $suppliers = $suppliers->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $suppliers->paginate($perPage);
        }

        return $suppliers->get();
    }

    public function findAllInTrash($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $suppliers = (new KategoriBarang())->onlyTrashed();

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $suppliers = $suppliers->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $suppliers = $suppliers->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $suppliers->paginate($perPage);
        }

        return $suppliers->get();
    }

    public function findById($id)
    {
        return KategoriBarang::where('id', $id)
            ->firstOrFail();
    }

    public function create($params = [])
    {
        return DB::transaction(function () use ($params) {
            if ($supplier = KategoriBarang::create($params)) {
                return $supplier;
            }
        });
    }

    public function update(KategoriBarang $supplier, $params = [])
    {
        return DB::transaction(function () use ($supplier, $params) {
            return $supplier->update($params);
        });
    }

    public function delete($id, $permanentDelete = false)
    {
        $supplier  = KategoriBarang::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        return DB::transaction(function () use ($supplier, $permanentDelete) {
            if ($permanentDelete) {
                return $supplier->forceDelete();
            }

            return $supplier->delete();
        });
    }

    public function restore($id)
    {
        $supplier  = KategoriBarang::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        if ($supplier->trashed()) {
            return $supplier->restore();
        }

        return false;
    }
}
