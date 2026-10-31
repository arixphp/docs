@extends('layouts.main')

@section('content')
        <div class="brand">
            <img src="{{ media('arix-combinationmark.webp') }}" width="750" height="500" alt="ArixPHP" fetchpriority="high" decoding="async">
        </div>
        <h1 id="home-title">Documentation is under construction.</h1>
        <p class="lead">We’re preparing practical guides and references for ArixPHP. Please check back soon.</p>
        <aside class="status" aria-label="Documentation status">
            <span class="status-dot" aria-hidden="true"></span>
            <p class="status-copy">
                <strong>Building the docs</strong>
                New material is on its way.
            </p>
        </aside>
@endsection
