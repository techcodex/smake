<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Cast Attributes into desired Type
     */
    protected $casts = [
        'name' => 'string',
        'id' => 'int'
    ];

    // ORM
    public function transactions()
    {
        return $this->hasMany('App\Transaction');    
    }
}
