@extends('layouts.app')

@section('content')
    <h3 class="page-title">อัตราการเสียภาษีรถ ตามความจุกระบอกสูบ (ซีซี.)</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <td field-key='id'>{{ $rateCc->id }}</td>
                        </tr>
                        <tr>
                            <th>ความจุกระบอกสูบ (ซีซี.)</th>
                            <td field-key='name'>{{ $rateCc->name }}</td>
                        </tr>
                        <tr>
                            <th>CC</th>
                            <td field-key='type'>{{ $rateCc->type }}</td>
                        </tr>
                        <tr>
                            <th>นิติบุคคลที่มิได้เป็นผู้ให้เช่าซื้อ(คูณ x)</th>
                            <td field-key='legalEntity'>{{ $rateCc->legalEntity }}</td>
                        </tr>
                        <tr>
                            <th>ส่วนลด NGV/CNG(%)</th>
                            <td field-key='ngv_cng'>{{ $rateCc->ngv_cng }}</td>
                        </tr>
                        <tr>
                            <th>ส่วนลด Hybrid(%)</th>
                            <td field-key='hybrid'>{{ $rateCc->hybrid }}</td>
                        </tr>
                        <tr>
                            <th>บาท(CC คูณ x)</th>
                            <td field-key='rate'>{{ $rateCc->rate }}</td>
                        </tr>
                        <tr>
                            <th>รถเก่าใช้งานมานานเกิน 5 ปี ให้ลดภาษี(% จากภาษี)</th>
                            <td field-key='percen_discount'>{{ $rateCc->percen_discount }}</td>
                        </tr>
                        <tr>
                            <th>ค่าปรับเสียภาษีล่าช้า</th>
                            <td field-key='percen_late'>{{ $rateCc->percen_late }}</td>
                        </tr>
                        <tr>
                            <th>ค่าตรวจสภาพรถ</th>
                            <td field-key='inspection'>{{ $rateCc->inspection }}</td>
                        </tr>
                        <tr>
                            <th>ค่าบริการเสียภาษี รถ</th>
                            <td field-key='tax_car_service'>{{ $rateCc->tax_car_service }}</td>
                        </tr>
                        <tr>
                            <th>อื่นๆ</th>
                            <td field-key='other_service'>{{ $rateCc->other_service }}</td>
                        </tr>
                        <tr>
                            <th>อื่นๆ 2</th>
                            <td field-key='other_service2'>{{ $rateCc->other_service2 }}</td>
                        </tr>
                        <tr>
                            <th>อื่นๆ 3</th>
                            <td field-key='other_service3'>{{ $rateCc->other_service3 }}</td>
                        </tr>
                        <tr>
                            <th>หมายเหตุ</th>
                            <td field-key='remark'>{{ $rateCc->remark }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <a href="{{ route('admin.rateCcs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
