@extends('layouts.main')

@section('content')
<section class="home-hero">
    <div>
        <h1>{{ trans('home.hero_first') }}<br><span>{{ trans('home.hero_second') }}</span></h1>
        <p class="home-lead">{{ trans('home.lead') }}</p>
        <div class="home-actions">
            <a class="button-primary" href="{{ url('/guide/installation') }}">
                {{ trans('home.get_started') }}
            </a>
            <a class="button-secondary" href="{{ url('/guide/') }}">
                {{ trans('home.explore') }}
            </a>
        </div>
    </div>
    @include('partials.printing-press')
</section>

<section class="home-overview">
    <div>
        <h2>{{ trans('home.overview_title') }}</h2>
        <p>{{ trans('home.overview_text') }}</p>
    </div>
    <div class="feature-list">
        <div>
            <h3><a href="{{ url('/guide/http') }}">{{ trans('home.feature_one_title') }}</a></h3>
            <p>{{ trans('home.feature_one') }}</p>
        </div>
        <div>
            <h3><a href="{{ url('/guide/markdown') }}">{{ trans('home.feature_markdown_title') }}</a></h3>
            <p>{{ trans('home.feature_markdown') }}</p>
        </div>
        <div>
            <h3><a href="{{ url('/guide/views') }}">{{ trans('home.feature_views_title') }}</a></h3>
            <p>{{ trans('home.feature_views') }}</p>
        </div>
        <div>
            <h3><a href="{{ url('/guide/assets') }}">{{ trans('home.feature_frontend_title') }}</a></h3>
            <p>{{ trans('home.feature_frontend') }}</p>
        </div>
        <div>
            <h3><a href="{{ url('/guide/localization') }}">{{ trans('home.feature_localization_title') }}</a></h3>
            <p>{{ trans('home.feature_localization') }}</p>
        </div>
        <div>
            <h3><a href="{{ url('/guide/deployment') }}">{{ trans('home.feature_deployment_title') }}</a></h3>
            <p>{{ trans('home.feature_deployment') }}</p>
        </div>
    </div>
</section>

<section class="home-next">
    <h2>{{ trans('home.next_title') }}</h2>
    <p>{{ trans('home.next_text') }}</p>
    <a class="button-primary" href="{{ url('/guide/') }}">{{
        trans('home.read_guide') }}
        @include('components.icons.arrow-right')
    </a>
</section>
@endsection
