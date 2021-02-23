<div class="scrolling-pagination">
    @foreach ($users as $user)
    <div class="bg-white my-2 py-2 flex relative">
        <div class="w-16 h-16 mx-3">
            <img class="w-full h-full w-12 h-12 rounded-full" src="{{$user->profile_photo_path}}" alt="{{$user->name}}">
        </div>
        <div>
            <p>{{$user->name}}</p>
            <p>{{$user->info}}</p>
        </div>
        <a href="{{route('home.index', $user->id)}}" class="stretched-link"></a>
    </div>
    @endforeach
    {{$users->links('pagination::bootstrap-4')}}
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js" integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw==" crossorigin="anonymous"></script>
@endpush