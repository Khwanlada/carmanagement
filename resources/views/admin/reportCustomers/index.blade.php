@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

<style>customer_address
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

    #tbReport th:nth-child(-n+3),#tbReport td:nth-child(-n+3){
             text-align: center;
         }
    #tbReport th:nth-child(n+4),#tbReport td:nth-child(n+4){
        text-align: right;
    }

    input[type=checkbox], input[type=radio]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(2); /* IE */
        -moz-transform: scale(2); /* FF */
        -webkit-transform: scale(2); /* Safari and Chrome */
        -o-transform: scale(2); /* Opera */
        padding: 10px;
    }
    input[type=checkbox], input[type=radio] {
        margin: 10px !important;
        margin-top: 1px\9;
        line-height: normal;
    }

</style>

@section('content')

    <h3 class="page-title" style="text-align: center;">รายงาน การต่อภาษี (เพิ่ม,คืน) ไม่รวมบิลที่ยกเลิก</h3>

    <div class="show-search-panel"> <div id="divTypeSearch"></div> <div id="divDateSearch"></div></div>

    <p>
        <button id="btPrint" class="btn btn-success" onclick="btnPrintA4()">Print</button>

    </p>

    <div id="modaledit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">แก้ไข ยอดขนส่ง (บิลเก็บลูกค้า <span class="dlt_total_net"></span>)</h4>
                </div>
                <form id="formedit", method="post", action="">
                    <input type="hidden" name="check_id" id="check_id"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="InputEmail">ยอดขนส่ง</label>
                            <input type="text" class="form-control" name="dlt_total_net" id="dlt_total_net" value="0.00"/>
                        </div>
                        <div class="form-group">
                            <label for="InputFname">เพิ่ม</label>
                            <input type="text" class="form-control" name="dlt_extra_money" id="dlt_extra_money" value="0.00"/>
                        </div>
                        <div class="form-group">
                            <label for="InputLname">คืน</label>
                            <input type="text" class="form-control" name="dlt_money_refund" id="dlt_money_refund" value="0.00"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit-edit" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="panel panel-default">
        <div class="form-search panel-heading">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.reportCustomers.store']]) !!}
            <div class="row search-form">
                <div class="col-xs-6 form-group">
                    <label for="change" class="control-label">ค้นหา ชื่อ ทะเบียน เบอร์โทร</label>
                    {!! Form::text('txtSearch', old('txtSearch'), ['class' => 'form-control', 'placeholder' => 'Enter search']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('txtSearch'))
                        <p class="help-block">
                            {{ $errors->first('txtSearch') }}
                        </p>
                    @endif
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
                <div class="col-xs-2form-group" style="padding-left:20px;padding-top: 23px;">
                    <label for="change" class="control-label">ทุกวัน</label>
                    {{ Form::checkbox('allDate',null,null, array('id'=>'allDate'), ['class' => 'form-control allDate', 'placeholder' => '']) }}
                    <p class="help-block"></p>
                    @if($errors->has('allDate'))
                        <p class="help-block">
                            {{ $errors->first('allDate') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group" style="margin-top: 25px;">
                    {!! Form::submit("ค้นหาข้อมูล", ['class' => 'btn btn-danger']) !!}
                    <button class="btn btn-success" type="button" data-target="#modaleditCheckids" data-toggle="modal">ยืนยันยอดขนส่งทั้งหมด</button>
                </div>
            </div>
        </div>

    <div id="modaleditCheckids" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">แก้ไข ยอดขนส่งทั้งหมด (บิลเก็บลูกค้า <span class="dlt_total_net"></span>)</h4>
                </div>
                <form id="formedit", method="post", action="">
                    <input type="hidden" name="check_ids2" id="check_ids2"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea readonly="readonly" rows="5" class="form-control" name="check_ids" id="check_ids">{{$checkids}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitCheckids-edit" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
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
                    <th width="40"></th>
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
                
                ?>
                @if (count($reports) > 0)
                    @foreach ($reports as $index => $report)
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
                            <td field-key='created_at'>{{ $report->check_date }}</td>
                            <td field-key='register_no'>{{ $report->licence_no }}</td>
                            <td field-key='register_no'>{{ $report->isCopyBook == 'on' ? "เล่มทะเบียน" : "สำเนารถ" }}</td>

                            <td field-key='totalNet'>{{number_format($report->totalNet,2)}}</td>
                            <td field-key='totalNet'>{{number_format($report->total_percen_late,2)}}</td>
                            <td field-key='totalNet'>{{number_format($report->tax_car_service,2)}}</td>

                            <td field-key='dlt_total_net' style="background-color: {{is_null($report->dlt_total_net) ? "white" : "green"}}" class="{{ $report->id}}_dlt_total_net">{{number_format($report->dlt_total_net,2,'.', '')}}</td>
                            <td field-key='dlt_extra_money' class="{{ $report->id}}_dlt_extra_money">{{number_format($report->dlt_extra_money,2) == 0 ? "" : number_format($report->dlt_extra_money,2)}}</td>
                            <td field-key='dlt_money_refund' class="{{ $report->id}}_dlt_money_refund">{{number_format($report->dlt_money_refund,2) == 0 ? "" : number_format($report->dlt_money_refund,2)}}</td>
                            <td field-key='balance'>

                                @can('check_edit')
                                    <a href="#" data-target="#modaledit" onclick="setValueForm({{ $report->id}},{{$sum_rate}})" data-toggle="modal" class="btn btn-xs">Edit</a>
                                @endcan
                            </td>
                        </tr>
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


    <input type="hidden" id="start_date" value="{{$start_date}}"/>
    <input type="hidden" id="end_date" value="{{$end_date}}"/>
@stop

@section('javascript')
    <script>
        function setValueForm(id,value){
            $("#check_id").val(id);
            $(".dlt_total_net")[0].innerText = value.toFixed(2);

            if($.trim($("."+id+"_dlt_total_net")[0].innerText) != "0.00"){
                $("#dlt_total_net").val($.trim($("."+id+"_dlt_total_net")[0].innerText));
            }else{
                $("#dlt_total_net").val(value.toFixed(2));
            }

            $("#dlt_extra_money").val("0.00");
            $("#dlt_money_refund").val("0.00");

            $("#dlt_total_net").on("input", function() {
                var dlt_total_net = isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                if(dlt_total_net > value){
                    $("#dlt_extra_money").val((dlt_total_net - value).toFixed(2));
                }else{
                    $("#dlt_extra_money").val("0.00");
                }
                if(dlt_total_net < value){
                    $("#dlt_money_refund").val((value - dlt_total_net).toFixed(2));
                }else{
                    $("#dlt_money_refund").val("0.00");
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#submit-edit").click(function(e){
            e.preventDefault();
            var dlt_total_net = $("input[name=dlt_total_net]").val();
            var dlt_extra_money = $("input[name=dlt_extra_money]").val();
            var dlt_money_refund = $("input[name=dlt_money_refund]").val();
            var check_id = $("input[name=check_id]").val();

            $.ajax({
                type:'POST',
                url:"{{ route('admin.checks.ajaxRequestMoney.post') }}",
                data:{id:check_id,dlt_total_net:dlt_total_net, dlt_extra_money:dlt_extra_money, dlt_money_refund:dlt_money_refund},
                success:function(data){
                    //alert(data.success);
                    $("."+check_id+"_dlt_total_net")[0].innerText = dlt_total_net;
                    $("."+check_id+"_dlt_extra_money")[0].innerText = dlt_extra_money;
                    $("."+check_id+"_dlt_money_refund")[0].innerText = dlt_money_refund;

                    $("."+check_id+"_dlt_total_net").animate( {
                        backgroundColor:'green',
                    });

                    $('#modaledit').modal('toggle');
                }
            });

        });

        $("#submitCheckids-edit").click(function(e){
            e.preventDefault();
            var check_ids = $("#check_ids").val();

            $.ajax({
                type:'POST',
                url:"{{ route('admin.checks.ajaxRequestMoneys.post') }}",
                data:{check_ids:check_ids},
                success:function(data){
                    alert(data.success);
                    $('#modaleditCheckids').modal('toggle');
                    location.reload();
                }
            });

        });


        $('#allDate').change(function()
        {
            if(this.checked === true)
            {
                $('.s_date').prop( "disabled", true );
                $('.e_date').prop( "disabled", true );
            }
            else{
                $('.s_date').prop( "disabled", false );
                $('.e_date').prop( "disabled", false );
            }
        });

        if( $('#allDate').prop("checked") === true){
            $('.s_date').prop( "disabled", true );
            $('.e_date').prop( "disabled", true );
        }

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

        $(".tdDetails").attr("style", "display:none");

        function btnPrintA4() {

            if($("[name='txtSearch']").val() === ""){
                $("#divTypeSearch").text("ค้นหา ทั้งหมด");
                $("#divDateSearch").text("วันที่ ทั้งหมด");
            }else{
                $("#divTypeSearch").text("ค้นหา " + $("[name='txtSearch']").val());
                $("#divDateSearch").text("วันที่ " +$("#start_date").val()+ " ถึง " +$("#end_date").val());
            }

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

        function isCheckShowDetail() {

            let dbChecked = document.getElementById("cbShowDetail");
            if (dbChecked.checked == true){
                $(".tdDetails").attr("style", "display:block");
            } else {
                $(".tdDetails").attr("style", "display:none");
            }
        }

    </script>
@endsection