@extends('layouts.app')

@section('content')
    <h3 class="page-title">อัตราการเสียภาษีรถ คิดตามน้ำหนักรถ</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.rateWeights.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Create
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="type" class="control-label">น้ำหนักรถ(กิโลกรัม)</label>
                    {!! Form::text('type', old('type'), ['class' => 'form-control', 'placeholder' => 'Enter type', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="start_weight" class="control-label">น้ำหนักเริ่ม</label>
                    {!! Form::number('start_weight', old('start_weight'), ['class' => 'form-control', 'placeholder' => 'Enter Start Weight', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_weight'))
                        <p class="help-block">
                            {{ $errors->first('start_weight') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="end_weight" class="control-label">น้ำหนักสิ้นสุด</label>
                    {!! Form::number('end_weight', old('end_weight'), ['class' => 'form-control', 'placeholder' => 'Enter End Weight', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_weight'))
                        <p class="help-block">
                            {{ $errors->first('end_weight') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="car1" class="control-label">รถยนต์นั่งส่วนบุคคล เกิน 7 คน</label>
                    {!! Form::number('car1', old('car1'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('car1'))
                        <p class="help-block">
                            {{ $errors->first('car1') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="car2" class="control-label">รถยนต์บรรทุกส่วนบุคคล /รถยนต์ลากจูง /รถแทรกเตอร์ที่มีได้ใช้ในการเกษตร</label>
                    {!! Form::number('car2', old('car2'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('car2'))
                        <p class="help-block">
                            {{ $errors->first('car2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="legalEntity" class="control-label">นิติบุคคลที่มิได้เป็นผู้ให้เช่าซื้อ(คูณ x)</label>
                    {!! Form::number('legalEntity', old('legalEntity'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('legalEntity'))
                        <p class="help-block">
                            {{ $errors->first('legalEntity') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="ngv_cng" class="control-label">ส่วนลด NGV/CNG(%)</label>
                    {!! Form::number('ngv_cng', old('ngv_cng'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ngv_cng'))
                        <p class="help-block">
                            {{ $errors->first('ngv_cng') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="hybrid" class="control-label">ส่วนลด Hybrid(%)</label>
                    {!! Form::number('hybrid', old('hybrid'), ['class' => 'form-control', 'placeholder' => 'Enter number', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('hybrid'))
                        <p class="help-block">
                            {{ $errors->first('hybrid') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="percen_late" class="control-label">ค่าปรับเสียภาษีล่าช้า (% เดือน)</label>
                    {!! Form::number('percen_late', old('percen_late'), ['class' => 'form-control', 'placeholder' => 'Enter Percen Late', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('percen_late'))
                        <p class="help-block">
                            {{ $errors->first('percen_late') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="inspection" class="control-label">ค่าตรวจสภาพรถ</label>
                    {!! Form::number('inspection', old('inspection'), ['class' => 'form-control', 'placeholder' => 'Enter Inspection', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('inspection'))
                        <p class="help-block">
                            {{ $errors->first('inspection') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="tax_car_service" class="control-label">ค่าบริการเสียภาษี รถ</label>
                    {!! Form::number('tax_car_service', old('tax_car_service'), ['class' => 'form-control', 'placeholder' => 'Enter Tax Car Service', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tax_car_service'))
                        <p class="help-block">
                            {{ $errors->first('tax_car_service') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="other_service" class="control-label">อื่นๆ</label>
                    {!! Form::number('other_service', old('other_service'), ['class' => 'form-control', 'placeholder' => 'Enter Other Service', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('other_service'))
                        <p class="help-block">
                            {{ $errors->first('other_service') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="other_service2" class="control-label">อื่นๆ 2</label>
                    {!! Form::number('other_service2', old('other_service2'), ['class' => 'form-control', 'placeholder' => 'Enter Other Service', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('other_service2'))
                        <p class="help-block">
                            {{ $errors->first('other_service2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="other_service3" class="control-label">อื่นๆ 3</label>
                    {!! Form::number('other_service3', old('other_service3'), ['class' => 'form-control', 'placeholder' => 'Enter Other Service', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('other_service3'))
                        <p class="help-block">
                            {{ $errors->first('other_service3') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="remark" class="control-label">หมายเหตุ</label>
                    {!! Form::text('remark', old('remark'), ['class' => 'form-control', 'placeholder' => 'Enter Other Service']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('remark'))
                        <p class="help-block">
                            {{ $errors->first('remark') }}
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