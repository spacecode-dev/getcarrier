<head>
{{--{!! $settings->tracking->head !!}--}}
{{--{!! $settings->favicon !!}--}}
    <!-- Robots -->
{{--@if(!get_setting('hide_from_index'))--}}
{{--    <meta name="robots" content="@yield('robotsAll')">--}}
{{--    <meta name="googlebot" content="@yield('robotsGoogle')">--}}
{{--    <meta name="yandex" content="@yield('robotsYandex')">--}}
{{--    <meta name="bingbot" content="@yield('robotsBing')">--}}
{{--    <meta name="duckduckbot" content="@yield('robotsDuck')">--}}
{{--    <meta name="baiduspider" content="@yield('robotsBaidu')">--}}
{{--    <meta name="slurp" content="@yield('robotsYahoo')">--}}
{{--@else--}}
    <meta name="robots" content="noindex, nofollow">
{{--@endif--}}

    <!-- Index -->
{{--    <meta name="document-state" content="@yield('documentState')">--}}

    <!-- Metatags custom -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
{{--    <meta name="author" content="{{ $settings->author->title }}">--}}
{{--    <link rel="author" href="{{ $settings->author->link }}">--}}
{{--    <link rel="me" href="{{ $settings->me }}">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--@if(trim($__env->yieldContent('parent')))    <link rel="up" href="@yield('parent')">{{"\n"}}@endif--}}
{{--@if(trim($__env->yieldContent('paginationFirst')))    <link rel="first" href="@yield('paginationFirst')">{{"\n"}}@endif--}}
{{--@if(trim($__env->yieldContent('paginationLast')))    <link rel="last" href="@yield('paginationLast')">{{"\n"}}@endif--}}
{{--@if(trim($__env->yieldContent('paginationNext')))    <link rel="next" href="@yield('paginationNext')">{{"\n"}}@endif--}}
{{--@if(trim($__env->yieldContent('paginationPrev')))    <link rel="prev" href="@yield('paginationPrev')">{{"\n"}}@endif--}}
{{--    <link rel="canonical" href="{{ url()->current() }}"/>--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS -->
    @include('getcarrier.inc.css')
    @if (trim($__env->yieldContent('css')))@yield('css'){{"\n"}}@endif

    <!-- MetaTags -->
{{--    <title>@yield('metaTitle')</title>{{"\n"}}--}}
{{--@if (trim($__env->yieldContent('metaDescription')))    <meta name="description" content="@yield('metaDescription')">{{"\n"}}@endif--}}
{{--@if (trim($__env->yieldContent('metaKeywords')))    <meta name="keywords" content="@yield('metaKeywords')">{{"\n"}}@endif--}}
</head>
