<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
// Representasi table admin yang inherit ke Class User/Authenticable
class Admin extends Authenticatable
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'admin';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nama', 'username', 'email', 'password', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
