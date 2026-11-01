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
    <div class="home-code">
        <div class="code-heading"><span>{{ trans('home.first_app') }}</span><span>Terminal</span></div>
        <pre><code>arix new my-site
cd my-site
arix dev</code></pre>
        <p>{{ trans('home.code_caption') }}</p>
    </div>
</section>

<section class="home-overview">
    <div>
        <h2>{{ trans('home.overview_title') }}</h2>
        <p>{{ trans('home.overview_text') }}</p>
    </div>
    <div class="feature-list">
        <div>
            <h3>{{ trans('home.feature_one_title') }}</h3>
            <p>{{ trans('home.feature_one') }}</p>
        </div>
        <div>
            <h3>{{ trans('home.feature_two_title') }}</h3>
            <p>{{ trans('home.feature_two') }}</p>
        </div>
        <div>
            <h3>{{ trans('home.feature_three_title') }}</h3>
            <p>{{ trans('home.feature_three') }}</p>
        </div>
    </div>
</section>

<section class="home-next">
    <h2>{{ trans('home.next_title') }}</h2>
    <p>{{ trans('home.next_text') }}</p><a class="button-primary" href="{{ url('/guide/') }}">{{
        trans('home.read_guide') }} <span aria-hidden="true">→</span></a>
</section>
@endsection