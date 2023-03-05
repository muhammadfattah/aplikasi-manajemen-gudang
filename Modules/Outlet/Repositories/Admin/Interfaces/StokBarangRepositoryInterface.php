<?php

namespace Modules\Outlet\Repositories\Admin\Interfaces;

use Modules\Outlet\Entities\Barang;

interface StokBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function update(Barang $supplier, $params = []);
    public function update_retur(Barang $supplier, $params = []);
    public function getListKategori();
    public function getIDOutlet();
}
