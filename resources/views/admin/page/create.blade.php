@extends('layouts.admin')

@section('main')
{{-- @dd($num) --}}
    <div class="container">
        <div class="row p-3">
            <div class="col-8">
                <h2 class="mb-3">Tambah Data Page</h2>
                <form action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                @if ( old('category_id') == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <img class="img-preview img-fluid">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <h6>Featured Article</h6>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="hidden" id="valueFeat" value="{{ $num }}">
                                <input class="form-check-input" type="radio" name="featured" id="featuredTrue" value="1"  disabled>
                                <label class="form-check-label" for="flexRadioDefault1">
                                  ya
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="featured" id="featured" value="0" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                  tidak
                                </label>
                            </div>
                        </div>
                        <p class="text-danger d-none" id="messageFeat">Maaf article sudah ada 4, mohon hapus postingan terlebih dahulu</p>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        @error('body')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="hidden" class="form-control" id="body" name="body" required value="{{ old('body') }}" value="{{ old('body') }}">
                        <trix-editor input="body"></trix-editor>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function() {
            const num = $('#valueFeat').val();
            if (num < 4) {
                $("#featuredTrue").removeAttr("disabled");   
            }else{
                $("h6").after("<p style='color:red;margin-bottom=:0;'>Featured Article is already 4 !!!!</p>");
            }
         });
        // const title = document.querySelector('#title');
        // const slug = document.querySelector('#slug');

        // // title.addEventListener('change', function() {
        // //     fetch('checkSlug?title = ' + title.value)
        // //         .then(response => response.json())
        // //         .then(data => slug.value = data.slug)
        // // });
       

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>    
    @endsection
    
@endsection