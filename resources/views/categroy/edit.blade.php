@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Edit Category
                    </div>

                    <div class="card-body">
                        <form action="{{route('category.update',$category->id)}}" method="post">
                            @method('put')
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-6 col-lg-3">
                                    <label for="" class="form-label">Update Category Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror " value="{{ old('title',$category->title) }}" name="title">
                                </div>

                                <div class="col-6 col-lg-3">
                                    <button class="btn btn-primary">Update Category</button>
                                </div>
                            </div>

                            @error('title')
                            <p class="text-danger small">{{$message}}</p>
                            @enderror

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
