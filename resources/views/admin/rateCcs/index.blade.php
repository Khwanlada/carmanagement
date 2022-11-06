@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">อัตราการเสียภาษีรถ ตามความจุกระบอกสูบ (ซีซี.)</h3>
    @can('rateCc_create')
    <p>
        <a href="{{ route('admin.rateCcs.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>

    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.rateCcs.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li>
        @can('rateCc_delete')
            | <li><a href="{{ route('admin.rateCcs.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        @endcan
        </ul>
    </p>


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($rateCcs) > 0 ? 'datatable' : '' }} @can('rateCcs_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('rateCcs_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Id</th>
                        <th>ความจุกระบอกสูบ (ซีซี.)</th>
                        <th>CC</th>
                        <th>นิติบุคคลที่มิได้เป็นผู้ให้เช่าซื้อ(คูณ x)</th>
                        <th>ส่วนลด NGV/CNG(%)</th>
                        <th>ส่วนลด Hybrid(%)</th>
                        <th>รถเก่าใช้งานมานานเกิน 5 ปี ให้ลดภาษี(% จากภาษี)</th>
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
                    @if (count($rateCcs) > 0)
                        @foreach ($rateCcs as $rateCcs)
                            <tr data-entry-id="{{ $rateCcs->id }}">
                                @can('rateCcs_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $rateCcs->id }}</td>
                                <td field-key='name'>{{ $rateCcs->name }}</td>
                                <td field-key='type'>{{ $rateCcs->type }}</td>
                                <td field-key='legalEntity'>{{ $rateCcs->legalEntity }}</td>
                                <td field-key='ngv_cng'>{{ $rateCcs->ngv_cng }}</td>
                                <td field-key='hybrid'>{{ $rateCcs->hybrid }}</td>
                                <td field-key='percen_discount'>{{ $rateCcs->percen_discount }}</td>
                                <td field-key='percen_late'>{{ $rateCcs->percen_late }}</td>
                                <td field-key='inspection'>{{ $rateCcs->inspection }}</td>
                                <td field-key='tax_car_service'>{{ $rateCcs->tax_car_service }}</td>
                                <td field-key='other_service'>{{ $rateCcs->other_service }}</td>
                                <td field-key='other_service2'>{{ $rateCcs->other_service2 }}</td>
                                <td field-key='other_service3'>{{ $rateCcs->other_service3 }}</td>
                                <td field-key='remark'>{{ $rateCcs->remark }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rateCcs.restore', $rateCcs->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rateCcs.perma_del', $rateCcs->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('rateCc_view')
                                        <a href="{{ route('admin.rateCcs.show',[$rateCcs->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('rateCc_edit')
                                    <a href="{{ route('admin.rateCcs.edit',[$rateCcs->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('rateCc_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rateCcs.destroy', $rateCcs->id])) !!}
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
        @can('rateCcs_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.rateCcs.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection