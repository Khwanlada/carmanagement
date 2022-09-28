<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RateCc extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'type', 'legalEntity', 'ngv_cng', 'hybrid', 'rate', 'percen_discount', 'percen_late', 'inspection', 'tax_car_service', 'other_service', 'other_service2', 'other_service3', 'remark'];

}
