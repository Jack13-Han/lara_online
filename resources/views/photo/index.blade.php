@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="" class="btn btn-sm  btn-outline-primary ">
                            <i class="fas fa-lemon"></i>
                            My Photo
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="mb-4 d-flex flex-wrap">


                               @forelse(auth()->user()->photos as $photo)
                                    <div class="position-relative">

                                        <form action="{{route('photo.destroy',$photo->id)}}" class="position-absolute bottom-0 start-0" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>


                                        <div class="">
                                            <a class="venobox" data-gall="img" href="{{asset('storage/photo/'.$photo->name)}}">
                                                <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="100" class="rounded me-3" alt="image alt"/>
                                            </a>
                                        </div>

                                    </div>

                                @empty
                                  <div class="">
                                      <p class="text-black-50">No Photo</p>
                                  </div>
                                @endforelse


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
