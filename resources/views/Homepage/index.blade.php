@extends('layouts.main')

@section('main')
{{-- @dd($categories) --}}
    <section id="featured">
      <div class="container">
        <h2 class="m-4 mb-2 mx-0 fw-bold">Featured News</h2>
        <div class="row justify-content-center align-items-center">
          <div class="col-md-7 mb-4">
            {{-- @dd($feats); --}}
            @if ($feats->count() )
              <div class="card">
                @if ($feats[0]->image == null)
                  <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="card-img-top m-auto" alt="..." style="width: 60%">
                @else
                  <img src="{{ asset('storage/' . $feats[0]->image) }}" class="card-img-top m-auto w-100" alt="..." style="width:40%">
                @endif
                <div class="card-body">
                  <p class="card-text">{{ $feats[0]->created_at }}</p>
                  <h4 class="card-title"><a href="{{ url('homepage/page/'.$feats[0]->slug) }}" class="text-dark text-decoration-none">{{ $feats[0]->title }}</a></h4>
                  <p class="m-0"><a href="homepage/categories/{{ $feats[0]->category->id }}" class="me-2">{{ $feats[0]->category->name }}</a>{{  $feats[0]->created_at->diffForHumans() }}</p>
                  <p class="card-text">{{ strip_tags(Str::limit($feats[0]->body, 200)) }}</p>
                </div>
              </div>
            @endif
          </div>
          <div class="col-md-5">
            @foreach($feats->skip(1) as $feat)
            <div class="row border-bottom">
              <div class="col-4 py-2">
                @if ($feat->image == null)
                  <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="card-img-top" alt="..." style="width: 100%">
                @else
                  <img src="{{ asset('storage/' . $feat->image) }}" class="card-img-top" alt="..." style="width: 100%">
                @endif
              </div>
              <div class="col-8">
                  <p class="m-0">{{ $feat->created_at }}</p>
                  <h4 class="card-title"><a href="{{ url('homepage/page/'.$feat->slug) }}" class="text-dark text-decoration-none">{{ $feat->title }}</a></h4>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <section id="news">
      <div class="container">
        <h2 class="m-4 mb-2 mx-0 fw-bold">Latest News</h2>
        <div class="row">
            @foreach ($pages as $page)
            {{-- @dd($page); --}}
            <div class="col-md-4 my-2">
                <div class="card">
                  @if ($page->image == null)
                    <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="card-img-top" alt="..." >
                  @else
                    <img src="{{ asset('storage/' . $page->image) }}" class="card-img-top" alt="...">
                  @endif
                  <div class="card-body">
                    <p class="card-text"><a href="homepage/categories/{{ $page->category->id }}">{{ $page->category->name }}</a><span class="ms-2">{{ $page->created_at }}</span></p>
                    <h4 class="card-title"><a href="{{ url('homepage/page/'.$page->slug) }}" class="text-dark text-decoration-none">{{ $page->title }}</a></h4>
                    <p class="card-text">{{ Str::limit(strip_tags($page->body), 100) }} </p>

                  </div>
                </div>
            </div>
            @endforeach
          </div>  
          <div class="d-flex justify-content-center">
            {{ $pages->links() }}
          </div>
      </div>
    </section>
@endsection