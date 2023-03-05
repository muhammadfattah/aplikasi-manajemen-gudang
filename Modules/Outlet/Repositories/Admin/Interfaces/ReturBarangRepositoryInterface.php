<?php

namespace Modules\Outlet\Repositories\Admin\Interfaces;

use Modules\Outlet\Entities\PermintaanReturCabang;

interface ReturBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanReturCabang $supplier, $params = []);
}
