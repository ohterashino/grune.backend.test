@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>Companies</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $company->page_title }}</li>
    </ol>
</section>
<!-- Main content -->
<section id="main-content" class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $company->page_title }}</h3>
                    <a href="{{ route('company') }}" class="btn btn-primary btn-back">Back</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{ Form::open(array('route' => $company->form_action, 'method' => 'POST', 'files' => true, 'id' => 'company-form')) }}
                    {{ Form::hidden('id', $company->id, array('id' => 'company_id')) }}
                    {{-- Name Form --}}
                    <div id="form-name" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Name</strong>
                        </div>
                        {{Form::text('name', null, ['class' => 'form-control','id' => 'name','placeholder' => 'Grune Asia'])}}
                    </div>
                    {{-- Name Form --}}
                    {{-- Emain Form --}}
                    <div id="form-email" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Email</strong>
                        </div>
                        {{Form::email('email', null, ['class' => 'form-control','id' => 'email','placeholder' => 'info@grune.co.jp'])}}
                    </div>
                    {{-- Email Form --}}
                    {{-- Postcode Form --}}
                    <div id="form-postcode" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Postcode</strong>
                        </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header postcode ">
                            {{Form::text('postcode', null, ['class' => 'form-control','id' => 'postcode','placeholder' => '9800014'])}}
                                    <button type="submit" name="submit" class="btn btn-primary btn-search">Search</button>
                        </div>
                    </div>
                    {{-- Postcode Form --}}
                    {{-- Prefecture Form --}}
                    <div id="form-prefecture" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Prefecture</strong>
                        </div>
                        {{Form::select('prefecture_id', ['1' => '北海道', '2' => '青森県', '3' => '岩手県', '4' => '宮城県', '5' => '秋田県', '6' => '山形県', '7' => '福島県'], 'ordinarily', ['class' => 'form-control','id' => 'prefecture_id'])}}
                    </div>
                    {{-- Prefecture Form --}}
                    {{-- City Form --}}
                    <div id="form-city" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">City</strong>
                        </div>
                        {{Form::text('city', null, ['class' => 'form-control','id' => 'city','placeholder' => '仙台市青葉区'])}}
                    </div>
                    {{-- City Form --}}
                    {{-- Local Form --}}
                    <div id="form-local" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Local</strong>
                        </div>
                        {{Form::text('local', null, ['class' => 'form-control','id' => 'local','placeholder' => '本町'])}}
                    </div>
                    {{-- Local Form --}}
                    {{-- StreetAddress Form --}}
                    <div id="form-streetaddress" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Street Address</strong>
                        </div>
                        {{Form::text('street_address', null, ['class' => 'form-control','id' => 'street_address','placeholder' => '宮城県仙台市青葉区本町1-12-12 GMビルディング6F'])}}
                    </div>
                    {{-- StreetAddress Form --}}
                    {{-- BusinessHour Form --}}
                    <div id="form-businesshour" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Bisiness Hour</strong>
                        </div>
                        {{Form::text('business_hour', null, ['class' => 'form-control','id' => 'business_hour','placeholder' => '09:00 - 18:00'])}}
                    </div>
                    {{-- BusinessHour Form --}}
                    {{-- RegularHoliday Form --}}
                    <div id="form-regularholiday" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Regular Holiday</strong>
                        </div>
                        {{Form::text('regular_holiday', null, ['class' => 'form-control','id' => 'regular_holiday','placeholder' => '12'])}}
                    </div>
                    {{-- RegularHoliday Form --}}
                    {{-- Phone Form --}}
                    <div id="form-phone" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Phone</strong>
                        </div>
                        {{Form::text('phone', null, ['class' => 'form-control','id' => 'phone','placeholder' => '000-000-0000'])}}
                    </div>
                    {{-- Phone Form --}}
                    {{-- Fax Form --}}
                    <div id="form-fax" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Fax</strong>
                        </div>
                        {{Form::text('fax', null, ['class' => 'form-control','id' => 'fax','placeholder' => '000-000-0000'])}}
                    </div>
                    {{-- Fax Form --}}
                    {{-- URL Form --}}
                    <div id="form-url" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">URL</strong>
                        </div>
                        {{Form::text('url', null, ['class' => 'form-control','id' => 'url','placeholder' => 'https://grune.co.jp'])}}
                    </div>
                    {{-- URL Form --}}
                    {{-- LicenseNumber Form --}}
                    <div id="form-licensenumber" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">License Number</strong>
                        </div>
                        {{Form::text('license_number', null, ['class' => 'form-control','id' => 'license_number'])}}
                    </div>
                    {{-- LicenseNumber Form --}}
                    {{-- Image Form --}}
                    <div id="form-img" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Image</strong>
                        </div>
                        {{Form::file('image', ['class'=>'custom-file-input','id'=>'image'])}}
                        {{Form::label('fileImage','画像をアップロードして下さい（推奨サイズ：1280px × 720px・容量は5MBまで）',['class'=>'custom-file-label'])}}
                    </div>
                    {{-- Image Form --}}
                    <div id="form-button" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                            <button type="submit" name="submit" id="send" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {{-- Image Form --}}
                    {{ Form::close() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('title', 'User | ' . env('APP_NAME',''))

@section('body-class', 'custom-select')

@section('css-scripts')
@endsection

@section('js-scripts')
<script src="{{ asset('bower_components/bootstrap/js/tooltip.js') }}"></script>
<!-- validationEngine -->
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('js/backend/companies//form.js') }}"></script>
@endsection
