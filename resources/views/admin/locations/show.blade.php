@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.locations.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.locations.fields.name')</th>
                            <td field-key='name'>{{ $location->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td field-key='name'>{{ $location->name_address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.locations.fields.location-date')</th>
                            <td field-key='location_date'>{{ $location->location_date }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <a href="{{ route('admin.locations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
