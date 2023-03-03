<?php

namespace Modules\GudangPusat\Repositories\Admin\Interfaces;

use Modules\GudangPusat\Entities\Outlet;

interface OutletRepositoryInterface
{
    public function findAll($options = []);
    public function findAllInTrash($options = []);
    public function findById($id);
    public function create($params = []);
    public function update(Outlet $supplier, $params = []);
    public function delete($id, $permanentDelete = false);
    public function restore($id);
    public function getListSupervisorOutlet();
    public function getListCabang();
}
