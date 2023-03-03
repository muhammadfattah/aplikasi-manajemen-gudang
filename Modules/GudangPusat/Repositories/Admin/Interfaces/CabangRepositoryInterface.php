<?php

namespace Modules\GudangPusat\Repositories\Admin\Interfaces;

use Modules\GudangPusat\Entities\Cabang;

interface CabangRepositoryInterface
{
    public function findAll($options = []);
    public function findAllInTrash($options = []);
    public function findById($id);
    public function create($params = []);
    public function update(Cabang $supplier, $params = []);
    public function delete($id, $permanentDelete = false);
    public function restore($id);
    public function getListManajerCabang();
    public function getListAdminCabang();
}
