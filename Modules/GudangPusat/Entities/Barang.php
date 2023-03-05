<?php

namespace Modules\GudangPusat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Concerns\UuidTrait;

class Barang extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $fillable = [
        'id_kategori',
        'nama',
        'harga',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'barang';
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

    public function stok()
    {
        return $this->hasOne(StokBarang::class, 'id_barang');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori', 'id');
    }
}
