@extends('layouts.main')

@section('content')
<section class="home-hero">
    <div>
        <h1>Build for the web.<br><span>Deploy with confidence.</span></h1>
        <p class="home-lead">Arix is a PHP framework for building thoughtful websites and deploying them on traditional hosting. Bring your ideas, not a build pipeline.</p>
        <div class="home-actions"><a class="button-primary" href="{{ url('/guide/installation') }}">Get Started <span aria-hidden="true">→</span></a><a class="button-secondary" href="{{ url('/guide/') }}">Explore the documentation</a></div>
    </div>
    <div class="home-code"><div class="code-heading"><span>YOUR FIRST APPLICATION</span><span>Terminal</span></div><pre><code>arix new my-site
cd my-site
arix dev</code></pre><p>From a fresh idea to a local application.</p></div>
</section>
<section class="home-overview">
    <div><h2>Everything you need to get started.</h2><p>Write your application in PHP, with a familiar structure and tools that stay out of your way.</p></div>
    <div class="feature-list"><div><h3>A familiar foundation</h3><p>Routes, controllers, views, and translations give your project a clear place to grow.</p></div><div><h3>Made for traditional hosting</h3><p>Deploy your application without installing Composer, Node, or frontend build tools on the server.</p></div><div><h3>A capable development companion</h3><p>The Arix CLI helps you create, run, test, and maintain your application.</p></div></div>
</section>
<section class="home-next"><h2>Ready to build something?</h2><p>Start with the essentials, then find the details when you need them.</p><a class="button-primary" href="{{ url('/guide/') }}">Read the guide <span aria-hidden="true">→</span></a></section>
@endsection
