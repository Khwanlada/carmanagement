<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carbrand extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function carmodels()
    {
        return $this->hasMany(Carmodel::class);
    }
}
