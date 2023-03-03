<?php

namespace Modules\GudangPusat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Concerns\UuidTrait;
use App\Models\User;

class Cabang extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $fillable = [
        'nama',
        'lokasi',
        'id_manajer',
        'id_admin'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'cabang';
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

    public function manajer()
    {
        return $this->belongsTo(User::class, 'id_manajer', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }
}
