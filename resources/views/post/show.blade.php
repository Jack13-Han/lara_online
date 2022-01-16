@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{$post->title}}
                    </div>

                    <div class="card-body">
                        <div class="">
                            <h3>{{$post->user->name}}</h3>
                        </div>

                        {{$post->description}}

                        <hr>
                        <div class="">
                            <a href="{{route('post.create')}}" class="btn btn-sm  btn-primary ">
                                Post Create
                            </a>

                            <a href="{{route('post.index')}}" class="btn btn-sm  btn-outline-primary ">
                               All Post
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
