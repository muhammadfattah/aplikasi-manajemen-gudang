<?php

namespace Modules\GudangPusat\Repositories\Admin\Interfaces;

use Modules\GudangPusat\Entities\Barang;
use Modules\GudangPusat\Entities\StokBarang;

interface StokBarangRepositoryInterface
{
    public function findAll($options = []);
    public function findAllInTrash($options = []);
    public function findById($id);
    public function findStokBarangById($id);
    public function create($params = []);
    public function update(Barang $supplier, $params = []);
    public function updateStok(StokBarang $supplier, $params = []);
    public function delete($id, $permanentDelete = false);
    public function restore($id);
    public function getListSupplier();
    public function getListKategori();
}
