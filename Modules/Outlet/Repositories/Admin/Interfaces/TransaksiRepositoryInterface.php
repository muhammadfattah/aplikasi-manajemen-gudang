<?php

namespace Modules\Outlet\Repositories\Admin\Interfaces;

interface TransaksiRepositoryInterface
{
    public function findAll($options = []);
    public function findById($id);
    public function create($params = []);
    public function getListBarang();
}
