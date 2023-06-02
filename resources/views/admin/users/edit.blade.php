@extends('layouts.admin')

@section('main')
    <div class="container">
        <h1>Edit Data Page</h1>
        @foreach ($user as $u)      
        <form action="{{ route('users.update',$u->id) }}" method="post">
            @csrf
            @method('PUT');
                <div class="mb-3">
                    <input type="hidden" name="id" id="id" value="{{ $u->id }}">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name', $u->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email',$u->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- @dd($categories) --}}
                <div class="mb-3">
                    <label for="is_admin" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" name="is_admin" id="is_admin">
                        
                            {{-- @if ( old('is_admin', $u->is_admin) == $u->id)
                                <option value="0" selected>User</option>
                            @else
                                <option value="1">Admin</option>
                            @endif --}}
                            <option value="0" selected>User</option>
                            <option value="1" selected>Admin</option>
                        
                    </select>
                </div>
               
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            @endforeach
        </form>
    </div>
    <script>

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
@endsection