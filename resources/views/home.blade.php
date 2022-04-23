@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                    {{request()->url()}}

                        <hr>

                        <x-alert></x-alert>
                    <x-alert type="success" message="I'm Han Wai Htun"></x-alert>

                        @hwh

                        {{$categories}}
{{--                        <x-alert type="primary" message="I'm Han Htun"></x-alert>--}}
{{--                        <x-alert type="dark" message="I'm Han Wai "></x-alert>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
