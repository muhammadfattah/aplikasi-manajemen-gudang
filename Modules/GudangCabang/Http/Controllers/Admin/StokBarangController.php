<?php

namespace Modules\GudangCabang\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangCabang\Entities\Barang;
use Modules\GudangCabang\Http\Controllers\GudangCabangController;
use Modules\GudangCabang\Http\Requests\Admin\BarangRequest;
use Modules\GudangCabang\Http\Requests\Admin\StokBarangRequest;
use Modules\GudangCabang\Http\Requests\Admin\StokBarangReturRequest;
use Modules\GudangCabang\Repositories\Admin\Interfaces\StokBarangRepositoryInterface;

class StokBarangController extends GudangCabangController
{
    // use Authorizable;

    private $stokbarangRepository;

    public function __construct(StokBarangRepositoryInterface $stokbarangRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'stok barang';

        $this->stokbarangRepository = $stokbarangRepository;

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

        $this->data['id_cabang'] = $this->stokbarangRepository->getIDCabang();
        $this->data['stokbarangs'] = $this->stokbarangRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('gudangcabang::admin.stokbarang.index', $this->data);
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $stokbarang = $this->stokbarangRepository->findById($id);
        $this->data['listKategori'] = $this->stokbarangRepository->getListKategori();
        $this->data['stokbarang'] = $stokbarang;

        return view('gudangcabang::admin.stokbarang.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StokBarangRequest $request, $id)
    {
        $barang = $this->stokbarangRepository->findById($id);
        $params = $request->validated();

        if ($this->stokbarangRepository->update($barang, $params)) {
            return redirect('admin/gudang-cabang/stok-barang')
                ->with('success', 'Order barang berhasil');
        }

        return redirect('admin/gudang-cabang/stok-barang/' . $id . '/edit')
            ->with('error', 'Order barang gagal');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */

    public function retur($id)
    {
        $stokbarang = $this->stokbarangRepository->findById($id);
        $this->data['listKategori'] = $this->stokbarangRepository->getListKategori();
        $this->data['stokbarang'] = $stokbarang;

        return view('gudangcabang::admin.stokbarang.form_retur', $this->data);
    }

    public function update_retur(StokBarangReturRequest $request, $id)
    {
        $barang = $this->stokbarangRepository->findById($id);
        $params = $request->validated();

        if ($this->stokbarangRepository->update_retur($barang, $params)) {
            return redirect('admin/gudang-cabang/stok-barang')
                ->with('success', 'Retur barang berhasil');
        }

        return redirect('admin/gudang-cabang/stok-barang/' . $id . '/retur')
            ->with('error', 'Retur barang gagal');
    }
}
