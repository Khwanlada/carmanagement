@extends('layouts.app')
<style>
    input[type=checkbox], input[type=radio] {
        /* Double-sized Checkboxes */
        -ms-transform: scale(2); /* IE */
        -moz-transform: scale(2); /* FF */
        -webkit-transform: scale(2); /* Safari and Chrome */
        -o-transform: scale(2); /* Opera */
        padding: 10px;
    }

    input[type=checkbox], input[type=radio] {
        margin: 10px !important;
        margin-top: 1px \9;
        line-height: normal;
    }

    .date {
        width: 150px !important;
    }

    .total-bt {
        width: 100% !important;
        height: 50px !important;
        font-size: 30px !important;
        font-weight: bold !important;
        padding: 4px !important;
        background: green !important;
    }

    .save-bt {
        width: 100% !important;
        height: 50px !important;
        font-size: 30px !important;
        font-weight: bold !important;
        padding: 4px !important;
    }

    .form-group {
        margin-bottom: 0px !important;
    }

    input.month_rate {
        background: green;
        color: white;
    }

    .can-hide {
        display: none;
    }

    .more-late-show-hide select {
        width: auto !important;
        float: left !important;
    }

    .ddl-disable {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

</style>
@section('content')
    <div class="content-wrapper" style="min-height: 1241px;margin-left: 0px;">
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">


                    <h3 class="page-title">ตรอ</h3>
                    {!! Form::open(['id'=>'form1','method' => 'POST', 'route' => ['admin.checks.store']]) !!}

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Create
                            </div>

                            <div class="panel-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="licence_no">เลขทะเบียนรถ</label>
                                        <input class="form-control" placeholder="Enter Register No" required=""
                                               name="licence_no" type="text">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="province">จังหวัด</label>
                                        <select class="form-control" name="province_id">
                                            <option selected="selected" value="">- โปรดเลือก -</option>
                                            @foreach($provinces as $key => $province)
                                                <option value="{{$province['id']}}">{{$province['name_th']}}</option>
                                            @endforeach
                                        </select>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="customer_name">ชื่อ</label>
                                        <input class="form-control" placeholder="Enter Customer Name"
                                               name="customer_name" type="text">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="customer_name">สกุล</label>
                                        <input class="form-control" placeholder="Enter Customer SurName"
                                               name="customer_surname" type="text">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="customer_tel">เบอร์โทร</label>
                                        <input class="form-control" placeholder="Enter Customer Tel" name="customer_tel"
                                               type="text">
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="customer_name">วันจดทะเบียน</label>
                                        <input class="form-control date2"
                                               placeholder="Enter Car Register Date" name="car_register_date"
                                               type="text" id="dp1662037779104">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="customer_name">หมายเลขตัวถัง</label>
                                        <input class="form-control" placeholder="Enter Body Number" name="body_number"
                                               type="text">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="customer_tel">เลขที่ผู้เสียภาษี</label>
                                        <input class="form-control" placeholder="Enter Id Card" name="id_card"
                                               type="text">
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">ประเภทรถ</label>
                                        <select class="form-control" required=""
                                                onchange="CarTypeChange(this.value)"
                                                name="car_type_id">
                                            <option selected="selected" value="0">- โปรดเลือก -</option>
                                            <option value="1">[รย.1] รถยนต์นั่งส่วนบุคคลไม่เกิน 7 คน (รถเก๋ง , รถกระบะ 4
                                                ประตู) (645.21 บาท)
                                            </option>
                                            <option value="2">[รย.2] รถยนต์นั่งส่วนบุคคลเกิน 7 คน (รถตู้) (1182.35
                                                บาท)
                                            </option>
                                            <option value="3">[รย.3] รถยนต์บรรทุกส่วนบุคคล (รถกระบะ 2 ประตู ) (967.28
                                                บาท)
                                            </option>
                                            <option value="4">[รย.12] รถจักรยานยนต์ส่วนบุคคล (รถจักรยานยนต์) (161.57
                                                บาท)
                                            </option>
                                        </select>
                                        <p class="help-block"></p>
             

                                        {!! Form::select('rate_ccs_id',$rateCcs, old('rate_ccs_id'), ['class' => 'form-control rateCcs-class', 'placeholder' => '- เลือก อัตราการเสียภาษีรถ ตามความจุกระบอกสูบ (ซีซี.) -', "onchange" => "RateCcsChange(this.value)" ]) !!}
                                        <p class="help-block rateCcs-class"></p>
                                        @if($errors->has('rateCcs'))
                                            <p class="help-block rateCcs-class">
                                                {{ $errors->first('rateCcs') }}
                                            </p>
                                        @endif

                                        {!! Form::select('rate_weights_id',$rateWeights, old('rate_weights_id'), ['class' => 'form-control rateWeights-class', 'placeholder' => '- เลือก อัตราการเสียภาษีรถ คิดตามน้ำหนักรถ -', "onchange" => "RateWeightsChange(this.value)" ]) !!}
                                        <p class="help-block rateWeights-class"></p>
                                        @if($errors->has('rateWeights'))
                                            <p class="help-block rateWeights-class">
                                                {{ $errors->first('rateWeights') }}
                                            </p>
                                        @endif
                                        {{-- <p class="help-block rateWeights-class" style="display: none;"></p> --}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="customer_name">CC</label>
                                        <input class="form-control" placeholder="Enter CC" name="cc" type="number">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="customer_tel">น้ำหนัก</label>
                                        <input class="form-control" placeholder="Enter Weight" name="weight"
                                               type="number">
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group motorcycle ">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="legalEntity"
                                                       id="legalEntity">
                                                <label class="form-check-label" for="legalEntity">
                                                    นิติบุคคลที่มิได้เป็นผู้ให้เช่าซื้อ(คูณ x)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ngvcng"
                                                       id="ngvcng">
                                                <label class="form-check-label" for="ngvcng">
                                                    ส่วนลด NGV/CNG(%)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="hybrid"
                                                       id="hybrid">
                                                <label class="form-check-label" for="hybrid">
                                                    ส่วนลด Hybrid(%)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group rateCcs-class" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check" style="text-align: right;padding-top:5px;">
                                                <label class="form-check-label">
                                                  
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group rateWeights-class" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check" style="text-align: right;padding-top:5px;">
                                                <label class="form-check-label" for="gridCheck">
                                                    Weight
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control" id="txtRateWeight"
                                                   name="txtRateWeight" placeholder="0.00">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="israte"
                                                       name="israte">
                                                <label class="form-check-label" for="rate">
                                                    ค่าภาษีรถ ประจำปี
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" step="any" class="form-control" id="rate" name="rate"
                                                   placeholder="Rate">
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="ispercen_discount"
                                                       name="ispercen_discount">
                                                <label class="form-check-label" for="percen_discount">
                                                    รถเก่าใช้งานมานานเกิน 5 ปี ให้ลดภาษี(% จากภาษี)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="number" class="form-control" id="percen_discount_amount" readonly
                                                   name="percen_discount_amount" placeholder="Amount"
                                            >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="number" class="form-control" id="percen_discount" readonly
                                                   name="percen_discount" placeholder="Percen Discount"
                                            >
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="ispercen_late"
                                                       name="ispercen_late">
                                                <label class="form-check-label" for="percen_late">
                                                    ค่าปรับเสียภาษีล่าช้า (% เดือน)
                                                </label>
                                                <i style="font-size: 25px;padding: 4px;cursor: pointer;"
                                                   class="fa fa-plus-circle" aria-hidden="true"
                                                   onclick="ShowControl()"></i>
                                                <i style="font-size: 25px;padding: 4px;cursor: pointer;"
                                                   class="fa fa-minus-circle" aria-hidden="true"
                                                   onclick="HideControl()"></i>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control" id="percen_late_month"
                                                   name="percen_late_month" placeholder="Month">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control" id="percen_late"
                                                   name="percen_late" placeholder="Percen Late">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control" id="total_percen_late"
                                                   name="total_percen_late" placeholder="Total Percen Late"
                                            >
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group can-hide">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6 more-late-show-hide">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_1"
                                                   name="month_rate_1" placeholder="ล่าช้า ปี" oninput="month_rate_1_onInput(this.value)">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" step="any" class="form-control month_rate"
                                                   id="month_rate_1_total" name="month_rate_1_total"
                                                   placeholder="จำนวน">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_1_more"
                                                   name="month_rate_1_more" placeholder="เงินเพิ่ม">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group can-hide">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6 more-late-show-hide">

                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_2"
                                                   name="month_rate_2" placeholder="ล่าช้า ปี">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" step="any" class="form-control month_rate"
                                                   id="month_rate_2_total" name="month_rate_2_total"
                                                   placeholder="จำนวน">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_2_more"
                                                   name="month_rate_2_more" placeholder="เงินเพิ่ม">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group can-hide">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6 more-late-show-hide">
 
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_3"
                                                   name="month_rate_3" placeholder="ล่าช้า ปี">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" step="any" class="form-control month_rate"
                                                   id="month_rate_3_total" name="month_rate_3_total"
                                                   placeholder="จำนวน">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_3_more"
                                                   name="month_rate_3_more" placeholder="เงินเพิ่ม">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isinspection"
                                                       name="isinspection">
                                                <label class="form-check-label" for="inspection">
                                                    ค่าตรวจสภาพรถ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control" id="inspection" name="inspection"
                                                   placeholder="Inspection">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="istax_car_service"
                                                       name="istax_car_service">
                                                <label class="form-check-label" for="tax_car_service">
                                                    ค่าบริการเสียภาษี รถ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control" id="tax_car_service"
                                                   name="tax_car_service" placeholder="Tax Car Service">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" id="is_product_cmi"
                                                       name="is_product_cmi" type="checkbox">
                                                <label class="form-check-label">
                                                    ค่าเบี้ยประกัน พรบ.
                                                </label>
                                                <label id="bt_product_cmi" style="color: red">
                                                </label></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" step="any" class="form-control" id="txt_product_cmi"
                                                   name="txt_product_cmi" placeholder="0.00">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group fixed-rate-form" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="iscmi_service"
                                                       name="iscmi_service">
                                                <label class="form-check-label" for="iscmi_service">
                                                    ค่าบริการออก พรบ จยย.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control" id="cmi_service"
                                                   name="cmi_service" placeholder="Cmi Service">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" id="is_product_vmi"
                                                       name="is_product_vmi" type="checkbox">
                                                <label class="form-check-label">
                                                    ค่าเบี้ยประกัน ภาคสมัครใจ
                                                </label>
                                                <label id="bt_product_vmi" style="color: red">
                                                </label></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" step="any" class="form-control" id="txt_product_vmi"
                                                   name="txt_product_vmi" placeholder="0.00">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isother_service"
                                                       name="isother_service">
                                                <label class="form-check-label" for="other_service">
                                                    อื่นๆ
                                                </label>
                                                <input class="form-check-input" type="checkbox" id="isother_service2"
                                                       name="isother_service2">
                                                <label class="form-check-label" for="other_service2">
                                                    อื่นๆ 2
                                                </label>
                                                <input class="form-check-input" type="checkbox" id="isother_service3"
                                                       name="isother_service3">
                                                <label class="form-check-label" for="other_service3">
                                                    อื่นๆ 3
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control" id="other_service"
                                                   name="other_service" placeholder="Other Service">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control" id="other_service2"
                                                   name="other_service2" placeholder="Other Service 2">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control" id="other_service3"
                                                   name="other_service3" placeholder="Other Service 3">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12" style="height: 35px;">
                                        <div class="form-group col-md-6">
                                            <label for="remark" style="float: right">หมายเหตุ อื่นๆ 1</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" placeholder="" name="remark" type="text">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12" style="height: 35px;">
                                        <div class="form-group col-md-6">
                                            <label for="remark2" style="float: right">หมายเหตุ อื่นๆ 2</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" placeholder="" name="remark2" type="text">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12" style="height: 35px;">
                                        <div class="form-group col-md-6">
                                            <label for="remark3" style="float: right">หมายเหตุ อื่นๆ 3</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" placeholder="" name="remark3" type="text">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12" style="height: 35px;">
                                        <div class="form-group col-md-6">
                                            <label for="normal_remark" style="float: right">หมายเหตุ</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" placeholder="" name="normal_remark" type="text">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12" style="height: 35px;">
                                        <div class="form-group col-md-6">
                                            <label for="remark3" style="float: right">ส่วนลด</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" step="any" class="form-control" id="discount"
                                                   name="discount" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-12" style="height: 35px;">
                                        <div class="form-group col-md-6">
                                            <label for="remark3" style="float: right">ประเภทชำระเงิน</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" id="paytype" name="paytype">
                                                <option value="เงินสด">เงินสด</option>
                                                <option value="Qr code">Qr code</option>
                                                <option value="โอนผ่านบัญชี">โอนผ่านบัญชี</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-md-6">
                                        <label for="check_date">วันที่</label>
                                        <input class="form-control date" placeholder="" name="check_date"
                                               type="text" id="dp1662037779103">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input class="form-control" placeholder="** ที่อยู่ออกใบเสร็จ **" name="address"
                                               type="text">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input class="form-control date2" placeholder="วันนัดรับป้ายภาษี"
                                               name="receive_date" type="text" id="dp1662037779105">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group col-md-12" style="height: 35px;">
                                            <div class="form-group col-md-6">
                                                <label for="remark3" style="float: right">เลือก = เล่มทะเบียน / ไม่ =
                                                    สำเนารถ</label>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="isCopyBook" name="isCopyBook" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">ยอดรวมทั้งหมด</label><br>
                                        <input type="hidden" class="form-control" id="totalNet" name="totalNet">
                                        <input class="btn btn-danger total-bt" id="btTotalNet" type="button"
                                               value="0.00">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <input type="hidden" id="create_by" name="create_by" value="{{ Auth::user()->email }}"/>

                        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger save-bt',"onclick" => "return confirmData()"]) !!}
                        {!! Form::close() !!}

                </div>
            </div>
        </section>
    </div>
@stop


@section('javascript')
    @parent

<script>

    
$(document).ready(function(){

        $(".rateCcs-class").hide();
        $(".rateWeights-class").hide();

        $("#form1 input:checkbox").bind("click", function(){
            calCulateTotal();
        });
        $("#form1 input[type=number]").bind("input", function(){
            calCulateTotal();
        });


        $("[name='cc']").bind("input", function(){
            var typeId = $("[name='car_type_id']").val();
            //fixed rate
            if(typeId === "4"){
                $("[name='txt_product_cmi']").val("0");
                var ccDefault = isNaN(parseFloat($("[name='cc']").val())) ? 0 : parseFloat($("[name='cc']").val());
                        if(ccDefault ===0){
                            $("[name='txt_product_cmi']").val("0");
                        }
                        else if(ccDefault <= 75){
                            $("[name='txt_product_cmi']").val("161.57");
                        }
                        else if(ccDefault > 75 && ccDefault <= 125){
                            $("[name='txt_product_cmi']").val("323.14");
                        }
                        else if(ccDefault > 125 && ccDefault <= 150){
                            $("[name='txt_product_cmi']").val("430.14");
                        }
                        else if(ccDefault > 150){
                            $("[name='txt_product_cmi']").val("645.21");
                        }
            }else{
                var rate_ccs_id = $("[name='rate_ccs_id']").val();

                if(rate_ccs_id !== ""){
                    // users selected cc reate droupdown
                            var cc = isNaN(parseFloat($("[name='cc']").val())) ? 0 : parseFloat($("[name='cc']").val());

                            var totalCalBeforeRate = 0.0;
                                if (cc <= 600) {
                                    totalCalBeforeRate += cc * 0.5;
                                } else if (cc >= 601 && cc <= 1800) {
                                    totalCalBeforeRate += 600 * 0.5;
                                    totalCalBeforeRate += (cc - 600) * 1.5;
                                } else if (cc >= 1801) {
                                    totalCalBeforeRate += 600 * 0.5;//600
                                    totalCalBeforeRate += 1200 * 1.5;//1200
                                    totalCalBeforeRate += (cc - 1800) * 4;
                                }

                            totalRate = totalCalBeforeRate;

                            if ($("#ngvcng").prop("checked") === true) {
                                totalRate = totalCalBeforeRate - ((totalCalBeforeRate * $reference_rateCss.ngv_cng) / 100);
                            } else if ($("#hybrid").prop("checked") === true) {
                                totalRate = totalCalBeforeRate - ((totalCalBeforeRate * $reference_rateCss.hybrid) / 100);
                            }

                            if ($("#legalEntity").prop("checked") === true) {
                                totalRate = totalRate * $reference_rateCss.legalEntity;
                            }

                        $("#rate").val(totalRate.toFixed(2));

                        //add psercen discount
                        var percenDiscount = isNaN(parseFloat($("#percen_discount").val())) ? 0 : parseFloat($("#percen_discount").val());
                        var totalDiscount = ((totalRate * percenDiscount) / 100);
                        $("#percen_discount_amount").val(totalDiscount);


                        calCulateTotal();
                }
            }
        });
        $("[name='weight']").bind("input", function(){
            var typeId = $("[name='car_type_id']").val();
            var rate_weights_id = $("[name='rate_weights_id']").val();
            if(rate_weights_id !== ""){
                    // users selected weight reate droupdown
                       
                        var weg = isNaN(parseFloat($("[name='weight']").val())) ? 0 : parseFloat($("[name='weight']").val());

                        var calWeight = $reference_rateWeight;

                        var rateWeight = 0;
                        if(typeId == 2){
                            rateWeight = calWeight.car1;
                        }else if(typeId == 3){
                            rateWeight = calWeight.car2;
                        }

                        $("#txtRateWeight").val(rateWeight);
                        totalRate = rateWeight;

                        if ($("#ngvcng").prop("checked") === true) {
                            totalRate = rateWeight - (rateWeight * $reference_rateWeight.ngv_cng) / 100;
                        } else if ($("#hybrid").prop("checked") === true) {
                            totalRate = rateWeight - (rateWeight * $reference_rateWeight.hybrid) / 100;
                        }

                        if ($("#legalEntity").prop("checked") === true) {
                            totalRate = totalRate * $reference_rateWeight.legalEntity;
                        }

                    $("#rate").val(totalRate.toFixed(2));

                    calCulateTotal();
                }
        });

        $("[id='legalEntity'],[id='ngvcng'],[id='hybrid']").bind("click", function(){
            $("[name='cc']").trigger('input');
            $("[name='weight']").trigger('input');
        });

        $("[name='percen_late_month'],[name='percen_late']").bind("input", function(){
            var crRate = isNaN(parseFloat($("#rate").val())) ? 0 : parseFloat($("#rate").val());
            var crPercenLate = isNaN(parseFloat($("#percen_late").val())) ? 0 : parseFloat($("#percen_late").val());
            var crPercenLateMonth = isNaN(parseFloat($("#percen_late_month").val())) ? 0 : parseFloat($("#percen_late_month").val());
            var percenDiscountAmount = isNaN(parseFloat($("#percen_discount_amount").val())) ? 0 : parseFloat($("#percen_discount_amount").val());

            if ($("#ispercen_discount").prop("checked") === true) {
                $("#total_percen_late").val(crPercenLateMonth * (((crRate - percenDiscountAmount) * crPercenLate) / 100));
            } else {
                $("#total_percen_late").val(crPercenLateMonth * ((crRate * crPercenLate) / 100));
            }
            $("[name='total_percen_late']").trigger('input');
        });
        
});
    
    $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        }).datepicker("setDate", new Date()).attr('readonly', 'readonly');

        $('.date2').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });

    function CarTypeChange(id) {
        if (id !== "") {
            $("[name='txt_product_cmi']").val("");

            $("[name='type_text']").val("รถยนต์");

            if (id === "4") {
                $("[name='type_text']").val("รถจักรยานยนต์");
                $(".rateCcs-class").hide();
                $("[name='rateCcs']").hide();
                $("[name='rateCcs']").attr('disabled', false);
                $(".rateWeights-class").hide();
                $(".motorcycle").hide();

                $("#ispercen_discount").attr('disabled', true);

                $("[name='rateCcs']").val("10");
                $("[name='rateCcs']").trigger('change');

                $(".fixed-rate-form").show();

                //default checked checkbox when fixed rate
                   $("#israte").prop('checked',true);
                   $("#istax_car_service").prop('checked',true);
                   $("#rate").val(100);
                   $("#inspection").val(60);
                   $("#tax_car_service").val(100);
                   $("#cmi_service").val(27);
                   calCulateTotal();

            } else if (id === "1") {
                $(".rateCcs-class").show();
                $("[name='rateCcs']").attr('disabled', false);
                $(".rateWeights-class").hide();
                $(".motorcycle").show();

                $("#ispercen_discount").attr('disabled', false);

                $("[name='rateCcs']").val("");

                $(".fixed-rate-form").hide();

                $("[name='rate_ccs_id']").val("");
                $("[name='rate_weights_id']").val("");

            } else if (id === "2" || id === "3") {
                $(".rateCcs-class").hide();
                $(".rateWeights-class").show();
                $(".motorcycle").show();

                $("#ispercen_discount").attr('disabled', true);
                $("[name='rateCcs']").val("");
                $("[name='txtRateWeight']").val("");

                $(".fixed-rate-form").hide();

                $("[name='rate_ccs_id']").val("");
                $("[name='rate_weights_id']").val("");

            } else {
                $(".rateCcs-class").hide();
                $(".rateWeights-class").hide();
                $(".motorcycle").hide();

                $("#ispercen_discount").attr('checked', false);
                $("#ispercen_discount").attr('disabled', false);
            }

            $("[name='rateCcs']").trigger('input');
        }
    }

    function ShowControl(){
        $(".can-hide").fadeIn("show", function(){});
    }
    function HideControl(){
        $(".can-hide").fadeOut("hide", function(){
            $("#month_rate_1").val("");
            $("#month_rate_1_total").val("");
            $("#month_rate_1_more").val("");

            $("#month_rate_2").val("");
            $("#month_rate_2_total").val("");
            $("#month_rate_2_more").val("");

            $("#month_rate_3").val("");
            $("#month_rate_3_total").val("");
            $("#month_rate_3_more").val("");
        });
    }

    function month_rate_1_onInput($value){
        $("#month_rate_2").val(parseInt($value)-1);
        $("#month_rate_3").val(parseInt($value)-2);

    }


    $reference_rateCss = null;
    $reference_rateWeight = null;
    function calCulateTotal(){

            var totalNet = 0.00;
                if ($("#israte").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#rate").val())) ? 0 : parseFloat($("#rate").val());
                }

                if ($("#ispercen_discount").prop("checked") === true) {
                    totalNet -= isNaN(parseFloat($("#percen_discount").val())) ? 0 : parseFloat($("#percen_discount").val());
                }
                if ($("#ispercen_late").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#month_rate_1_total").val())) ? 0 : parseFloat($("#month_rate_1_total").val());
                    totalNet += isNaN(parseFloat($("#month_rate_1_more").val())) ? 0 : parseFloat($("#month_rate_1_more").val());
                    totalNet += isNaN(parseFloat($("#month_rate_2_total").val())) ? 0 : parseFloat($("#month_rate_2_total").val());
                    totalNet += isNaN(parseFloat($("#month_rate_2_more").val())) ? 0 : parseFloat($("#month_rate_2_more").val());
                    totalNet += isNaN(parseFloat($("#month_rate_3_total").val())) ? 0 : parseFloat($("#month_rate_3_total").val());
                    totalNet += isNaN(parseFloat($("#month_rate_3_more").val())) ? 0 : parseFloat($("#month_rate_3_more").val());
                }
                if ($("#isinspection").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#inspection").val())) ? 0 : parseFloat($("#inspection").val());
                }
                if ($("#istax_car_service").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#tax_car_service").val())) ? 0 : parseFloat($("#tax_car_service").val());
                }
                if ($("#is_product_cmi").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#txt_product_cmi").val())) ? 0 : parseFloat($("#txt_product_cmi").val());
                }
                if ($("#is_product_vmi").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#txt_product_vmi").val())) ? 0 : parseFloat($("#txt_product_vmi").val());
                }
                if ($("#isother_service").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#other_service").val())) ? 0 : parseFloat($("#other_service").val());
                }
                if ($("#isother_service2").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#other_service2").val())) ? 0 : parseFloat($("#other_service2").val());
                }
                if ($("#iscmi_service").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#cmi_service").val())) ? 0 : parseFloat($("#cmi_service").val());
                }
                if ($("#isother_service3").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#other_service3").val())) ? 0 : parseFloat($("#other_service3").val());
                }
                if ($("#ispercen_late").prop("checked") === true) {
                    totalNet += isNaN(parseFloat($("#total_percen_late").val())) ? 0 : parseFloat($("#total_percen_late").val());
                }
                if ($("#ispercen_discount").prop("checked") === true) {
                    totalNet -= isNaN(parseFloat($("#percen_discount_amount").val())) ? 0 : parseFloat($("#percen_discount_amount").val());
                }

                    totalNet -= isNaN(parseFloat($("#discount").val())) ? 0 : parseFloat($("#discount").val());
                
                
                $("#totalNet").val(totalNet.toFixed(2));
                $("#btTotalNet").val(totalNet.toFixed(2));
            }


    function RateCcsChange($id) {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
                url: "{{ route('admin.checks.ajaxRequest.post') }}",
                type: "POST",
                data: JSON.stringify({
                    id: $id
                }),
                success: function (datas) {
                   // console.log(datas);
                   $reference_rateCss = datas;

                   //set default checkbox checked
                   $("#israte").prop('checked',true);
                   $("#istax_car_service").prop('checked',true);
                   $("#inspection").val(datas.inspection);
                   $("#tax_car_service").val(datas.tax_car_service);
                   $("#percen_late").val(datas.percen_late);

                   if(datas.id>3){
                    $("#ispercen_discount").prop('checked',true);
                    $("#percen_discount").val(datas.percen_discount);
                   }

                    $("[name='cc']").trigger('input');
                    
                   calCulateTotal();
                }
            });
    }

    function RateWeightsChange($id) {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
                url: "{{ route('admin.checks.ajaxRequestWeight.post') }}",
                type: "POST",
                data: JSON.stringify({
                    id: $id
                }),
                success: function (datas) {
                   // console.log(datas);
                   $reference_rateWeight = datas;

                   //set default checkbox checked
                   $("#israte").prop('checked',true);
                   $("#istax_car_service").prop('checked',true);
                   $("#inspection").val(datas.inspection);
                   $("#tax_car_service").val(datas.tax_car_service);
                   $("#percen_late").val(datas.percen_late);

                   if(datas.id>3){
                    $("#ispercen_discount").prop('checked',true);
                    $("#percen_discount").val(datas.percen_discount);
                   }

                   $("[name='weight']").trigger('input');

                   calCulateTotal();
                }
            });
    }

</script>

@stop