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
                                        {{-- <select class="form-control rateCcs-class" onchange="RateCcsChange(this.value)"
                                                name="rate_weights_id" style="display: none;">
                                            <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                ตามความจุกระบอกสูบ (ซีซี.) -
                                            </option>
                                            <option value="1">ไม่เกิน 5 ปี cc น้อยกว่า 600</option>
                                            <option value="2">ไม่เกิน 5 ปี cc 601 - 1,800</option>
                                            <option value="3">ไม่เกิน 5 ปี cc เกิน 1,800</option>
                                            <option value="5">เป็นรถเก่าใช้งานมานานเกิน 6 ปี ให้ลดภาษี</option>
                                            <option value="6">เป็นรถเก่าใช้งานมานานเกิน 7 ปี ให้ลดภาษี</option>
                                            <option value="7">เป็นรถเก่าใช้งานมานานเกิน 8 ปี ให้ลดภาษี</option>
                                            <option value="8">เป็นรถเก่าใช้งานมานานเกิน 9 ปี ให้ลดภาษี</option>
                                            <option value="9">เป็นรถเก่าใช้งานมานานเกิน 10 ปี หรือปีต่อๆไป</option>
                                            <option value="10">รถจักรยานยนต์</option>
                                        </select> --}}

                                        {!! Form::select('rate_ccs_id',$rateCcs, old('rate_ccs_id'), ['class' => 'form-control rateCcs-class', 'placeholder' => '- เลือก อัตราการเสียภาษีรถ ตามความจุกระบอกสูบ (ซีซี.) -', "onchange" => "RateCcsChange(this.value)" ]) !!}
                                        <p class="help-block rateCcs-class"></p>
                                        @if($errors->has('rateCcs'))
                                            <p class="help-block rateCcs-class">
                                                {{ $errors->first('rateCcs') }}
                                            </p>
                                        @endif

                                        {{-- <p class="help-block rateCcs-class" style="display: none;"></p> --}}
                                        {{-- <select class="form-control rateWeights-class"
                                                style="display: none;">
                                            <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                คิดตามน้ำหนักรถ -
                                            </option>
                                            <option value="1">ไม่เกิน 500</option>
                                            <option value="2">501 - 750</option>
                                            <option value="3">751 - 1,000</option>
                                            <option value="4">1,001 - 1,250</option>
                                            <option value="5">1,251 - 1,500</option>
                                            <option value="6">1,501 - 1,750</option>
                                            <option value="7">1,751 - 2,000</option>
                                            <option value="8">2,001 - 2,500</option>
                                            <option value="9">2,501 - 3,000</option>
                                            <option value="10">3,001 - 3,500</option>
                                            <option value="11">3,501 - 4,000</option>
                                            <option value="12">4,001 - 4,500</option>
                                            <option value="13">4,501 - 5,000</option>
                                            <option value="14">5,001 - 6,000</option>
                                            <option value="15">6,001 - 7,000</option>
                                            <option value="16">7,000 ขึ้นไป</option>
                                        </select> --}}
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
                                                    CC คูณ x
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="number" class="form-control" id="txtRateCc" name="txtRateCc"
                                                   placeholder="0.00">
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
                                            <input type="number" class="form-control" id="percen_discount_amount"
                                                   name="percen_discount_amount" placeholder="Amount"
                                            >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="number" class="form-control" id="percen_discount"
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
                                            <select class="form-control rateCcs-class"
                                                    style="display: none;">
                                                <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                    ตามความจุกระบอกสูบ (ซีซี.) -
                                                </option>
                                                <option value="1">ไม่เกิน 5 ปี cc น้อยกว่า 600</option>
                                                <option value="2">ไม่เกิน 5 ปี cc 601 - 1,800</option>
                                                <option value="3">ไม่เกิน 5 ปี cc เกิน 1,800</option>
                                                <option value="5">เป็นรถเก่าใช้งานมานานเกิน 6 ปี ให้ลดภาษี</option>
                                                <option value="6">เป็นรถเก่าใช้งานมานานเกิน 7 ปี ให้ลดภาษี</option>
                                                <option value="7">เป็นรถเก่าใช้งานมานานเกิน 8 ปี ให้ลดภาษี</option>
                                                <option value="8">เป็นรถเก่าใช้งานมานานเกิน 9 ปี ให้ลดภาษี</option>
                                                <option value="9">เป็นรถเก่าใช้งานมานานเกิน 10 ปี หรือปีต่อๆไป</option>
                                                <option value="10">รถจักรยานยนต์</option>
                                            </select>
                                            <select class="form-control rateWeights-class"
                                                    name="month_rate_1_rateWeights" style="display: none;">
                                                <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                    คิดตามน้ำหนักรถ -
                                                </option>
                                                <option value="1">ไม่เกิน 500</option>
                                                <option value="2">501 - 750</option>
                                                <option value="3">751 - 1,000</option>
                                                <option value="4">1,001 - 1,250</option>
                                                <option value="5">1,251 - 1,500</option>
                                                <option value="6">1,501 - 1,750</option>
                                                <option value="7">1,751 - 2,000</option>
                                                <option value="8">2,001 - 2,500</option>
                                                <option value="9">2,501 - 3,000</option>
                                                <option value="10">3,001 - 3,500</option>
                                                <option value="11">3,501 - 4,000</option>
                                                <option value="12">4,001 - 4,500</option>
                                                <option value="13">4,501 - 5,000</option>
                                                <option value="14">5,001 - 6,000</option>
                                                <option value="15">6,001 - 7,000</option>
                                                <option value="16">7,000 ขึ้นไป</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="number" class="form-control month_rate" id="month_rate_1"
                                                   name="month_rate_1" placeholder="ล่าช้า ปี">
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
                                            <select class="form-control rateCcs-class"
                                                    style="display: none;">
                                                <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                    ตามความจุกระบอกสูบ (ซีซี.) -
                                                </option>
                                                <option value="1">ไม่เกิน 5 ปี cc น้อยกว่า 600</option>
                                                <option value="2">ไม่เกิน 5 ปี cc 601 - 1,800</option>
                                                <option value="3">ไม่เกิน 5 ปี cc เกิน 1,800</option>
                                                <option value="5">เป็นรถเก่าใช้งานมานานเกิน 6 ปี ให้ลดภาษี</option>
                                                <option value="6">เป็นรถเก่าใช้งานมานานเกิน 7 ปี ให้ลดภาษี</option>
                                                <option value="7">เป็นรถเก่าใช้งานมานานเกิน 8 ปี ให้ลดภาษี</option>
                                                <option value="8">เป็นรถเก่าใช้งานมานานเกิน 9 ปี ให้ลดภาษี</option>
                                                <option value="9">เป็นรถเก่าใช้งานมานานเกิน 10 ปี หรือปีต่อๆไป</option>
                                                <option value="10">รถจักรยานยนต์</option>
                                            </select>
                                            <select class="form-control rateWeights-class"
                                                    name="month_rate_2_rateWeights" style="display: none;">
                                                <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                    คิดตามน้ำหนักรถ -
                                                </option>
                                                <option value="1">ไม่เกิน 500</option>
                                                <option value="2">501 - 750</option>
                                                <option value="3">751 - 1,000</option>
                                                <option value="4">1,001 - 1,250</option>
                                                <option value="5">1,251 - 1,500</option>
                                                <option value="6">1,501 - 1,750</option>
                                                <option value="7">1,751 - 2,000</option>
                                                <option value="8">2,001 - 2,500</option>
                                                <option value="9">2,501 - 3,000</option>
                                                <option value="10">3,001 - 3,500</option>
                                                <option value="11">3,501 - 4,000</option>
                                                <option value="12">4,001 - 4,500</option>
                                                <option value="13">4,501 - 5,000</option>
                                                <option value="14">5,001 - 6,000</option>
                                                <option value="15">6,001 - 7,000</option>
                                                <option value="16">7,000 ขึ้นไป</option>
                                            </select>
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
                                            <select class="form-control rateCcs-class"
                                                    style="display: none;">
                                                <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                    ตามความจุกระบอกสูบ (ซีซี.) -
                                                </option>
                                                <option value="1">ไม่เกิน 5 ปี cc น้อยกว่า 600</option>
                                                <option value="2">ไม่เกิน 5 ปี cc 601 - 1,800</option>
                                                <option value="3">ไม่เกิน 5 ปี cc เกิน 1,800</option>
                                                <option value="5">เป็นรถเก่าใช้งานมานานเกิน 6 ปี ให้ลดภาษี</option>
                                                <option value="6">เป็นรถเก่าใช้งานมานานเกิน 7 ปี ให้ลดภาษี</option>
                                                <option value="7">เป็นรถเก่าใช้งานมานานเกิน 8 ปี ให้ลดภาษี</option>
                                                <option value="8">เป็นรถเก่าใช้งานมานานเกิน 9 ปี ให้ลดภาษี</option>
                                                <option value="9">เป็นรถเก่าใช้งานมานานเกิน 10 ปี หรือปีต่อๆไป</option>
                                                <option value="10">รถจักรยานยนต์</option>
                                            </select>
                                            <select class="form-control rateWeights-class"
                                                    name="month_rate_3_rateWeights" style="display: none;">
                                                <option selected="selected" value="">- เลือก อัตราการเสียภาษีรถ
                                                    คิดตามน้ำหนักรถ -
                                                </option>
                                                <option value="1">ไม่เกิน 500</option>
                                                <option value="2">501 - 750</option>
                                                <option value="3">751 - 1,000</option>
                                                <option value="4">1,001 - 1,250</option>
                                                <option value="5">1,251 - 1,500</option>
                                                <option value="6">1,501 - 1,750</option>
                                                <option value="7">1,751 - 2,000</option>
                                                <option value="8">2,001 - 2,500</option>
                                                <option value="9">2,501 - 3,000</option>
                                                <option value="10">3,001 - 3,500</option>
                                                <option value="11">3,501 - 4,000</option>
                                                <option value="12">4,001 - 4,500</option>
                                                <option value="13">4,501 - 5,000</option>
                                                <option value="14">5,001 - 6,000</option>
                                                <option value="15">6,001 - 7,000</option>
                                                <option value="16">7,000 ขึ้นไป</option>
                                            </select>
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

            // $("#form1 input:checkbox").bind("click", function(){

            //     alert(123);

            //         $listAllCheckboxInForm = $('input[type=checkbox]:checked');
            //         $listAllCheckboxInForm.each(function()
            //         {
            //             alert(456);
            //         });
            // });

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
                $(".rateCcs-class").show();
                $("[name='rateCcs']").hide();
                $("[name='rateCcs']").attr('disabled', false);
                $(".rateWeights-class").hide();
                $(".motorcycle").hide();

                $("#ispercen_discount").attr('disabled', true);

                $("[name='rateCcs']").val("10");
                $("[name='rateCcs']").trigger('change');

                $(".fixed-rate-form").show();

            } else if (id === "1") {
                $(".rateCcs-class").show();
                $("[name='rateCcs']").attr('disabled', false);
                $(".rateWeights-class").hide();
                $(".motorcycle").show();

                $("#ispercen_discount").attr('disabled', false);

                $("[name='rateCcs']").val("");

                $(".fixed-rate-form").hide();

            } else if (id === "2" || id === "3") {
                $(".rateCcs-class").hide();
                $(".rateWeights-class").show();
                $(".motorcycle").show();

                $("#ispercen_discount").attr('disabled', true);
                $("[name='rateCcs']").val("");
                $("[name='txtRateWeight']").val("");

                $(".fixed-rate-form").hide();

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
</script>

@stop