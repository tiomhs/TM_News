@extends('layouts.admin')

@section('main')
{{-- @dd($pages) --}}
@include('sweetalert::alert')
    <section id="page">
        <div class="container px-4">
          <div class="row p-3">
            <div class="col-6">
              <h1 class="mt-4">Categories</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Dashboard / Categories</li>
              </ol>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create New Category
            </button>
            <table class="table border mt-2">
                <thead>
                  <tr>
                    <th scope="col">no</th>
                    <th scope="col" class="col-3">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)    
                    <tr>
                      <input type="hidden" class="delete_slug" value="{{ $category->slug }}">
                      <th>{{ $loop->iteration }}</th>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->slug }}</td>
                      <td>
                        <div class="row gap-2">
                          <div class="col-3">
                            <button type="button" value="{{ $category->id }}" class="btn btn-primary d-inline" data-bs-toggle="modal" data-bs-target="#editCategory" id="editCategory">
                              Edit
                            </button>
                          </div>
                          <div class="col-3">
                            <form action="{{ route('categories.destroy', $category->slug) }}" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" name="submit" class="btn btn-danger btndelete" > Delete </button>
                            </form>
                          </div>
                        </div>
                        {{-- <a href="/admin/categories/edit/{{ $category->slug }}" class="">edit</a>
                        <a href="/admin/categories/{{ $category->slug }}" class="btn btn-success">show</a> --}}
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          </div>
        </div>
    </section>
    

    <!-- Modal -->
    {{-- create --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Title</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit"name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>
    
    @endsection

    {{-- edit --}}
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/admin/categories/update" method="post">
              @csrf
              <input type="hidden" name="cat_id" id="cat_id">
              @method('PUT')
              <div class="mb-3">
                  <label for="name" class="form-label">Title</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameCat" name="name" required value="{{ old('name') }}">
                  @error('name')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    



@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

  $(document).ready(function () {
    $(document).on('click','#editCategory', function () {
        let catId = $(this).val();
        // alert(catId); return false;
        $('#editModal').modal('show');

        $.ajax({
          type: "GET",
          url: "/admin/categories/"+ catId + "/edit",
          success: function (response) {
            // console.log(response.category.id);return false;
            $('#cat_id').val(response.category.id);
            $('#nameCat').val(response.category.name);
          }
        })
    });
  });
</script>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_slug').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan Tag ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        
                        $.ajax({
                            type: "DELETE",
                            url:'categories/' +  deleteid,
                            data: data,
                            success: function (response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });

    });

</script>
@endsection