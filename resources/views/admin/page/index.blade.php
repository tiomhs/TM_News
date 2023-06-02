@extends('layouts.admin')

@section('main')

    <section id="page">
        <div class="container-fluid px-4">
          <div class="row justify-content-start">
            <div class="col-10">
              <h1 class="mt-4">Pages</h1>
              <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Dashboard / Pages</li>
              </ol>
                <a href="/admin/pages/create" class="btn btn-primary mb-2">Create New Post</a>
                <table class="table text-center border">
                  <thead>
                    <tr>
                      <th scope="col">no</th>
                      <th scope="col" class="col-3">Title</th>
                      <th scope="col" class="col-3">Category</th>
                      <th scope="col" >Featured Image</th>
                      <th scope="col" class="col-6">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($pages as $page)    
                      <tr>
                        <input type="hidden" class="delete_slug" value="{{ $page->slug }}">
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->category->name }}</td>  
                        <td>
                          
                            @if ($page->featured == '0') 
                              <h2 class="text-danger">X</h2> 
                            @else 
                              <h2 class="text-success">O</h2>
                            @endif
                         
                        </td>      
                        <td>
                          <div class="row justify-content-center gap-2">
                            <div class="col-2">
                              <a href="/admin/pages/edit/{{ $page->slug }}" class="btn btn-warning text-white">edit</a>
                            </div>
                            <div class="col-2">
                              <a href="/admin/pages/{{ $page->slug }}" class="btn btn-success">show</a>
                            </div>
                            <div class="col-2">
                              <form action="{{ route('page.delete', $page->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="image" value="{{ $page->image }}">
                                <button type="submit" name="submit" class="btn btn-danger btndelete"  > Delete </button>
                              </form>
                            </div>
                          </div>
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


@section('script')
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
                          'slug': deleteid,
                      };
                      $.ajax({
                          type: "DELETE",
                          url: '/admin/pages/delete/' + deleteid,
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