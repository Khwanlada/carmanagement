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
                        <th>ประเภทพรถ</th>
                        <th>CC</th>
                        <th>น้ำหนัก</th>
                        <th>ยอดรวมทั้งหมด</th>
                        <th>โดย</th>
                        <th>พรบ./ประกันภัย1-3</th>
                        <th>ชำระเงิน</th>
                            <th>ใบเสร็จ</th>
                            <th>พิมพ์ Mini</th>
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
                                <td field-key='check_date'>{{ $check->register_no }}</td>
                                <td field-key='name'>{{ $check->car_register_date }}</td>
                                <td field-key='name'>{{ $check->province}}</td>
                                <td field-key='name'>{{ $check->customer_name }}</td>
                                <td field-key='name'>{{ $check->customer_tel }}</td>
                                <td field-key='name'>{{ $check->productType }}</td>
                                <td field-key='name'>@if(isset($check->rateCcs)) {{ $check->rateCc->name }} @endif</td>
                                <td field-key='name'>@if(isset($check->rateWeights)) {{ $check->rateWeight->type }} @endif</td>
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
                                    <td>
                                        <a href="#" class="btn btn-xs btn-primary" onclick="btnPrintMini('{{$check}}')">พิมพ์ Mini</a>
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
                                    @can('check_edit')
                                        <a href="{{ route('admin.checks.edit',[$check->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
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

    </script>
@endsection
