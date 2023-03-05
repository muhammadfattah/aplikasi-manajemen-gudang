<?php

namespace Modules\GudangCabang\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Concerns\UuidTrait;
use App\Models\Role;

class StokBarang extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $fillable = [
        'id_barang',
        'id_cabang',
        'stok',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'stok_barang_cabang';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('d, M Y H:i:s');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id');
    }

    public function scopeStok($query)
    {
        if (!auth()->user()->hasRole(Role::ADMIN)) {
            if (auth()->user()->hasRole(Role::MANAJERCABANG)) {
                $idCabang = Cabang::where('id_manajer', auth()->user()->id)->firstOrFail()->id ?? '';
            } else if (auth()->user()->hasRole(Role::ADMINCABANG)) {
                $idCabang = Cabang::where('id_admin', auth()->user()->id)->firstOrFail()->id ?? '';
            } else {
                $idCabang = '';
            }
            if ($idCabang != '') {
                $query->where('id_cabang', $idCabang);
            }
        }
    }
}
