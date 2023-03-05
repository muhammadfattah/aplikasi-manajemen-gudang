<?php

namespace Modules\GudangPusat\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangPusat\Http\Controllers\GudangPusatController;
use Modules\GudangPusat\Repositories\Admin\Interfaces\PermintaanBarangRepositoryInterface;

class PermintaanBarangController extends GudangPusatController
{
    // use Authorizable;

    private $permintaanbarangRepository;

    public function __construct(PermintaanBarangRepositoryInterface $permintaanbarangRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'permintaan barang';

        $this->permintaanbarangRepository = $permintaanbarangRepository;

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
            'permintaan' => [
                'created_at' => 'desc',
            ],
            'filter' => $params,
        ];

        $this->data['permintaanbarangs'] = $this->permintaanbarangRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('gudangpusat::admin.permintaanbarang.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $status = $request->status;
        if ($status == '') {
            return redirect('admin/gudang-pusat/permintaan-order')
                ->with('error', 'Status permintaan order berhasil diubah');
        }
        $barang = $this->permintaanbarangRepository->findById($id);

        if ($this->permintaanbarangRepository->update($barang, ['status' => $status])) {
            return redirect('admin/gudang-pusat/permintaan-order')
                ->with('success', 'Status permintaan order berhasil diubah');
        }

        return redirect('admin/gudang-pusat/permintaan-order')
            ->with('error', 'Status permintaan order berhasil diubah');
    }
}
