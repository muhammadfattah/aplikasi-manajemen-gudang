<?php

namespace Modules\GudangPusat\Repositories\Admin\Interfaces;

use Modules\GudangPusat\Entities\PermintaanBarang;

interface PermintaanBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanBarang $supplier, $params = []);
}
