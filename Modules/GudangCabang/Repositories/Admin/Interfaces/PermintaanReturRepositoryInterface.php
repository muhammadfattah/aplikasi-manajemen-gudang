<?php

namespace Modules\GudangCabang\Repositories\Admin\Interfaces;

use Modules\GudangCabang\Entities\PermintaanRetur;

interface PermintaanReturRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanRetur $supplier, $params = []);
}
