<?php

namespace Modules\Outlet\Repositories\Admin\Interfaces;

use Modules\Outlet\Entities\PermintaanBarangCabang;

interface OrderBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanBarangCabang $supplier, $params = []);
}
