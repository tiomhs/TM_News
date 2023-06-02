@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="search">
            <div class="row mt-3">
                <h2>Search "{{ $search }}"</h2>
                <div class="col-lg-9">
                    @foreach($pages as $page)
                    <div class="row border-bottom py-2">
                        <div class="col-3 d-flex align-items-center">
                            @if ($page->image == null)
                                <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="img-fluid rounded-3" alt="..." style="width: 100%">
                            @else
                                <img src="{{ asset('storage/' . $page->image) }}" class="img-fluid rounded-3" alt="..." style="width: 100%">
                            @endif
                        </div>
                        <div class="col-9">
                            <h3 class=" "><a href="{{ url('/homepage/page/'. $page->slug) }}" class="text-decoration-none text-dark"> {{ $page->title }}</a></h3>
                            <p class="m-0"><a href="/homepage/categories/{{ $page->category->id }}">{{ $page->category->name }}</a><span class="ms-2">{{ $page->created_at }}</span></p>
                            <p>{{ strip_tags(Str::limit($page->body, 200)) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-6 mt-2 ">
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
    </div>
@endsection