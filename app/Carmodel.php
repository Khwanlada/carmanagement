<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carmodel extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','carbrand_id'];

    public function carbrand()
    {
        return $this->belongsTo(Carbrand::class, 'carbrand_id')->withTrashed();
    }
}
