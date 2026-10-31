@extends('layouts.main')

@section('content')
<div class="guide-layout">
    <details class="guide-mobile-menu">
        <summary>{{ trans('guide.browse') }}</summary>
        @include('guide.navigation')
    </details>
    <div class="guide-desktop-menu">
        @include('guide.navigation')
    </div>
    <article class="guide-content">
        <div lang="{{ $contentLanguage }}">{!! $content !!}</div>
        <nav class="guide-pagination" aria-label="{{ trans('guide.pages') }}">
            @if ($previous)
                <a href="{{ url($previous['url']) }}"><small>{{ trans('guide.previous') }}</small>{{ trans('guide.titles.' . $previous['slug']) }}</a>
            @endif
            @if ($next)
                <a href="{{ url($next['url']) }}"><small>{{ trans('guide.next') }}</small>{{ trans('guide.titles.' . $next['slug']) }}</a>
            @endif
        </nav>
    </article>
    <nav class="guide-toc" aria-label="{{ trans('guide.contents') }}">
        <strong>{{ trans('guide.contents') }}</strong>
        @foreach ($contents as $heading)
            <a href="#{{ $heading->id }}">{{ $heading->title }}</a>
        @endforeach
    </nav>
</div>
@endsection
