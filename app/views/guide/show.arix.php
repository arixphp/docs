@extends('layouts.main')

@section('content')
<div class="guide-layout">
    <details class="guide-mobile-menu">
        <summary>Browse documentation</summary>
        @include('guide.navigation')
    </details>
    <div class="guide-desktop-menu">
        @include('guide.navigation')
    </div>
    <article class="guide-content">
        {!! $content !!}
        <nav class="guide-pagination" aria-label="Guide pages">
            @if ($previous)
                <a href="{{ url($previous['url']) }}"><small>Previous</small>{{ $previous['title'] }}</a>
            @endif
            @if ($next)
                <a href="{{ url($next['url']) }}"><small>Next</small>{{ $next['title'] }}</a>
            @endif
        </nav>
    </article>
    <nav class="guide-toc" aria-label="On this page">
        <strong>On this page</strong>
        @foreach ($contents as $heading)
            <a href="#{{ $heading->id }}">{{ $heading->title }}</a>
        @endforeach
    </nav>
</div>
@endsection
