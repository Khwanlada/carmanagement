@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
<style>

/*    this for print page*/
    @page {
        size: A4;
        margin: 2cm 2cm 0 2cm;
        border: 1px solid #f4f4f4 !important;
    }


    /*for img click*/
    img {
        float: left;
        opacity: 1;
        display: block;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }
    img:hover {
        float: left;
        opacity: 0.2;
        display: block;
        height: auto;
        transition: .1s ease;
        backface-visibility: hidden;
    }

    .btn-group-xs>.btn, .btn-xs {
        padding: 1px 1px !important;
    }


    #printThisA4,printThis p {border-style: dotted;}
    #printThisA4,#printThis{
        display: none;
    }

    @media print {

        #printThisA4,#printThis{
            display: block;
        }
        body * {
            visibility:hidden;
        }

    }

</style>


@section('content')
    <h3 class="page-title">@lang('global.checks.title')</h3>
    @can('check_create')
    <p>
        <a href="{{ route('admin.checks.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.checks.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li>
        @can('check_delete')
            | <li><a href="{{ route('admin.checks.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        @endcan
        </ul>
    </p>


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>
        <div class="form-search panel-heading">
            <div class="row search-form">
                <div class="col-xs-2">
                    {!! Form::open(['id' => 'searchForm','method' => 'GET', 'route' => ['admin.checks.index']]) !!}
                    <input class="form-control s_date" placeholder="วันที่" name="s_date" type="text" id="s_date">
                </div>
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($checks) > 0 ? 'datatable' : '' }} @can('check_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('check_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Id</th>
                        <th>วันที่</th>
                        <th>เลขทะเบียนรถ</th>
                        <th>วันที่จดทะเบียน</th>
                        <th>จังหวัด</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทร</th>
                        <th>CC</th>
                        <th>น้ำหนัก</th>
                        <th>ยอดรวมทั้งหมด</th>
                        <th>โดย</th>
                        <th>พรบ./ประกันภัย1-3</th>
                        <th>ชำระเงิน</th>
                            <th>ใบเสร็จ</th>
                            <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($checks) > 0)
                        @foreach ($checks as $check)
                            <tr data-entry-id="{{ $check->id }}">
                                @can('check_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $check->id }}</td>
                                <td field-key='check_date'>{{ $check->check_date }}</td>
                                <td field-key='check_date'>{{ $check->licence_no }}</td>
                                <td field-key='name'>{{ $check->car_register_date }}</td>
                                <td field-key='name'>{{ $check->province($check->province_id)}}</td>
                                <td field-key='name'>{{ $check->customer_name }}</td>
                                <td field-key='name'>{{ $check->customer_tel }}</td>
                                <td field-key='name'>@if(isset($check->rate_ccs_id)) {{ $check->rateCc->name }} @endif</td>
                                <td field-key='name'>@if(isset($check->rate_weights_id)) {{ $check->rateWeight->type }} @endif</td>
                                <td field-key='name'>{{ number_format($check->totalNet,2) }}</td>
                                    <td field-key='name'>{{ $check->create_by}}</td>
                                <td field-key='name'>

                                    {{ $check->txt_product_cmi }} /
                                    {{ $check->txt_product_vmi }}
                                </td>
                                    <td field-key='name'>{{ $check->paytype }}</td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-primary" onclick="btnPrint('{{$check}}')">ใบเสร็จ</a>
                                    </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::close() !!}
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.checks.restore', $check->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.checks.perma_del', $check->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                 </td>

                                @else
                                    <td>
                                    @can('check_delete')
                                            {!! Form::close() !!}
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.checks.destroy', $check->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="printThis" class="print">
        <div class="modal-body">
            <table style="width:800px">
                <tr>
                    <td colspan="2" align="center" style="margin:0px;">
                        <h3>{{ Auth::user()->location->name }}</h3>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                       {!! nl2br(Auth::user()->location->name_address) !!}
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: left;float:unset"><h6  class="print_full_name"></h6></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: left;float:unset"><h6  class="print_id_card"></h6></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: left"><h6  class="print_full_address"></h6></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left"><h6 class="print_no"></h6></div>
                    </td>
                    <td>
                        <div style="text-align: right"><h6  class="print_product_date"></h6></div>
                    </td>
                </tr>
            </table>
            <table style="width:800px" id="classTable" class="table table-bordered">
                <thead>
                <th>No.</th>
                <th>รายการ / บริการ</th>
                <th style="font-weight:bold;text-align: right">จำนวน(บาท)</th>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td class="print_type_text">- ค่าภาษีรถยนต์ประจำปี</td>
                    <td style="text-align: right"  class="print_rate"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>- ภาษีชำระล่าช้า</td>
                    <td style="text-align: right"  class="print_percen_late_month"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>- ค่าตรวจสภาพรถ</td>
                    <td style="text-align: right"  class="print_inspection"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="print_tax_car_service_type_text">- ค่าบริการเสียภาษีรถ</td>
                    <td style="text-align: right"  class="print_tax_car_service"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="print_cm_service_text">- ค่าบริการออก พรบ จยย.</td>
                    <td style="text-align: right"  class="print_cmi_service"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>- ค่าเบี้ยประกัน พรบ.</td>
                    <td style="text-align: right"  class="print_txt_product_cmi"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>- ค่าเบี้ยประกัน ภาคสมัครใจ</td>
                    <td style="text-align: right"  class="print_txt_product_vmi"></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="print_remark1">- อื่นๆ</td>
                    <td style="text-align: right"  class="print_other_service"></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="print_remark2">- อื่นๆ 2</td>
                    <td style="text-align: right"  class="print_other_service2"></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="print_remark3">- อื่นๆ 3</td>
                    <td style="text-align: right"  class="print_other_service3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2"><div class="print_normal_remark">- หมายเหตุ </div></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight:bold;text-align: right"><h5>ส่วนลด</h5></td>
                    <td style="font-weight:bold;text-align: right"><h5  class="print_discount"></h5></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight:bold;text-align: right"><h5>จำนวนเงินทั้งหมด</h5></td>
                    <td style="font-weight:bold;text-align: right"><h5  class="print_totalNet"></h5></td>
                </tr>
                </tbody>
            </table>
            <table style="width:800px">
                <tr>
                    <td width="30%">
                        <div style="text-align: left">ประเภทการชำระเงิน</div>
                    </td>
                    <td width="70%">
                        <div style="text-align: left;font-weight: bold;"><h5  class="print_paytype"></h5></div>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        <div style="text-align: left">ผู้รับเงิน</div>
                    </td>
                    <td width="70%">
                        <div style="text-align: left;font-weight: bold;">{{ Auth::user()->name }}</div>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        <div style="text-align: left">เล่ม/สำเนา</div>
                    </td>
                    <td width="70%">
                        <div style="text-align: left;font-weight: bold;"><h5  class="print_copyBook"></h5></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <textarea id="printing-css-a4" style="display:none;">html,table{font-size: 14px;font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;},body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:white;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none} </textarea>
    <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>

@stop

@section('javascript')
    <script>

        $('.s_date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        }).datepicker("setDate", new Date());
        $(document).ready(function() {
            $('#s_date').on('change', function() {
                document.forms["searchForm"].submit();
            });
        });

        @can('check_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.checks.mass_destroy') }}'; @endif
        @endcan


        function setValueTemplate(pro) {
            let product = jQuery.parseJSON(pro);

            // console.log(product);
            //set value from users click
            $(".print_no").text("เล่มที่. "+Math.floor(Math.random() * 90000) + 10000);
            $(".print_product_date").text("วันที่ : " + (product.check_date !==null ? product.check_date : ""));

            $(".print_id_card").text("เลขที่ผู้เสียภาษี : " + (product.id_card !==null ? product.id_card : ""));

            var text_receive_date = "";
            if (product.receive_date != null) {
                text_receive_date = "\n * วันนัดรับป้ายภาษี "+product.receive_date+" *";
            }

            $(".print_full_name").text("ชื่อ-สกุล : " + (product.customer_name !== null ? product.customer_name : "") +" "+(product.customer_surname != null ? product.customer_surname : "") +" ทะเบียนรถ " + product.licence_no + "  โทร "+ (product.customer_tel != null ? product.customer_tel : "-"));

            if (product.address === undefined || product.address === null) {
                $(".print_full_address").text("ที่อยู่ : -");
                $(".print_full_address").closest("div").css("display","none");
            }else{
                $(".print_full_address").text("ที่อยู่ : " +product.address);
                $(".print_full_address").closest("div").css("display","block");
            }

            if(product.israte === 1){
                if(product.ispercen_discount === 1){
                    $(".print_rate").text(accounting.formatNumber(product.rate-product.percen_discount_amount,2));
                }else{
                    $(".print_rate").text(accounting.formatNumber(product.rate,2));
                }
            }else{
                $(".print_rate").text("0.00");
            }

            if(product.ispercen_discount === 1){
                $(".print_percen_discount_amount").text(accounting.formatNumber(isNaN(parseFloat(product.percen_discount_amount)) ? 0 : parseFloat(product.percen_discount_amount),2));
            }else{
                $(".print_percen_discount_amount").text("0.00");
            }

            if(product.ispercen_late === 1){
                $(".print_percen_late_month").text(accounting.formatNumber(product.total_percen_late,2));
            }else{
                $(".print_percen_late_month").text("0.00");
            }

            if(product.isinspection === 1){
                $(".print_inspection").text(accounting.formatNumber(product.inspection,2));
            }else{
                $(".print_inspection").text("0.00");
            }

            if(product.istax_car_service === 1){
                $(".print_tax_car_service").text(accounting.formatNumber(product.tax_car_service,2));
                $(".print_tax_car_service_type_text").text("- ค่าบริการเสียภาษีรถ"+text_receive_date);
            }else{
                $(".print_tax_car_service").text("0.00");
            }


            $(".print_other_service").text(accounting.formatNumber(product.other_service,2));
            $(".print_other_service2").text(accounting.formatNumber(product.other_service2,2));
            $(".print_other_service3").text(accounting.formatNumber(product.other_service3,2));

            if(product.isother_service == null){
                $(".print_other_service").closest("tr").css("display","none");
            }
            if(product.isother_service2 == null){
                $(".print_other_service2").closest("tr").css("display","none");
            }
            if(product.isother_service3 == null){
                $(".print_other_service3").closest("tr").css("display","none");
            }

            $(".print_remark1").text(product.remark == null ? "" : product.remark);
            $(".print_remark2").text(product.remark2 == null ? "" : product.remark2);
            $(".print_remark3").text(product.remark3 == null ? "" : product.remark3);
            $(".print_totalNet").text(accounting.formatNumber(product.totalNet,2));
            $(".print_paytype").text(product.paytype);


            if(product.is_product_cmi === 1){
                $(".print_txt_product_cmi").text(accounting.formatNumber(product.txt_product_cmi,2));
            }else{
                $(".print_txt_product_cmi").text("0.00");
            }

            if(product.is_product_vmi === 1){
                $(".print_txt_product_vmi").text(accounting.formatNumber(product.txt_product_vmi,2));
            }else{
                $(".print_txt_product_vmi").text("0.00");
            }

            if(product.iscmi_service === 1){
                $(".print_cmi_service").text(accounting.formatNumber(product.cmi_service,2));
            }else{
                $(".print_cmi_service").text("0.00");
            }

            if(product.discount === null){
                $(".print_discount").text("");
            }else{
                $(".print_discount").text("- " + accounting.formatNumber(product.discount,2));
            }

            if(product.normal_remark === null){
                $(".print_normal_remark").text("- หมายเหตุ ");
            }else{
                $(".print_normal_remark").text("- หมายเหตุ " +product.normal_remark);
            }

            if(product.isCopyBook === 1){
                $(".print_copyBook").text("เล่มทะเบียน");
            }else{
                $(".print_copyBook").text("สำเนารถ");
            }
        }

        function btnPrint(pro) {
            setValueTemplate(pro);
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table#classTable th, table#classTable td {' +
                'border:1px solid #000;' +
                'padding:0.5em;' +
                '}' +
                '</style>';
            var a = document.getElementById('printing-css-a4').value;
            var b = document.getElementById("printThis").innerHTML;
            b = htmlToPrint += b;
            window.frames["print_frame"].document.title = document.title;
            window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }

    </script>
@endsection
