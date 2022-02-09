
@extends('layouts.login')
@section('content')
        <div id="login-box">
            {{ Form::open(['id' => 'formlogin', 'class' => 'form' , 'autocomplete' => 'Off']) }}

                <img class="logo-login" src="{{ asset('img/logo.jpg') }}" />

                <h3 class="text-center mt-3 p-4">{{ __('Login') }}</h3>

                <div class="input-group login-form mb-3 ps-3 pe-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                   {{ Form::text('username', null, ['class' => 'form-control','placeholder' => __('Username'), 'id'=> 'username'])}}
                </div>

                <div class="input-group login-form mb-3 ps-3 pe-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    {{ Form::password('password', ['class' => 'form-control','placeholder' => __('Password'), 'id'=> 'password'])}}
                </div>
                <div class="inputBox d-grid gap-2 col-6 mx-auto mb-1">
                    {{ Form::submit(__('Login'), ['class' => 'btn btn-primary', 'id' => 'submit']) }}
                </div>
            {{ Form::close() }}
        </div>
@if(Session::has('msg'))
    <script type="text/javascript">
    toastr['{{ Session::get('msg')['type'] }}']('{{ Session::get('msg')['message'] }}', '{{ Session::get('msg')['tittle'] }}',{
        "progressBar": false,
        "onclick": null,
        "positionClass": "toast-top-right"
    });
    </script>
@endif
@endsection