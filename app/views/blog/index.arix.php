@extends('layouts.main')

@section('content')
<div class="blog-index">
    <header class="blog-intro">
        <h1>{{ trans('blog.title') }}</h1>
        <p>{{ trans('blog.intro') }}</p>
    </header>
    <section class="blog-list" aria-label="{{ trans('blog.title') }}">
        @foreach ($articles as $article)
        <article class="blog-entry">
            <div class="blog-entry-category"><time datetime="{{ $article['publishedAt'] }}">{{ $article['publishedAt'] }}</time></div>
            <div>
                <h2><a href="{{ url('/blog/' . $article['slug']) }}">{{ $article['title'] }}</a></h2>
                <p>{{ $article['excerpt'] }}</p>
                <a class="blog-read" href="{{ url('/blog/' . $article['slug']) }}">{{ trans('blog.read') }} @include('components.icons.arrow-right')</a>
            </div>
        </article>
        @endforeach
    </section>
</div>
@endsection
