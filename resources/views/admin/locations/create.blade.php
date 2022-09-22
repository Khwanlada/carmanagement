@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.locations.title')</h3>
    {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data', 'route' => ['admin.locations.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name" class="control-label">Name*</label>
                    {!! Form::textarea('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter location', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name" class="control-label">Address*</label>
                    {!! Form::textarea('name_address', old('name_address'), ['class' => 'form-control', 'placeholder' => 'Enter location address', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name_address'))
                        <p class="help-block">
                            {{ $errors->first('name_address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location_date', trans('global.locations.fields.location-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('location_date', old('location_date'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('location_date'))
                        <p class="help-block">
                            {{ $errors->first('location_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        }).datepicker("setDate", new Date());

        $(document).ready(function(){
            $("#name").focus();
        });
    </script>

@stop