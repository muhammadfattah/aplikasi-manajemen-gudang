<?php

namespace Modules\GudangCabang\Repositories\Admin\Interfaces;

use Modules\GudangCabang\Entities\PermintaanReturPusat;

interface ReturBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanReturPusat $supplier, $params = []);
}
