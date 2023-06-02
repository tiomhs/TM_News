@extends('layouts.admin')

@section('main')
{{-- @dd($pages) --}}
@include('sweetalert::alert')
    <section id="page">
        <div class="container-lg">
          <div class="row p-3">
            <div class="col-10">
              <h1 class="mt-4">Users</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Dashboard / Users</li>
              </ol>
              <table class="table border">
                  <thead>
                    <tr>
                      <th scope="col">no</th>
                      <th scope="col" class="col-3">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Is Admin</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)    
                      <tr>
                        <input type="hidden" class="delete_id" value="{{ $user->id }}">
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ($user->is_admin == 0) ? "user" : "admin"; }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td class="d-flex gap-2">
                          {{-- <a href="/admin/pages/edit/{{ $page->slug }}" class="">edit</a> --}}
                          {{-- <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-success">show</a> --}}
                          <button type="button" value="{{ $user->id }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" id="edit" >
                            Edit
                          </button>
                          <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" name="submit" class="btn btn-danger btndelete" > Delete </button>
                          </form>
  
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
    </section>
    

@endsection

{{-- modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  id="modal-body">
        <form action="/admin/users/update" method="post">
          @csrf
          <input type="hidden" name="user_id" id="user_id">
          @method('PUT')
              <div class="mb-3">
                  <input type="hidden" name="id" id="id" >
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                  @error('name')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                  @error('email')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              
              <div class="mb-3">
                  <label for="is_admin" class="form-label">Role</label>
                  <select class="form-select" aria-label="Default select example" name="is_admin" id="is_admin">
                          <option value="0" selected>User</option>
                          <option value="1" selected>Admin</option>
                      
                  </select>
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

<script>
  function onDelete() {
    if (!confirm('Delete?')) {
      event.preventDefault();
    }
  }
</script>

@section('script')
<script>

  $(document).ready(function () {
    $(document).on('click','#edit', function () {
        let user_id = $(this).val();
        // alert(user_id);
        $('#editModal').modal('show');

        $.ajax({
          type: "GET",
          url: "/admin/users/"+ user_id + '/edit',
          success: function (response) {
            // console.log(response);
            $('#user_id').val(response.user.id);
            $('#name').val(response.user.name);
            $('#email').val(response.user.email);
            $('#is_admin').val(response.user.is_admin);
          }
        })
    });
  });
</script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('.btndelete').click(function (e) {
          e.preventDefault();

          var deleteid = $(this).closest("tr").find('.delete_id').val();

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
                          url: '/admin/users/' + deleteid,
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