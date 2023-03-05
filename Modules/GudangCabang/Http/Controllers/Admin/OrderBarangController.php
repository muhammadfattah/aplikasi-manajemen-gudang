<?php

namespace Modules\GudangCabang\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangCabang\Entities\Barang;
use Modules\GudangCabang\Http\Controllers\GudangCabangController;
use Modules\GudangCabang\Http\Requests\Admin\BarangRequest;
use Modules\GudangCabang\Http\Requests\Admin\OrderBarangRequest;
use Modules\GudangCabang\Repositories\Admin\Interfaces\OrderBarangRepositoryInterface;

class OrderBarangController extends GudangCabangController
{
    // use Authorizable;

    private $orderbarangRepository;

    public function __construct(OrderBarangRepositoryInterface $orderbarangRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'order barang';

        $this->orderbarangRepository = $orderbarangRepository;

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

        $this->data['orderbarangs'] = $this->orderbarangRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('gudangcabang::admin.orderbarang.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $barang = $this->orderbarangRepository->findById($id);

        if ($this->orderbarangRepository->update($barang, [])) {
            return redirect('admin/gudang-cabang/stok-barang')
                ->with('success', 'Status Order barang berhasil diubah');
        }

        return redirect('admin/gudang-cabang/stok-barang')
            ->with('error', 'Status Order barang berhasil diubah');
    }
}
