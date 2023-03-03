<?php

namespace Modules\GudangPusat\Repositories\Admin;

use App\Models\User;
use Facades\Str;
use DB;
use Modules\GudangPusat\Entities\Cabang;
use Modules\GudangPusat\Entities\Outlet;
use Modules\GudangPusat\Repositories\Admin\Interfaces\OutletRepositoryInterface;

class OutletRepository implements OutletRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $outlets = (new Outlet())->with('supervisor')->with('cabang');

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $outlets = $outlets->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $outlets = $outlets->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $outlets->paginate($perPage);
        }

        return $outlets->get();
    }

    public function findAllInTrash($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $outlets = (new Outlet())->onlyTrashed();

        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $outlets = $outlets->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $outlets = $outlets->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $outlets->paginate($perPage);
        }

        return $outlets->get();
    }

    public function findById($id)
    {
        return Outlet::where('id', $id)
            ->firstOrFail();
    }

    public function create($params = [])
    {
        return DB::transaction(function () use ($params) {
            if ($outlet = Outlet::create($params)) {
                return $outlet;
            }
        });
    }

    public function update(Outlet $outlet, $params = [])
    {
        return DB::transaction(function () use ($outlet, $params) {
            return $outlet->update($params);
        });
    }

    public function delete($id, $permanentDelete = false)
    {
        $outlet  = Outlet::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        return DB::transaction(function () use ($outlet, $permanentDelete) {
            if ($permanentDelete) {
                return $outlet->forceDelete();
            }

            return $outlet->delete();
        });
    }

    public function restore($id)
    {
        $outlet  = Outlet::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        if ($outlet->trashed()) {
            return $outlet->restore();
        }

        return false;
    }

    public function getListSupervisorOutlet()
    {
        $manajerOutlet = (new User())->whereHas('roles', function ($query) {
            $query->where('name', 'Supervisor Outlet');
        })->get();

        $list = [];
        foreach ($manajerOutlet as $m) {
            $list[$m->id] = $m->name;
        }
        return $list;
    }

    public function getListCabang()
    {
        $outlet = Cabang::all();

        $list = [];
        foreach ($outlet as $m) {
            $list[$m->id] = $m->nama . ' - ' . $m->lokasi;
        }
        return $list;
    }
}
