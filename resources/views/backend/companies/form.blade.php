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
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('name', $company->name,array('placeholder' => 'Grune Asia', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'name'))}}
                        @else
                        {{Form::text('name', $company->name,array('placeholder' => 'Grune Asia', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'name'))}}
                        @endif
                        </div>
                    </div>
                    {{-- Name Form End --}}
                    {{-- Email Form --}}
                    <div id="form-email" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Email</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::email('email', $company->email,array('placeholder' => 'info@grune.co.jp', 'class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'email'))}}
                        @else
                        {{Form::email('email', $company->email,array('placeholder' => 'info@grune.co.jp', 'class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'email'))}}
                        @endif
                        </div>
                    </div>
                    {{-- Email Form End --}}
                    {{-- Postcode Form --}}
                    <div id="form-postcode" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Postcode</strong>
                        </div>
                        <div class="postform">
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content postcode">
                                @if($company->page_type == 'create')
                                {{Form::number('postcode', $company->postcode,array('placeholder' => '9800014', 'class' => 'form-control validate[required, maxSize[7]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'postcode'))}}
                                @else
                                {{Form::number('postcode', $company->postcode,array('placeholder' => '9800014', 'class' => 'form-control validate[required, maxSize[7]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'postcode'))}}
                                @endif
                            </div>
                            <button type="button" name="button" class="btn btn-primary api-address">Search</button>
                        </div>
                    </div>
                    {{-- Postcode Form End --}}
                    {{-- Prefecture Form --}}
                    <div id="form-prefecture" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Prefecture</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{ Form::select('prefecture_id', App\Models\Prefecture::selectlist(), ['selected' => $company->prefecture_id], array('class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'prefecture_id')) }}
                        @else
                        {{ Form::select('prefecture_id', App\Models\Prefecture::selectlist(), ['selected' => $company->prefecture_id], array('class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'prefecture_id')) }}
                        @endif
                        </div>
                    </div>
                    {{-- Prefecture Form End --}}
                    {{-- City Form --}}
                    <div id="form-city" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">City</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('city', $company->city, array('placeholder' => '??????????????????', 'class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'city'))}}
                        @else
                        {{Form::text('city', $company->city, array('placeholder' => '??????????????????', 'class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'city'))}}
                        @endif
                        </div>
                    </div>
                    {{-- City Form End --}}
                    {{-- Local Form --}}
                    <div id="form-local" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Local</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('local', $company->local, array('placeholder' => '??????', 'class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'local'))}}
                        @else
                        {{Form::text('local', $company->local, array('placeholder' => '??????', 'class' => 'form-control validate[required, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'local'))}}
                        @endif
                        </div>
                    </div>
                    {{-- Local Form End --}}
                    {{-- Street Address Form --}}
                    <div id="form-streetaddress" class="form-group2">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Street Address</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('street_address', $company->street_address, ['class' => 'form-control','id' => 'street_address','placeholder' => '?????????????????????????????????1-12-12 GM??????????????????6F'])}}
                        @else
                        {{Form::text('street_address', $company->street_address, ['class' => 'form-control','id' => 'street_address','placeholder' => '?????????????????????????????????1-12-12 GM??????????????????6F'])}}
                        @endif
                        </div>
                    </div>
                    {{-- Street Address Form End --}}
                    {{-- Business Hour Form --}}
                    <div id="form-businesshour" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Bisiness Hour</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('business_hour', $company->business_hour, ['class' => 'form-control','id' => 'business_hour','placeholder' => '09:00 - 18:00'])}}
                        @else
                        {{Form::text('business_hour', $company->business_hour, ['class' => 'form-control','id' => 'business_hour','placeholder' => '09:00 - 18:00'])}}
                        @endif
                        </div>
                    </div>
                    {{-- Business Hour Form End --}}
                    {{-- Regular Holiday Form --}}
                    <div id="form-regularholiday" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Regular Holiday</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('regular_holiday', $company->regular_holiday, ['class' => 'form-control','id' => 'regular_holiday','placeholder' => '12'])}}
                        @else
                        {{Form::text('regular_holiday', $company->regular_holiday, ['class' => 'form-control','id' => 'regular_holiday','placeholder' => '12'])}}
                        @endif
                        </div>
                    </div>
                    {{-- Regular Holiday Form End --}}
                    {{-- Phone Form --}}
                    <div id="form-phone" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Phone</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::tel('phone', $company->phone, ['class' => 'form-control','id' => 'phone','placeholder' => '000-000-0000','pattern' => "\d{2,4}-?\d{2,4}-?\d{3,4}"])}}
                        @else
                        {{Form::tel('phone', $company->phone, ['class' => 'form-control','id' => 'phone','placeholder' => '000-000-0000','pattern' => "\d{2,4}-?\d{2,4}-?\d{3,4}"])}}
                        @endif
                        </div>
                    </div>
                    {{-- Phone Form End --}}
                    {{-- Fax Form --}}
                    <div id="form-fax" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Fax</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('fax', $company->fax, ['class' => 'form-control','id' => 'fax','placeholder' => '000-000-0000','pattern' => "\d{2,4}-?\d{2,4}-?\d{3,4}"])}}
                        @else
                        {{Form::text('fax', $company->fax, ['class' => 'form-control','id' => 'fax','placeholder' => '000-000-0000','pattern' => "\d{2,4}-?\d{2,4}-?\d{3,4}"])}}
                        @endif
                        </div>
                    </div>
                    {{-- Fax Form End --}}
                    {{-- URL Form --}}
                    <div id="form-url" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">URL</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::url('url', $company->url, ['class' => 'form-control','id' => 'url','placeholder' => 'https://grune.co.jp'])}}
                        @else
                        {{Form::url('url', $company->url, ['class' => 'form-control','id' => 'url','placeholder' => 'https://grune.co.jp'])}}
                        @endif
                        </div>
                    </div>
                    {{-- URL Form End --}}
                    {{-- License Number Form --}}
                    <div id="form-licensenumber" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">License Number</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        @if($company->page_type == 'create')
                        {{Form::text('license_number', $company->license_number, ['class' => 'form-control','id' => 'license_number'])}}
                        @else
                        {{Form::text('license_number', $company->license_number, ['class' => 'form-control','id' => 'license_number'])}}
                        @endif
                        </div>
                    </div>
                    {{-- License Number Form End --}}
                    {{-- Image Form --}}
                    <div id="form-img" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Image</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            
                        @if($company->page_type == 'create')
                        <div style="width: 250px">
                            {{Form::file('image', array('class'=>'custom-file-input validate[required]','id'=>'image','accept' => 'image/png, image/jpeg,image/jpg ,image/gif','data-prompt-position'=>'inline'))}}      
                        </div>
                        {{Form::label('fileImage','???????????????????????????????????????????????????????????????1280px ?? 720px????????????5MB?????????',['class'=>'custom-file-label', 'id'=>'fileImage'])}}
                        {{-- array('class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11','id' => 'prefecture_id') --}}
                        <div id="upp_img">
                            <img id="img_prv" src="{{ asset('/img/no-image/no-image.jpg') }}">
                            <div class="error-message" id="prompt1"></div>
                        </div>
                        @else
                        <div style="width: 250px">
                            {{Form::file('image', array('class'=>'custom-file-input validate[required]','id'=>'image','accept' => 'image/png, image/jpeg,image/jpg ,image/gif','data-prompt-position'=>'inline'))}}      
                        </div>
                        {{Form::label('fileImage','??????????????????????????????????????????????????????????????????
                        ?????????????????????????????????????????????????????????????????????1280px ?? 720px????????????5MB?????????',['class'=>'custom-file-label br-label', 'id'=>'fileImage'])}}
                        <div id="upp_img">
                            @if($company->extension == 1)
                            <img class="img-responsive" id="img_prv" src="{{ $company->image }}">
                            @else
                            <img id="img_prv" src="{{ asset('/img/no-image/no-image.jpg') }}">
                            @endif
                        </div>
                        @endif
                        </div>
                    </div>
                    {{-- Image Form End --}}
                    <div id="form-button" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                            @if($company->page_type == 'create')
                            <button type="submit" name="submit" id="send" class="btn btn-primary">Submit</button>
                            @else
                            <button type="submit" name="submit" id="send" class="btn btn-primary">Updated</button>
                            @endif
                        </div>
                    </div>
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
<script src="{{ asset('js/backend/companies/form.js') }}"></script>
@endsection
