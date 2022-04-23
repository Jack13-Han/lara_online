@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Edit Post
                    </div>

                    <div class="card-body">
                        <form action="{{route('post.update',$post->id)}}"  id="updateForm" method="post">
                            @csrf
                            @method('put')
                        </form>

                        <x-input input-title="Post Title" form-id="updateForm" value="{{$post->title}}" name="title"></x-input>
{{--                            <div class="mb-3">--}}
{{--                                <label for="" class="form-label">Post Title</label>--}}
{{--                                <input type="text" form="updateForm" class="form-control @error('title') is-invalid @enderror " value="{{ old('title',$post->title) }}" name="title">--}}

{{--                                @error('title')--}}
{{--                                <p class="text-danger small">{{$message}}</p>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

                            <div class="mb-3">
                                <label for="" class="form-label">Select Category</label>
                                <select form="updateForm" class="form-select @error('category') is-invalid @enderror " name="category">
                                    @foreach(\App\Models\Category::all() as $categories)
                                        <option value="{{$categories->id}}" {{$categories->id == old('category',$post->category_id) ? "selected":""  }} >{{$categories->title}}</option>

                                    @endforeach
                                </select>

                                @error('category')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>



                        <div class="mb-3">
                            <label for="" class="form-label">Select Tag</label>
                            <br>
                            @foreach(\App\Models\Tag::all() as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" form="updateForm" type="checkbox" value="{{$tag->id}}" name="tags[]"  id="tag{{$tag->id}}" {{ in_array($tag->id,old('tags',$post->tags->pluck('id')->toArray())) ? 'checked' : '' }} >
                                    <label class="form-check-label" for="tag{{$tag->id}}">
                                        {{$tag->title}}
                                    </label>
                                </div>
                            @endforeach


                            @error('tags')
                            <p class="text-danger small">{{$message}}</p>
                            @enderror

                            @error('tags.*')
                            <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>


{{--                            photo start--}}

                            <div class="mb-3">
                                <label for="" class="form-label">Photo</label>
                                <div class="border rounded p-3 d-flex flex-wrap">

                                    <form action="{{route('photo.store')}}" id="photoUploadForm" class="d-none" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{$post->id}}">

                                        <div class="mb-3">
                                            <label for="" class="form-label">Photo </label>
                                            <input type="file" id="photoInput" class="form-control  @error('photo') is-invalid @enderror "  name="photos[]" accept="image/png,image/jpeg" multiple>

                                            @error('photo')
                                            <p class="text-danger small">{{$message}}</p>
                                            @enderror
                                        </div>

                                        <button class="btn btn-sm btn-primary">Upload</button>


                                    </form>

                                    <div class="border border-2 border-dark rounded-3 uploader-ui d-flex justify-content-center align-items-center me-3"  id="photoUploadUi">
                                        <i class="fas fa-plus fa-2x text-primary"></i>
                                    </div>


                                    @forelse($post->photos as $photo)
                                        <div class="position-relative">

                                            <form action="{{route('photo.destroy',$photo->id)}}" class="position-absolute bottom-0 start-0" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>


                                            <div class="">
                                                <a class="venobox" data-gall="img{{$post->id}}" href="{{asset('storage/photo/'.$photo->name)}}">
                                                    <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="100" class="rounded me-3" alt="image alt"/>
                                                </a>
                                            </div>

                                        </div>
                                    @empty
                                        <p class="text-black-50">No Photo</p>
                                    @endforelse
                                </div>
                            </div>

{{--                            end photo form--}}

                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea form="updateForm" class="form-control @error('description') is-invalid @enderror" rows="8" name="description" >{{ old('description',$post->description) }}</textarea>

                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center" form="updateForm">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Confirm</label>
                                </div>

                                <button class="btn btn-sm btn-primary" form="updateForm">Update Post</button>
                            </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>

    <script>

        let photoUploadForm = document.getElementById('photoUploadForm');
        let photoInput = document.getElementById('photoInput');
        let photoUploadUi = document.getElementById('photoUploadUi');

        photoUploadUi.addEventListener("click",function (){
            photoInput.click()
        })

        photoInput.addEventListener('change',function (){
            photoUploadForm.submit();
        })

        @if(session('status'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{session('status')}}'
        })
        @endif


    </script>


@endsection
