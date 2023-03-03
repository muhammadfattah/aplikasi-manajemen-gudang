<?php

namespace Modules\GudangPusat\Repositories\Admin\Interfaces;

use Modules\GudangPusat\Entities\Supplier;

interface SupplierRepositoryInterface
{
    public function findAll($options = []);
    public function findAllInTrash($options = []);
    public function findById($id);
    public function create($params = []);
    public function update(Supplier $supplier, $params = []);
    public function delete($id, $permanentDelete = false);
    public function restore($id);
}
