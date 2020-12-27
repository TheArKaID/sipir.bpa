<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $nim
 * @property string $nama
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class Mahasiswa extends Authenticatable
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nim', 'nama', 'username', 'email', 'password', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function kendaraans()
    {
        return $this->hasMany('App\Kendaraan');
    }

    public function getTotalKendaraan()
    {
        return $this->kendaraans()->count();
    }
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($mahasiswa) {
            if($mahasiswa->kendaraans) {
                foreach($mahasiswa->kendaraans as $k) {
                    $k->delete();
                };
            }
        });
    }
}
