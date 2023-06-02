@extends('layouts.admin')

@section('main')
<div class="container px-4">
    <div class="row mt-4">
        <div class="col-10">
            @foreach ($page as $p)
            <h4>{{ $p->title }}</h4>
            @if($p->image)
                <div>
                    <img src="{{ asset('storage/' . $p->image) }}"  class="d-block w-100 text-center"  alt="">
                </div>
            @else
                <div>
                    <img src="{{ asset('storage/post-images/no-image.jpg') }}" class="d-block w-100"  alt="">
                </div>
            @endif
                <div class="row mt-2">
                    <div class="col-3"><a href="/admin/pages" class="text-white btn btn-warning w-100"><i class="fa-solid fa-arrow-left"></i> Back</a></div>
                    <div class="col-3"><a href="/admin/pages/edit/{{ $p->slug }}" class="btn btn-success w-100"><i class="fa-solid fa-pen"></i> Edit</a></div>
                    <div class="col-3"><form action="{{ route('page.delete', $p->slug) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" name="submit" class="btn btn-danger w-100" onclick="onDelete()"><i class="fa-solid fa-trash"></i> Delete </button>
                    </form></div>
                    
                    
                    
                </div>
            <h4 class="d-inline"><a href="/homepage/categories/{{ $p->category->id }}">{{ $p->category->name }}</a></h4>
            <h4 class="d-inline">{{ $p->created_at->diffForHumans() }}</h4>
            <p>{!! $p->body !!}</p>
            @endforeach
        </div>
    </div>
</div> 
@endsection

<script>
    function onDelete() {
      if (!confirm('Delete?')) {
        event.preventDefault();
      }
    }
</script>