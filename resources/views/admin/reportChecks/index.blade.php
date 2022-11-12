@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

<style>
    .page-title{
        text-align: center !important;
    }

    #tbReport  thead  tr  th,
    #tbReport  tbody  tr  th,
    #tbReport  tfoot  tr  th,
    #tbReport  thead  tr  td,
    #tbReport  tbody  tr  td,
    #tbReport  tfoot  tr  td {
        padding: 0px !important;
    }

    div.search-form > div{
        float: left;
    }
    .panel {
        border: 0px !important;
    }
    .show-search-panel{
        display: none;
        text-align: center;
        font-weight: bold
    }

    @media print {
        #btPrint {
            display: none;
        }
        .form-search{
            display: none;
        }
        .panel {
            border: 0px !important;
        }

        .show-search-panel{
            display: block;
            text-align: center;
            font-weight: bold
        }
        button.btLogout{
            display: none;
        }
    }

    #tbReport th:nth-child(-n+4),#tbReport td:nth-child(-n+4){
        text-align: center;
    }
    #tbReport th:nth-child(n+5),#tbReport td:nth-child(n+5){
        text-align: right;
    }
</style>

@section('content')

    <h3 class="page-title">รายงาน ตรวจสภาพรถ ไม่รวมบิลที่ยกเลิก</h3>

    <div class="show-search-panel"> <div id="divTypeSearch"></div> <div id="divDateSearch"></div></div>

    <p>
        <button id="btPrint" class="btn btn-success" onclick="btnPrintA4()">Print</button>

    </p>
    <div class="panel panel-default">
        <div class="form-search panel-heading">
            <div style="text-align: center"></div>
            {!! Form::open(['method' => 'POST', 'route' => ['admin.reportChecks.store']]) !!}
            <div class="row search-form">
                <div class="col-xs-3 form-group">
                    <label for="change" class="control-label">ประเภทรถ</label>
                    <select class="form-control" required=""
                    name="type">
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
                </div>
                <div class="col-xs-3 form-group">
                    <label for="change" class="control-label">ใกล้ถึงวันครบกำหนด ต่อ พรบ ประกัน</label>
                    <select class="form-control"
                    name="expireDay">
                        <option selected="selected" value="">- โปรดเลือก -</option>
                        <option value="7"> 7 วัน</option>
                        <option value="30"> 30 วัน</option>
                    </select>
                </div>
            </div>
            <div class="row search-form">
                <div class="col-xs-2 form-group">
                    <label for="change" class="control-label">วันที่</label>
                    {!! Form::text('s_date', old('s_date'), ['class' => 'form-control s_date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('s_date'))
                        <p class="help-block">
                            {{ $errors->first('s_date') }}
                        </p>
                    @endif

                </div>
                <div class="col-xs-2form-group">
                    <label for="change" class="control-label">ถึงวันที่</label>
                    {!! Form::text('e_date', old('e_date'), ['class' => 'form-control e_date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('e_date'))
                        <p class="help-block">
                            {{ $errors->first('e_date') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-2 form-group" style="margin-top: 15px;">
                    {!! Form::submit("ค้นหาข้อมูล", ['class' => 'btn btn-danger']) !!}
                </div>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <table id="tbReport" class="table table-bordered">
                <thead>
                <tr style="background: gray;height: 32px;">
                    <th>ลำดับ.</th>
                    <th>Ref</th>
                    <th>วันที่</th>
                    <th>ทะเบียน</th>
                    <th>เล่ม/สำเนา</th>

                    <th>ยอดบิล</th>
                    <th>ภาษี/ล่าช้า</th>
                    <th>ยอดภาษีรถ</th>
                    <th>ยอดขนส่ง</th>

                    <th width="60">เพิ่ม</th>
                    <th width="60">คืน</th>
                    <th width="60">กำหนดวัน</th>
                    <th width="60">Send Sms</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sum_totalNet = 0;
                $sum_total_percen_late = 0;
                $sum_tax_car_service = 0;
                $sum_rate = 0;

                $sum_dlt_total_net = 0;
                $sum_dlt_extra_money = 0;
                $sum_dlt_money_refund = 0;
                $diff_day = 0;
                
                ?>
                @if (count($reports) > 0)
                    @foreach ($reports as $index => $report)
                    <?php
                    $date1 = date_create ($report->check_date);
                    $date2 = date_create (date("Y-m-d"));
                    $diff = date_diff ($date1, $date2);
                    $diff_amount_date =  $diff -> format ("%R%a days");
                    $diff_amount =  $diff -> format ("%a");

                    ?>
                    @if(isset($expireDay) && $expireDay !="")
                        @if($diff_amount <= $expireDay && ($report->is_product_cmi ===1 || $report->is_product_vmi === 1))
                            <?php
                            $sum_totalNet += $report->totalNet;
                            $sum_total_percen_late += $report->total_percen_late;
                            $sum_tax_car_service += $report->tax_car_service;

                            $sum_rate = $report->rate-$report->percen_discount_amount;

                            $sum_dlt_extra_money += $report->dlt_extra_money;
                            $sum_dlt_money_refund += $report->dlt_money_refund;

                            $sum_dlt_total_net += $report->dlt_total_net;

                            $color = $diff_amount <=7  ? "red" : "white";
                            $color = $diff_amount >7 && $diff_amount<=30 ? "orange" :  $color;
                            $font_color = $expireDay ==7 ? "white" : "black";
                            $font_color= $expireDay ==30 ? "white" :  $font_color;

                            ?>
                            <tr>
                                <td field-key='index'>{{ $index+1 }}.</td>
                                <td field-key="id">#{{ $report->id}}</td>
                                <td field-key='created_at'>{{ $report->check_date}}</td>
                                <td field-key='register_no'>{{ $report->licence_no }}</td>
                                <td field-key='register_no'>{{ $report->isCopyBook == 'on' ? "เล่มทะเบียน" : "สำเนารถ" }}</td>

                                <td field-key='totalNet'>{{number_format($report->totalNet,2)}}</td>
                                <td field-key='totalNet'>{{number_format($report->total_percen_late,2)}}</td>
                                <td field-key='totalNet'>{{number_format($report->tax_car_service,2)}}</td>

                                <td field-key='dlt_total_net' style="background-color: {{is_null($report->dlt_total_net) ? "white" : "green"}}" class="{{ $report->id}}_dlt_total_net">{{number_format($report->dlt_total_net,2,'.', '')}}</td>
                                <td field-key='dlt_extra_money' class="{{ $report->id}}_dlt_extra_money">{{number_format($report->dlt_extra_money,2) == 0 ? "" : number_format($report->dlt_extra_money,2)}}</td>
                                <td field-key='dlt_money_refund' class="{{ $report->id}}_dlt_money_refund">{{number_format($report->dlt_money_refund,2) == 0 ? "" : number_format($report->dlt_money_refund,2)}}</td>
                                <td field-key='totalNet'  style="text-align:center; background-color: {{$color}};color:{{$font_color}}">{{$diff_amount_date}}</td>
                                <td field-key='sms'><button onclick="loadSmsData('{{$report->customer_name}}','{{$report->licence_no}}','{{$report->customer_tel}}','{{$report->is_product_cmi}}','{{$report->is_product_vmi}}')" class="btn btn-success" type="button" data-target="#modalSendSms" data-toggle="modal">SMS</button></td>
                            </tr>
                        @endif
                    @else
                        <?php
                        $sum_totalNet += $report->totalNet;
                        $sum_total_percen_late += $report->total_percen_late;
                        $sum_tax_car_service += $report->tax_car_service;

                        $sum_rate = $report->rate-$report->percen_discount_amount;

                        $sum_dlt_extra_money += $report->dlt_extra_money;
                        $sum_dlt_money_refund += $report->dlt_money_refund;

                        $sum_dlt_total_net += $report->dlt_total_net;

                        ?>
                        <tr>
                            <td field-key='index'>{{ $index+1 }}.</td>
                            <td field-key="id">#{{ $report->id}}</td>
                            <td field-key='created_at'>{{ $report->check_date}}</td>
                            <td field-key='register_no'>{{ $report->licence_no }}</td>
                            <td field-key='register_no'>{{ $report->isCopyBook == 'on' ? "เล่มทะเบียน" : "สำเนารถ" }}</td>

                            <td field-key='totalNet'>{{number_format($report->totalNet,2)}}</td>
                            <td field-key='totalNet'>{{number_format($report->total_percen_late,2)}}</td>
                            <td field-key='totalNet'>{{number_format($report->tax_car_service,2)}}</td>

                            <td field-key='dlt_total_net' style="background-color: {{is_null($report->dlt_total_net) ? "white" : "green"}}" class="{{ $report->id}}_dlt_total_net">{{number_format($report->dlt_total_net,2,'.', '')}}</td>
                            <td field-key='dlt_extra_money' class="{{ $report->id}}_dlt_extra_money">{{number_format($report->dlt_extra_money,2) == 0 ? "" : number_format($report->dlt_extra_money,2)}}</td>
                            <td field-key='dlt_money_refund' class="{{ $report->id}}_dlt_money_refund">{{number_format($report->dlt_money_refund,2) == 0 ? "" : number_format($report->dlt_money_refund,2)}}</td>
                            <td field-key='amount'>{{$diff_amount_date}}</td>
                            <td field-key='sms'><button onclick="loadSmsData('{{$report->customer_name}}','{{$report->licence_no}}','{{$report->customer_tel}}','{{$report->is_product_cmi}}','{{$report->is_product_vmi}}')" class="btn btn-success" type="button" data-target="#modalSendSms" data-toggle="modal">SMS</button></td>
                        </tr>
                    @endif

                    @endforeach
                @else
                    <tr>
                        <td colspan="7">@lang("global.app_no_entries_in_table")</td>
                    </tr>
                @endif
                <tr style="color:green">
                    <td colspan="5" style="font-weight:bold;text-align: right"><h5>จำนวนเงินทั้งหมด</h5></td>
                    <td style="font-weight:bold;text-align: right;color:blue"><h5  class="sum_totalNet">{{number_format($sum_totalNet,2)}}</h5></td>
                    <td style="font-weight:bold;text-align: right"><h5  class="sum_rateAfterDiscount">{{number_format($sum_total_percen_late,2)}}</h5></td>
                    <td style="font-weight:bold;text-align: right"><h5  class="sum_totalRateAndPercenLate">{{number_format($sum_tax_car_service,2)}}</h5></td>

                    <td style="font-weight:bold;text-align: right"><h5  class="sum_dlt_total_net">{{number_format($sum_dlt_total_net,2)}}</h5></td>
                    <td style="font-weight:bold;text-align: right"><h5  class="sum_dlt_extra_money">{{number_format($sum_dlt_extra_money,2)}}</h5></td>
                    <td style="font-weight:bold;text-align: right"><h5  class="sum_dlt_money_refund">{{number_format($sum_dlt_money_refund,2)}}</h5></td>
                </tr>
                <tr style="color:green">
                    <td colspan="3" style="font-weight:bold;text-align: right"><h5>คงเหลือ	= (ยอดบิล-คืน)+เพิ่ม</h5></td>
                    <td style="font-weight:bold;text-align: right;color:red;"><h5  class="print_total_amount">{{number_format(($sum_totalNet-$sum_dlt_money_refund)+$sum_dlt_extra_money,2)}} บาท</h5></td>
                </tr>
                </tbody>


            </table>
        </div>
    </div>

    <div id="modalSendSms" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">SMS</h4>
                </div>
                <form id="formedit", method="post", action="">
                    <input type="hidden" name="check_ids2" id="check_ids2"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea readonly="readonly" rows="5" class="form-control" name="content_sms" id="content_sms">
                                คุณ [customer_name] พรบ./ประกัน ของหมายเลขทะเบียนรถ [licence_no] ใกล้หมดอายุ
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="SumitSendSms" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>

<input type="hidden" id="start_date" value="{{$start_date}}"/>
<input type="hidden" id="end_date" value="{{$end_date}}"/>
<input type="hidden" id="expireDay" value="{{$expireDay}}"/>
<input type="hidden" id="typeId" value="{{$typeId}}"/>

<input type="hidden" id="hd_customer_name" value=""/>
<input type="hidden" id="hd_licence_no" value=""/>
<input type="hidden" id="hd_customer_tel" value=""/>
<input type="hidden" id="hd_is_product_cmi" value=""/>
<input type="hidden" id="hd_is_product_vmi" value=""/>


@stop

@section('javascript')
    <script>

        @if(isset($start_date))
            $('.s_date').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            }).datepicker("setDate",$("#start_date").val());
        @else
            $('.s_date').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            }).datepicker("setDate", new Date());
        @endif
        @if(isset($end_date))
        $('.e_date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        }).datepicker("setDate",$("#end_date").val());
        @else
        $('.e_date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        }).datepicker("setDate", new Date());
        @endif

        @if(isset($expireDay))
            $("[name='expireDay']").val($("#expireDay").val());
        @endif
        @if(isset($typeId))
            $("[name='type']").val($("#typeId").val());
        @endif
        
        

        $(".tdDetails").attr("style", "display:none");

        function btnPrintA4() {

            $("#divTypeSearch").text("ประเภท " + $("#type option:selected" ).text());
            $("#divDateSearch").text("วันที่ " +$("#start_date").val()+ " ถึง " +$("#end_date").val());

            printElement(document.getElementById("tbReport"));
            window.print();
        }

        function printElement(elem, append, delimiter) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
              //  document.body.appendChild($printSection);
            }

            if (append !== true) {
                $printSection.innerHTML = "";
            }

            else if (append === true) {
                if (typeof(delimiter) === "string") {
                    $printSection.innerHTML += delimiter;
                }
                else if (typeof(delimiter) === "object") {
                    $printSection.appendChlid(delimiter);
                }
            }

            $printSection.appendChild(domClone);
        }

        function loadSmsData(customer_name,licence_no,customer_tel,is_product_cmi,is_product_vmi){
            $("#hd_customer_name").val(customer_name);
            $("#hd_licence_no").val(licence_no);
            $("#hd_customer_tel").val(customer_tel);
            $("#hd_is_product_cmi").val(is_product_cmi);
            $("#hd_is_product_vmi").val(is_product_vmi);

            let content_sms = $("#content_sms").val();
            content_sms = content_sms.replace("[customer_name]", customer_name)
            content_sms = content_sms.replace("[licence_no]", licence_no)
            $("#content_sms").val(content_sms);
        }


        $("#SumitSendSms").click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
                url: "{{ route('admin.checks.ajaxRequestSms.post') }}",
                type: "POST",
                data: JSON.stringify({
                    sms: $.trim($("#content_sms").val()),
                    tel: $.trim($("#hd_customer_tel").val()),
                }),
                success: function (datas) {
                   // console.log(datas);
                   alert(data);
                }
            });


        });


    </script>
@endsection