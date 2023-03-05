<?php

namespace Modules\GudangCabang\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangCabang\Http\Controllers\GudangCabangController;
use Modules\GudangCabang\Repositories\Admin\Interfaces\PermintaanReturRepositoryInterface;

class PermintaanReturController extends GudangCabangController
{
    // use Authorizable;

    private $permintaanreturRepository;

    public function __construct(PermintaanReturRepositoryInterface $permintaanreturRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'permintaan retur';

        $this->permintaanreturRepository = $permintaanreturRepository;

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

        $this->data['permintaanreturs'] = $this->permintaanreturRepository->findAll($options);
        $this->data['filter'] = $params;
        return view('gudangcabang::admin.permintaanretur.index', $this->data);
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
            return redirect('admin/gudang-cabang/permintaan-retur')
                ->with('error', 'Status permintaan retur berhasil diubah');
        }
        $retur = $this->permintaanreturRepository->findById($id);

        if ($this->permintaanreturRepository->update($retur, ['status' => $status])) {
            return redirect('admin/gudang-cabang/permintaan-retur')
                ->with('success', 'Status permintaan retur berhasil diubah');
        }

        return redirect('admin/gudang-cabang/permintaan-retur')
            ->with('error', 'Status permintaan retur berhasil diubah');
    }
}
