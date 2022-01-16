@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Category Lists
                    </div>

                    <div class="card-body">

                       <div class="mb-4">
                           <a href="{{route('category.create')}}" class="btn btn-sm  btn-outline-primary ">
                               Category Create
                           </a>
                       </div>


                        @if(session('status'))

                            <p class="alert alert-success">
                                {{session('status') }}
                            </p>

                        @endif

                       <table class="table-hover table table-bordered align-middle">
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
                        {{$categories->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
