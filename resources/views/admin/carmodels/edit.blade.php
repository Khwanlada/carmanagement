@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.carmodels.title')</h3>
    
    {!! Form::model($carmodel, ['method' => 'PUT', 'route' => ['admin.carmodels.update', $carmodel->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.carmodels.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter name', 'required' => '']) !!}
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
                    <label for="carbrand_id" class="control-label">ยี่ห้อ*</label>
                    {!! Form::select('carbrand_id',$carbrands, old('carbrand_id'), ['class' => 'form-control', 'placeholder' => '- โปรดเลือก -']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('carbrand_id'))
                        <p class="help-block">
                            {{ $errors->first('carbrand_id') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
    </script>

@stop