<div>
    <a class="nav-link {{$routeName == request()->url()? 'active':'' }}" aria-current="page" href="{{$routeName}}">
        {{$slot}}
    </a>
</div>
