<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $mahasiswa_id
 * @property string $jenis
 * @property string $merk
 * @property string $nomor
 * @property string $created_at
 * @property string $updated_at
 */
class Kendaraan extends Model
{
    public static $JENIS_RODA_DUA = 1;
    public static $JENIS_RODA_EMPAT = 2;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kendaraan';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['mahasiswa_id', 'jenis', 'merk', 'nomor', 'created_at', 'updated_at'];

    public function histories()
    {
        return $this->hasMany('App\History');
    }
    
    protected static function boot() {
        parent::boot();
        
        static::deleting(function($kendaraan) {
            if($kendaraan->histories) {
                foreach($kendaraan->histories as $h) {
                    $h->delete();
                };
            }
        });
    }
}
