@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.carmodels.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.carmodels.fields.name')</th>
                            <td field-key='carmodel_date'>{{ $carmodel->name }}</td>
                        </tr>
                        <tr>
                            <th>ยี่ห้อ</th>
                            <td field-key='carbrand'>{{ $carmodel->carbrand->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <a href="{{ route('admin.carmodels.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
