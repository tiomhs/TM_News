@extends('layouts.main')
@section('main')
    {{-- @dd($singlePage); --}}
    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-9">
          @foreach($singlePage as $page)
            <h2 class=" text-start">{{ $page->title }}</h2>
            <p class="m-0  text-start"><a href="/homepage/categories/{{ $page->category->id }}">{{ $page->category->name }}</a><span class="ms-2">{{ $page->created_at }}</span></p>
            @if ($page->image == null)
                <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="card-img-top m-auto" alt="..." width="100">
              @else
                <img src="{{ asset('storage/' . $page->image) }}" class="card-img-top m-auto w-100" alt="..." style="height:30%">
              @endif
            <p class="fs-5 text-justify">{!! $page->body !!}</p> 
            <hr>
            <div class="coment">
              <div class="row m-1">
                <div class="col-lg-6 col-md-8 col-10 bg-white border border-radius">
                  <form action="{{ route('store') }}" method="POST">
                    @csrf
                      @if (!Auth::guest())
                      <div class="mb-3">
                        <input type="hidden" value="{{ $page->id }}" name="page_id">
                        <label for="comment" class="form-label fs-4 fw-bold">Komentar</label>
                        <input type="text" class="form-control" id="comment" name="comment">
                        <button type="submit" class="btn btn-primary mt-2 btn-sm-sm">Submit</button>
                      </div>
                      @else
                      <p>Silahkan <a href="/login">login</a> atau <a href="/register">register</a> terlebih dahulu</p>  
                      @endif
                  </form>
                </div>
              </div>
              <hr>
              <div class="row mt-3 justify-content-start ">
                <h4 class="fw-bold">Comments</h4>
                @foreach($singlePage as $page)
                  @php
                      $page = $page->coment
                  @endphp
                      @foreach ($page as $p)
                      <div class="col-lg-1 col-md-2 col-3  d-flex justify-content-end align-items-start rounded-circle">
                        <img src="https://ui-avatars.com/api/?name={{ $p->user->name }}" alt="" style="width:100%" class="rounded-circle">
                      </div>
                      <div class="col-lg-9 col-md-8 col-9">
                          <h6 class="m-0">{{ $p->user->name }}</h6>
                          <small>{{ $p->created_at->diffForHumans() }}</small>
                          <p>{{ $p->coment }}</p>
                          <hr>
                      </div>
                      <div class="col-lg-2 "></div>
                        @endforeach
                  @endforeach
              </div>
            </div>
          @endforeach
        </div>
        <div class="col-lg-3 col-8 ">
          <div class="row">
            <div class="col bg-white rounded-3 p-3">
              <h4 class="border-bottom">Hottest Category</h4>
              <ul class="list-group list-group-flush .list-group-numbered">
              @foreach ($categories as $category)
                  <li class="list-group-item text-decoration-none border-none"><h5><a href="/homepage/categories/{{ $category->id }}" class="text-dark text-decoration-none">{{ $loop->iteration . '.' }} {{$category->name }}</a></h5></li>
              @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection