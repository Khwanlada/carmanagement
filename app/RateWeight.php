<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RateWeight extends Model
{
    use SoftDeletes;

    protected $fillable = ['type', 'start_weight', 'end_weight', 'car1', 'car2', 'legalEntity', 'ngv_cng', 'hybrid', 'percen_late', 'inspection', 'tax_car_service', 'other_service', 'other_service2', 'other_service3', 'remark'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
