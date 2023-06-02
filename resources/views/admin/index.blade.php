@extends('layouts.admin')

@section('main')
<main>
    {{-- @dd($res) --}}
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            @foreach ($res as $oh)
            {{-- @dd($oh) --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <div class="card-body fs-3">{{ $oh['name'] }}</div>
                            <div class="btn  btn-danger">{{ $oh['total'] }}</div>   
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between p-3">
                            <a class="small text-white stretched-link" href="{{ $oh['link'] }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection

