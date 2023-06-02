@extends('layouts.main')
@section('main')

{{-- @dd($categories)   --}}
    <div class="container">

        <h1 class="fw-bold mt-4">Category</h1>
        <div class="row my-4">
            @foreach($categories as $category)
            <div class="col-4 mb-4">
                <div class="kotak-categories border p-4 rounded text-center fw-bold shadow">
                    <a href="categories/{{ $category->id }}" class="text-decoration-none text-white fs-5 ">{{ $category->name }}</a>
                </div>
            </div>
            @endforeach
        </div>
            
    </div>
@endsection