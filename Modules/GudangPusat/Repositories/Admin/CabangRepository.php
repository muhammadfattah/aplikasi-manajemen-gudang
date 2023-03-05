<?php

namespace Modules\GudangPusat\Repositories\Admin;

use App\Models\Role;
use App\Models\User;
use Facades\Str;
use DB;
use Modules\GudangPusat\Entities\Cabang;
use Modules\GudangPusat\Repositories\Admin\Interfaces\CabangRepositoryInterface;

class CabangRepository implements CabangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $cabangs = (new Cabang())->with('manajer')->with('admin');

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $cabangs = $cabangs->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $cabangs = $cabangs->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $cabangs->paginate($perPage);
        }

        return $cabangs->get();
    }

    public function findAllInTrash($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $cabangs = (new Cabang())->onlyTrashed();

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $cabangs = $cabangs->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $cabangs = $cabangs->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $cabangs->paginate($perPage);
        }

        return $cabangs->get();
    }

    public function findById($id)
    {
        return Cabang::where('id', $id)
            ->firstOrFail();
    }

    public function create($params = [])
    {
        return DB::transaction(function () use ($params) {
            if ($cabang = Cabang::create($params)) {
                return $cabang;
            }
        });
    }

    public function update(Cabang $cabang, $params = [])
    {
        return DB::transaction(function () use ($cabang, $params) {
            return $cabang->update($params);
        });
    }

    public function delete($id, $permanentDelete = false)
    {
        $cabang  = Cabang::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        return DB::transaction(function () use ($cabang, $permanentDelete) {
            if ($permanentDelete) {
                return $cabang->forceDelete();
            }

            return $cabang->delete();
        });
    }

    public function restore($id)
    {
        $cabang  = Cabang::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        if ($cabang->trashed()) {
            return $cabang->restore();
        }

        return false;
    }

    public function getListManajerCabang()
    {
        $manajerCabang = (new User())->whereHas('roles', function ($query) {
            $query->where('name', Role::MANAJERCABANG);
        })->get();

        $list = [];
        foreach ($manajerCabang as $m) {
            $list[$m->id] = $m->name;
        }
        return $list;
    }

    public function getListAdminCabang()
    {
        $adminCabang = (new User())->whereHas('roles', function ($query) {
            $query->where('name', Role::ADMINCABANG);
        })->get();
        $list = [];
        foreach ($adminCabang as $a) {
            $list[$a->id] = $a->name;
        }
        return $list;
    }
}
