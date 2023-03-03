<?php

namespace Modules\GudangPusat\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use App\Authorizable;
use Modules\GudangPusat\Http\Controllers\GudangPusatController;
use Modules\GudangPusat\Http\Requests\Admin\KategoriBarangRequest;
use Modules\GudangPusat\Repositories\Admin\Interfaces\KategoriBarangRepositoryInterface;

class KategoriBarangController extends GudangPusatController
{
    // use Authorizable;

    private $kategoriRepository;

    public function __construct(KategoriBarangRepositoryInterface $kategoriRepository) //phpcs:ignore
    {
        parent::__construct();
        $this->data['currentAdminMenu'] = 'kategori';

        $this->kategoriRepository = $kategoriRepository;

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

        $this->data['kategoris'] = $this->kategoriRepository->findAll($options);
        $this->data['filter'] = $params;

        return view('gudangpusat::admin.kategori.index', $this->data);
    }

    public function trashed(Request $request)
    {
        $params = $request->all();

        $options = [
            'per_page' => $this->perPage,
            'order' => [
                'created_at' => 'desc',
            ],
            'filter' => $params,
        ];

        $this->data['viewTrash'] = true;
        $this->data['kategoris'] = $this->kategoriRepository->findAllInTrash($options);
        $this->data['filter'] = $params;
        return view('gudangpusat::admin.kategori.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('gudangpusat::admin.kategori.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(KategoriBarangRequest $request)
    {
        $params = $request->validated();

        if ($this->kategoriRepository->create($params)) {
            return redirect('admin/gudang-pusat/kategori-barang')
                ->with('success', __('gudangpusat::kategori.success_create_message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $kategori = $this->kategoriRepository->findById($id);

        $this->data['kategori'] = $kategori;

        return view('gudangpusat::admin.kategori.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(KategoriBarangRequest $request, $id)
    {
        $kategori = $this->kategoriRepository->findById($id);
        $params = $request->validated();

        if ($this->kategoriRepository->update($kategori, $params)) {
            return redirect('admin/gudang-pusat/kategori-barang')
                ->with('success', __('gudangpusat::kategori.success_update_message'));
        }

        return redirect('admin/gudang-pusat/kategori-barang/' . $id . '/edit')
            ->with('error', __('gudangpusat::kategori.fail_update_message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $permanentDelete = (bool)$request->get('_permanent_delete');

        if ($this->kategoriRepository->delete($id, $permanentDelete)) {
            if ($permanentDelete) {
                return redirect('admin/gudang-pusat/kategori-barang/trashed')->with('success', __('gudangpusat::kategori.success_delete_message'));
            }

            return redirect('admin/gudang-pusat/kategori-barang')->with('success', __('gudangpusat::kategori.success_delete_message'));
        }

        return redirect('admin/gudang-pusat/kategori-barang')->with('error', __('gudangpusat::kategori.fail_delete_message'));
    }

    public function restore($id)
    {
        if ($this->kategoriRepository->restore($id)) {
            return redirect('admin/gudang-pusat/kategori-barang')->with('success', __('gudangpusat::kategori.success_restore_message'));
        }

        return redirect('admin/gudang-pusat/kategori-barang/trashed')->with('error', __('gudangpusat::kategori.fail_restore_message'));
    }
}
