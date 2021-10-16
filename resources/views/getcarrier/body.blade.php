<body id="wrapper__body">
{{--    {!! $settings->tracking->body !!}--}}
    @include('getcarrier.header')
    <div id="wrapper__content">@if (trim($__env->yieldContent('content')))@yield('content')@endif</div>
    @include('getcarrier.footer')
    @include('getcarrier.inc.js')
    @if (trim($__env->yieldContent('js')))@yield('js')@endif{{"\n"}}
</body>
