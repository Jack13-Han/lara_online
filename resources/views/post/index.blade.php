@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Post Lists
                    </div>

                    <div class="card-body">

                        <div class="mb-4 d-flex justify-content-between align-items-start">
                            <div class="">

                                <a href="{{route('post.create')}}" class="btn btn-sm  btn-outline-primary ">
                                    <i class="fas fa-candy-cane"></i>
                                    Post Create
                                </a>

                                @isset(request()->search)
                                    <a href="{{route('post.index')}}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-list fa-fw"></i>
                                        All Post

                                    </a>

                                    <span class="h5">Search By : "{{request()->search}}"</span>

                                @endisset


                            </div>


                            <form action="" method="get" class="w-25">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{request('search')}}" placeholder="Search Something..">
                                    <button class="btn btn-sm btn-outline-primary" type="submit">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>




                        <table class="table-hover table  align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Is_Publish</th>
                                <th>Category</th>
                                <th>Tag </th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created</th>

                            </tr>
                            </thead>
                            @forelse($posts as $post)

                                <tbody>
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td class="small">{{\Illuminate\Support\Str::words($post->title,8)}}</td>
                                    <td class="text-nowrap">
                                        @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)
                                            <a class="venobox" data-gall="img{{$post->id}}" href="{{asset('storage/photo/'.$photo->name)}}">
                                                <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="40" class="rounded-circle border-3 border-white shadow-sm list-thumbnail" alt="image alt"/>
                                            </a>
{{--                                            <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="30" class="rounded " alt="">--}}
                                        @empty
                                            <p class="text-black-50">No Photo</p>
                                        @endforelse
                                    </td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required {{$post->is_publish ? "checked" :'' }} >
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                {{$post->is_publish ? 'Publish':'Unpublished'}}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{$post->category->title ?? "Unknown Category"}}
                                    </td>

                                    <td>
                                        @foreach($post->tags as $tag)
                                            <span class="badge bg-primary small">
                                               <i class="fas fa-hashtag"></i>
                                                {{$tag->title}}
                                           </span>
                                        @endforeach
                                    </td>

                                    <td>
                                        {{$post->user->name ?? "Unknown User "}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                            <button form="postDeleteForm{{$post->id}}" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash fa-fw"></i>
                                            </button>

                                        </div>

                                        <form action="{{route('post.destroy',$post->id)}} " id="postDeleteForm{{$post->id}}" method="post" >
                                            @csrf
                                            @method('delete')

                                        </form>

                                    </td>
                                    <td>
                                        <p class="mb-0 small">
                                            <i class="fas fa-calendar text-primary"></i>
                                            {{$post->created_at->format("d-M-Y")}}
                                        </p>

                                        <p class="mb-0 small">
                                            <i class="fas fa-clock text-primary"></i>
                                            {{$post->created_at->format("h:i a")}}
                                        </p>
                                    </td>
                                </tr>
                                </tbody>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">There is no Category</td>
                                </tr>

                            @endforelse
                        </table>

                        <div class="d-flex justify-content-between">
                            {{$posts->appends(request()->all())->links()}}

                            <p class="fw-bolder mb-0 h4">Total : {{$posts->total()}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>

    @if(session('status'))
    <script>
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
    </script>
    @endif

@endsection
