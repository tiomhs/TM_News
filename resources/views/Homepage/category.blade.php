@extends('layouts.main')
@section('main')

{{-- @dd($request)   --}}
    <div class="container">
      <section id="categories">
        <div class="row mt-3">
            <h2>Categories <span class="fw-bold"> "{{ $name[0]->name }}"</span></h2>
            @foreach ($category as $page)
            <div class="col-md-4 col-12  my-2">
                <div class="card">
                  <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text"><a href="homepage/categories/{{ $page->category->id }}">{{ $page->category->name }}</a><span class="ms-2">{{ $page->created_at }}</span></p>
                    <h4 class="card-title"><a href="{{ url('homepage/page/'.$page->slug) }}" class="text-dark text-decoration-none">{{ $page->title }}</a></h4>
                    <p class="card-text">{{ Str::limit(strip_tags($page->body), 100) }} </p>
                  </div>
                </div>
            </div>
            @endforeach
        </div>
      </section>
    </div>
@endsection