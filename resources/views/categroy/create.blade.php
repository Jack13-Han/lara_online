@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Create Category
                    </div>

                    <div class="card-body">
                        <form action="{{route('category.store')}}" class="mb-4" method="post">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-6 col-lg-3">
                                    <label for="" class="form-label">Category Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror " value="{{ old('title') }}" name="title">
                                </div>

                                <div class="col-6 col-lg-3">
                                    <button class="btn btn-primary">Add Category</button>
                                </div>
                            </div>

                            @error('title')
                            <p class="text-danger small">{{$message}}</p>
                            @enderror

                        </form>


                        <table class=" table table-hover table-bordered align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created</th>

                            </tr>
                            </thead>
                            @forelse($categories as $category)

                                <tbody>
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>
                                        {{$category->user->name ?? "Unknown User "}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{route('category.destroy',$category->id)}} " method="post" >
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash fa-fw"></i>
                                                </button>
                                            </form>

                                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                        </div>

                                    </td>
                                    <td>
                                        <p class="mb-0 small">
                                            <i class="fas fa-calendar text-primary"></i>
                                            {{$category->created_at->format("d-M-Y")}}
                                        </p>

                                        <p class="mb-0 small">
                                            <i class="fas fa-clock text-primary"></i>
                                            {{$category->created_at->format("h:i a")}}
                                        </p>
                                    </td>
                                </tr>
                                </tbody>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Category</td>
                                </tr>

                            @endforelse
                        </table>

                        <div class="text-center">
                            <a href="{{route('category.index')}}" class="btn btn-sm btn-outline-primary">
                                All Category List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
