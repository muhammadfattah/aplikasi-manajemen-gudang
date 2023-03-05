<?php

namespace Modules\GudangCabang\Repositories\Admin\Interfaces;

use Modules\GudangCabang\Entities\OrderBarang;
use Modules\GudangCabang\Entities\Barang;
use Modules\GudangCabang\Entities\PermintaanBarangPusat;

interface OrderBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(PermintaanBarangPusat $supplier, $params = []);
}
