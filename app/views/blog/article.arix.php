@extends('layouts.main')

@section('content')
<div class="blog-page">
    <a class="blog-back" href="{{ url('/blog') }}">← {{ trans('blog.all') }}</a>
    <div class="blog-article-layout">
        <article class="guide-content blog-content" lang="{{ $contentLanguage }}">{!! $content !!}</article>
        <nav class="guide-toc blog-toc" aria-label="{{ trans('guide.contents') }}">
            <strong>{{ trans('guide.contents') }}</strong>
            @foreach ($contents as $heading)
                <a href="#{{ $heading->id }}">{{ $heading->title }}</a>
            @endforeach
        </nav>
    </div>
</div>
@endsection
