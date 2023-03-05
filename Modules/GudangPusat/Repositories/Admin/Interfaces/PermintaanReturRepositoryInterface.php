<?php

namespace Modules\GudangPusat\Repositories\Admin\Interfaces;

use Modules\GudangPusat\Entities\PermintaanRetur;

interface PermintaanReturRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanRetur $supplier, $params = []);
}
