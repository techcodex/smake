<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'date', 'description', 'bank_id'
    ];

    /**
     * The attributes that cast into Carbon Date
     */
    protected $dates = [
        'date'
    ];

    /**
     * Cast Atributes into desired Type
     */
    protected $casts = [
        'amount' => 'double',
        'description' => 'string',
        'bank_id' => 'int'
    ];

    // ORM
    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
}
