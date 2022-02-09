<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icon.png') }}">
        <link rel="mask-icon" href="{{ asset('img/icon.png') }}" color="#5bbad5">

        <script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>

        <!-- CSS only -->
        <link href="{{ asset('css/boostrap_css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}">
        <link href="{{ asset('css/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datepicker/bootstrap-datepicker.css') }}">
        <link href="{{ asset('css/daterangepicker/daterangepicker.css') }}"  rel="stylesheet">

		<script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}"></script>
		<script src="{{ asset('js/formValidate/jquery.validate.min.js') }}"></script>

        <!-- JavaScript Bundle with Popper -->
        <script src="{{ asset('js/boostrap/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('js/select2/dist/js/select2.js') }}"></script>
        <script src="{{ asset('js/sweetalert2/sweetalert2.min.js') }}"></script>
		<script src="{{ asset('js/toastr/toastr.min.js') }}"></script>

        <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('js/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
        <script defer src="{{ asset('js/fontAwesome/brands.min.js') }}"></script>
        <script src="{{ asset('js/alphaNum/jquery.alphanum.js') }}"></script>
        <script src="{{ asset('js/inputmask/jquery.inputmask.js') }}"></script>
        <script src="{{ asset('js/inputmask/jquery.maskMoney.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <title>{{__('Sales System')}}</title>
    </head>
    <body class="{{Auth::user()->theme_name}}">
        <div class="sidebar">

            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{asset('/')}}">
                            <i class="fa fa-home"></i>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{asset('/users')}}">
                            <i class="fa fa-user"></i>
                            <span>{{ __('Users') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{asset('/products')}}">
                            <i class="fa fa-dollar-sign"></i>
                            <span>{{ __('Products') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{asset('/shopping')}}">
                            <i class="fa fa-shopping-bag"></i>
                            <span>{{ __('shopping') }}</span>
                        </a>
                    </li>
                    @if(Auth::user()->type == 1)
                    <li>
                        <a href="{{asset('/bill')}}">
                            <i class="fas fa-file"></i>
                            <span>{{ __('Bills') }}</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{asset('/logout')}}">
                            <i class="fa fa-power-off"></i>
                            <span>{{ __('Log Out') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <header>
                <div class="menu-bar"><i class="fa fa-list"></i></div>
                <div class="logo-back"></div>
                <div class="logo-site"></div>

                <button class="switch" id="switch">
                    <span class="back"><i class="fa fa-moon"></i></span>
                </button>

                <div class="language-option">
                    @if(App::getLocale() == 'en')

                            <a href="{{asset('/language/es')}}">

                                <span>{{ __('ES') }}</span>
                            </a>

                        @else
                            <a href="{{asset('/language/en')}}">

                                <span>{{ __('EN') }}</span>
                            </a>
                        @endif
                </div>
            </header>
            <main>
                @yield('content')

            </main>
        </div>
    </body>
</html>
<script type="text/javascript">
var rangepicker_apply  = "{{__('Accept')}}";
var rangepicker_cancel = "{{__('Cancel')}}";
var rangepicker_days   = [
    "{{__('Su')}}",
    "{{__('Mo')}}",
    "{{__('Tu')}}",
    "{{__('We')}}",
    "{{__('Th')}}",
    "{{__('Fr')}}",
    "{{__('Sa')}}"
];
var rangepicker_months = [
    "{{__('January')}}",
    "{{__('February')}}",
    "{{__('March')}}",
    "{{__('April')}}",
    "{{__('May')}}",
    "{{__('June')}}",
    "{{__('July')}}",
    "{{__('August')}}",
    "{{__('September')}}",
    "{{__('October')}}",
    "{{__('November')}}",
    "{{__('December')}}"
];
$(document).ready(function() {
    $(".sidebar-menu a").each(function()
    {
        if(this.href==window.location.href)
        {
            $(this).addClass('current');
            $(this).removeAttr('href');
        }
    });
    $('.menu-bar').on('click', function()
    {
        $('.sidebar').toggleClass('hide');
        $('.main-content').toggleClass('large');
    });
    $('#switch').on('click', function(){
        let colorTema;

        let css_theme;

        if ($("body").hasClass('dark-theme') && $('#switch').hasClass('active')) {
            $('body').addClass('light-theme').removeClass('dark-theme');
            colorTema = 'light';
            css_theme = 'light-theme';
            theme_id = 1;
        } else {
            $('body').addClass('dark-theme').removeClass('light-theme');
            colorTema = 'dark';
            css_theme = 'dark-theme';
            theme_id = 2;
        }

        $('#switch').toggleClass('active');

        $.get("{{url('theme')}}/"+ theme_id);

        localStorage.setItem('tema', colorTema);

    });
});
</script>