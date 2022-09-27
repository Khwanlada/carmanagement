@extends('layouts.app')

@section('content')
    <h3 class="page-title">อัตราการเสียภาษีรถ คิดตามน้ำหนักรถ</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>น้ำหนักรถ(กิโลกรัม)</th>
                            <td field-key='type'>{{ $rateWeight->type }}</td>
                        </tr>
                        <tr>
                            <th>น้ำหนักเริ่ม</th>
                            <td field-key='start_weight'>{{ $rateWeight->start_weight }}</td>
                        </tr>
                        <tr>
                            <th>น้ำหนักสิ้นสุด</th>
                            <td field-key='end_weight'>{{ $rateWeight->end_weight }}</td>
                        </tr>
                        <tr>
                            <th>รถยนต์นั่งส่วนบุคคล เกิน 7 คน</th>
                            <td field-key='car1'>{{ $rateWeight->car1 }}</td>
                        </tr>
                        <tr>
                            <th>รถยนต์รับจ้างระหว่างจังหวัด /รถยนต์บริการ</th>
                            <td field-key='car2'>{{ $rateWeight->car2 }}</td>
                        </tr>
                        <tr>
                            <th>รถยนต์รับจ้าง</th>
                            <td field-key='car3'>{{ $rateWeight->car3 }}</td>
                        </tr>
                        <tr>
                            <th>รถยนต์บรรทุกส่วนบุคคล /รถยนต์ลากจูง /รถแทรกเตอร์ที่มีได้ใช้ในการเกษตร</th>
                            <td field-key='car4'>{{ $rateWeight->car4 }}</td>
                        </tr>
                        <tr>
                            <th>ิติบุคคลที่มิได้เป็นผู้ให้เช่าซื้อ(คูณ x)</th>
                            <td field-key='legalEntity'>{{ $rateWeight->legalEntity }}</td>
                        </tr>
                        <tr>
                            <th>ส่วนลด NGV/CNG(%)</th>
                            <td field-key='ngv_cng'>{{ $rateWeight->ngv_cng }}</td>
                        </tr>
                        <tr>
                            <th>ส่วนลด Hybrid(%)</th>
                            <td field-key='hybrid'>{{ $rateWeight->hybrid }}</td>
                        </tr>
                        <tr>
                            <th>ค่าปรับเสียภาษีล่าช้า</th>
                            <td field-key='percen_late'>{{ $rateWeight->percen_late }}</td>
                        </tr>
                        <tr>
                            <th>ค่าตรวจสภาพรถ</th>
                            <td field-key='inspection'>{{ $rateWeight->inspection }}</td>
                        </tr>
                        <tr>
                            <th>ค่าบริการเสียภาษี รถ</th>
                            <td field-key='tax_car_service'>{{ $rateWeight->tax_car_service }}</td>
                        </tr>
                        <tr>
                            <th>อื่นๆ</th>
                            <td field-key='other_service'>{{ $rateWeight->other_service }}</td>
                        </tr>
                        <tr>
                            <th>อื่นๆ 2</th>
                            <td field-key='other_service2'>{{ $rateWeight->other_service2 }}</td>
                        </tr>
                        <tr>
                            <th>อื่นๆ 3</th>
                            <td field-key='other_service3'>{{ $rateWeight->other_service3 }}</td>
                        </tr>
                        <tr>
                            <th>หมายเหตุ</th>
                            <td field-key='remark'>{{ $rateWeight->remark }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <a href="{{ route('admin.rateWeights.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
