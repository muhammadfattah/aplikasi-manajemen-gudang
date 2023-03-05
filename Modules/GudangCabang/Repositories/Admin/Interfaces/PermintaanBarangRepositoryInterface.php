<?php

namespace Modules\GudangCabang\Repositories\Admin\Interfaces;

use Modules\GudangCabang\Entities\PermintaanBarang;

interface PermintaanBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanBarang $supplier, $params = []);
}
