@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Create Post
                    </div>

                    <div class="card-body">
                        <form action="{{route('post.store')}}" enctype="multipart/form-data"  method="post">
                            @csrf

                            <x-input input-title="Post Title" name="title"></x-input>

                            <div class="mb-3">
                                <label for="" class="form-label">Select Category</label>
                                <select  class="form-select @error('category') is-invalid @enderror " name="category">
                                    @foreach(\App\Models\Category::all() as $categories)
                                    <option value="{{$categories->id}}" {{$categories->id == old('category') ? "selected":""  }} >{{$categories->title}}</option>

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
                                    <input class="form-check-input" type="checkbox" value="{{$tag->id}}" name="tags[]" id="tag{{$tag->id}}" {{ in_array($tag->id,old('tags',[])) ? 'checked' : '' }} >
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


                            <div class="mb-3">
                                <label for="" class="form-label">Photo </label>
                                <input type="file" class="form-control @error('phoxtos') is-invalid @enderror " name="photos[]" accept="image/png,image/jpeg" multiple>

                                @error('photos')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror

                                @error('photos.*')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="8" name="description" >{{ old('description') }}</textarea>

                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Confirm</label>
                                </div>

                                <button class="btn btn-sm btn-primary">Add Post</button>
                            </div>
                        </form>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
