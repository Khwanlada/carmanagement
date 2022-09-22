<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','name_address', 'location_date'];

    public function products()
    {
        return $this->hasMany(Repair::class);
    }

}
