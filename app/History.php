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

}
