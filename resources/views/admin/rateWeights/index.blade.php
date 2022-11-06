@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">อัตราการเสียภาษีรถ คิดตามน้ำหนักรถ</h3>
    @can('rateWeight_create')
    <p>
        <a href="{{ route('admin.rateWeights.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.rateWeights.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li>
        @can('rateWeight_delete')
            | <li><a href="{{ route('admin.rateWeights.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        @endcan
        </ul>
    </p>


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($rateWeights) > 0 ? 'datatable' : '' }} @can('rateWeight_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('rateWeight_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Id</th>
                        <th>น้ำหนักรถ(กิโลกรัม)</th>
                        <th>น้ำหนักเริ่ม</th>
                        <th>น้ำหนักสิ้นสุด</th>
                        <th>รถยนต์นั่งส่วนบุคคล เกิน 7 คน</th>
                        <th>รถยนต์บรรทุกส่วนบุคคล /รถยนต์ลากจูง /รถแทรกเตอร์ที่มีได้ใช้ในการเกษตร</th>
                        <th>นิติบุคคลที่มิได้เป็นผู้ให้เช่าซื้อ(คูณ x)</th>
                        <th>ส่วนลด NGV/CNG(%)</th>
                        <th>ส่วนลด Hybrid(%)</th>
                            <th>ค่าปรับเสียภาษีล่าช้า (% เดือน)</th>
                            <th>ค่าตรวจสภาพรถ</th>
                            <th>ค่าบริการเสียภาษี รถ</th>
                            <th>อื่นๆ</th>
                            <th>อื่นๆ 2</th>
                            <th>อื่นๆ 3</th>
                            <th>หมายเหตุ</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if (count($rateWeights) > 0)
                        @foreach ($rateWeights as $rateWeight)
                            <tr data-entry-id="{{ $rateWeight->id }}">
                                @can('rateWeight_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='id'>{{ $rateWeight->id }}</td>
                                <td field-key='type'>{{ $rateWeight->type }}</td>
                                <td field-key='start_weight'>{{ $rateWeight->start_weight }}</td>
                                <td field-key='end_weight'>{{ $rateWeight->end_weight }}</td>
                                <td field-key='car1'>{{ $rateWeight->car1 }}</td>
                                <td field-key='car2'>{{ $rateWeight->car2 }}</td>
                                <td field-key='legalEntity'>{{ $rateWeight->legalEntity }}</td>
                                <td field-key='ngv_cng'>{{ $rateWeight->ngv_cng }}</td>
                                <td field-key='hybrid'>{{ $rateWeight->hybrid }}</td>
                                    <td field-key='percen_late'>{{ $rateWeight->percen_late }}</td>
                                    <td field-key='inspection'>{{ $rateWeight->inspection }}</td>
                                    <td field-key='tax_car_service'>{{ $rateWeight->tax_car_service }}</td>
                                    <td field-key='other_service'>{{ $rateWeight->other_service }}</td>
                                    <td field-key='other_service2'>{{ $rateWeight->other_service2 }}</td>
                                    <td field-key='other_service3'>{{ $rateWeight->other_service3 }}</td>
                                    <td field-key='remark'>{{ $rateWeight->remark }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rateWeights.restore', $rateWeight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rateWeights.perma_del', $rateWeight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('rateWeight_view')
                                        <a href="{{ route('admin.rateWeights.show',[$rateWeight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('rateWeight_edit')
                                    <a href="{{ route('admin.rateWeights.edit',[$rateWeight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('rateWeight_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rateWeights.destroy', $rateWeight->id])) !!}
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
@stop

@section('javascript')
    <script>
        @can('rateWeight_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.rateWeights.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection