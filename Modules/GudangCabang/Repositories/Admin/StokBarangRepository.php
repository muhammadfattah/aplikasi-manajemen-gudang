<?php

namespace Modules\GudangCabang\Repositories\Admin;

use App\Models\Role;
use Facades\Str;
use DB;
use Modules\GudangCabang\Entities\HistoryGudangCabang;
use Modules\GudangCabang\Entities\KategoriBarang;
use Modules\GudangCabang\Entities\StokBarang;
use Modules\GudangCabang\Entities\Supplier;
use Modules\GudangCabang\Repositories\Admin\Interfaces\StokBarangRepositoryInterface;
use Modules\GudangCabang\Entities\Barang;
use Modules\GudangCabang\Entities\Cabang;
use Modules\GudangCabang\Entities\PermintaanBarangPusat;
use Modules\GudangCabang\Entities\PermintaanReturPusat;
use Illuminate\Database\Eloquent\Builder;

class StokBarangRepository implements StokBarangRepositoryInterface
{
    public function findAll($options = [])
    {
        $perPage = $options['per_page'] ?? null;
        $orderByFields = $options['order'] ?? [];

        $barangs = (new Barang())->with('stok');


        if ($orderByFields) {
            foreach ($orderByFields as $field => $sort) {
                $barangs = $barangs->orderBy($field, $sort);
            }
        }

        if (!empty($options['filter']['q'])) {
            $barangs = $barangs->where(function ($query) use ($options) {
                $query->where('nama', 'LIKE', "%{$options['filter']['q']}%");
            });
        }

        if ($perPage) {
            return $barangs->paginate($perPage);
        }

        return $barangs->get();
    }

    public function findById($id)
    {
        return Barang::where('id', $id)
            ->firstOrFail();
    }

    public function update(Barang $barang, $params = [])
    {
        return DB::transaction(function () use ($barang, $params) {
            $idCabang = '';
            if (!auth()->user()->hasRole(Role::ADMIN)) {
                if (auth()->user()->hasRole(Role::MANAJERCABANG)) {
                    $idCabang = Cabang::where('id_manajer', auth()->user()->id)->firstOrFail()->id ?? '';
                } else if (auth()->user()->hasRole(Role::ADMINCABANG)) {
                    $idCabang = Cabang::where('id_admin', auth()->user()->id)->firstOrFail()->id ?? '';
                }
            }
            $permintaan = PermintaanBarangPusat::create([
                'id_barang' => $barang->id,
                'id_cabang' => $idCabang,
                'jumlah'    => $params['jumlah_order'],
                'status'    => 'menunggu konfirmasi'
            ]);
            return $permintaan;
        });
    }

    public function update_retur(Barang $barang, $params = [])
    {
        return DB::transaction(function () use ($barang, $params) {
            $idCabang = '';
            if (!auth()->user()->hasRole(Role::ADMIN)) {
                if (auth()->user()->hasRole(Role::MANAJERCABANG)) {
                    $idCabang = Cabang::where('id_manajer', auth()->user()->id)->firstOrFail()->id ?? '';
                } else if (auth()->user()->hasRole(Role::ADMINCABANG)) {
                    $idCabang = Cabang::where('id_admin', auth()->user()->id)->firstOrFail()->id ?? '';
                }
            }
            $permintaan = PermintaanReturPusat::create([
                'id_barang' => $barang->id,
                'id_cabang' => $idCabang,
                'jumlah'    => $params['jumlah_retur'],
                'status'    => 'menunggu konfirmasi'
            ]);
            return $permintaan;
        });
    }

    public function getListKategori()
    {
        $kategori = KategoriBarang::all();
        $list = [];
        foreach ($kategori as $a) {
            $list[$a->id] = $a->nama;
        }
        return $list;
    }

    public function getIDCabang()
    {
        $idCabang = '';
        if (!auth()->user()->hasRole(Role::ADMIN)) {
            if (auth()->user()->hasRole(Role::MANAJERCABANG)) {
                $idCabang = Cabang::where('id_manajer', auth()->user()->id)->firstOrFail()->id ?? '';
            } else if (auth()->user()->hasRole(Role::ADMINCABANG)) {
                $idCabang = Cabang::where('id_admin', auth()->user()->id)->firstOrFail()->id ?? '';
            }
        }
        return $idCabang;
    }
}
