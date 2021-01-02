<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $kendaraan_id
 * @property boolean $tipe
 * @property string $waktu
 * @property string $created_at
 * @property string $updated_at
 */
class History extends Model
{
    public static $KENDARAAN_KELUAR = 0;
    public static $KENDARAAN_MASUK = 1;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'history';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['kendaraan_id', 'tipe', 'waktu', 'created_at', 'updated_at'];

    public function kendaraan()
    {
        return $this->belongsTo('App\Kendaraan');
    }
}
