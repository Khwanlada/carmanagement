<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{
    use SoftDeletes;

    protected $fillable = ['licence_no', 'province_id', 'customer_name', 'customer_surname', 'customer_tel', 'product_type_id', 'rate_ccs_id', 'rate_weights_id', 'legalEntity', 'ngvcng', 'hybrid'
        , 'israte', 'rate', 'ispercen_discount', 'percen_discount_amount', 'percen_discount', 'ispercen_late', 'percen_late_month', 'percen_late', 'isinspection'
        , 'inspection', 'istax_car_service', 'tax_car_service', 'isother_service', 'isother_service2', 'isother_service3', 'other_service', 'other_service2', 'other_service3',
        'remark','remark2','remark3', 'totalNet','paytype','car_register_date','body_number','id_card', 'check_date','address',
        'month_rate_1','month_rate_1_total','month_rate_1_more','month_rate_1_fines',
        'month_rate_2','month_rate_2_total','month_rate_2_more','month_rate_2_fines',
        'month_rate_3','month_rate_3_total','month_rate_3_more','month_rate_3_fines',
        'create_by','receive_date','type_text','is_product_cmi','is_product_vmi','txt_product_cmi','txt_product_vmi',
        'dlt_total_net','dlt_extra_money','dlt_money_refund','iscmi_service','cmi_service','discount','normal_remark',
        'isCopyBook'];

    

}
