<?php

namespace Modules\GudangPusat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Concerns\UuidTrait;

class StokBarang extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $fillable = [
        'id_barang',
        'stok',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'stok_barang_pusat';
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
}
