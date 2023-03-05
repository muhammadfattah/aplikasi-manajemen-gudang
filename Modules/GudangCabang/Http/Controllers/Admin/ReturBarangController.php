<?php

namespace Modules\GudangCabang\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangCabang\Http\Controllers\GudangCabangController;
use Modules\GudangCabang\Repositories\Admin\Interfaces\ReturBarangRepositoryInterface;

class ReturBarangController extends GudangCabangController
{
    // use Authorizable;

    private $returbarangRepository;

    public function __construct(ReturBarangRepositoryInterface $returbarangRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'order barang';

        $this->returbarangRepository = $returbarangRepository;

        $this->data['viewTrash'] = false;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $options = [
            'per_page' => $this->perPage,
            'order' => [
                'created_at' => 'desc',
            ],
            'filter' => $params,
        ];

        $this->data['returbarangs'] = $this->returbarangRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('gudangcabang::admin.returbarang.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $barang = $this->returbarangRepository->findById($id);
        if ($this->returbarangRepository->update($barang, [])) {
            return redirect('admin/gudang-cabang/stok-barang')
                ->with('success', 'Status retur barang berhasil diubah');
        }

        return redirect('admin/gudang-cabang/stok-barang')
            ->with('error', 'Status retur barang berhasil diubah');
    }
}
