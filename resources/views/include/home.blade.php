<div class="bg-white">
    <div class="img-container mx-auto">
        @if ($user->book_photo_path)
        <img src="{{$user->book_photo_path}}" alt="">
        @endif
    </div>
</div>

<div class="bg-yellow-300 relative">
    @if ($user->id != Auth::user()->id)
        @if (!$is_following)
        <div id="following" class="follow-button btn absolute right-0 top-5 z-10">
            <i class="far fa-lg fa-user"></i>
        </div>
        @else
        <div id="unfollowing" class="follow-button btn absolute right-0 top-5 z-10">
            <i class="fas fa-lg fa-user-check"></i>
        </div>
        @endif
    @endif
    <div class="transform -translate-y-16">
        <div>
            <img class="block h-32 mx-auto rounded-full sm:mx-0 sm:flex-shrink-0" src="{{$user->profile_photo_path}}" alt="{{$user->name}}">
            <p class="text-center text-2xl mt-1 font-semibold">{{$user->name}}</p>
        </div>
        <div class="grid grid-cols-3">
            <div class="text-center">
                <p>books</p>
                <p>{{$books->total()}}</p>
            </div>
            <div class="text-center">
                <a href="{{route('follow.followingIndex', $user->id)}}">
                    <p>following</p>
                    <p>{{$following_num}}</p>
                </a>
            </div>
            <div class="text-center">
                <a href="{{route('follow.followedIndex', $user->id)}}">
                    <p>followers</p>
                    <p>{{$followed_num}}</p>
                </a>
            </div>
        </div>
        <div class="transform translate-y-16">
            <p>{{$user->info}}</p>
        </div>
    </div>
</div>

{{-- Here, show posts with jScroll--}}

<div class="scrolling-pagination">
    @foreach ($books as $book)
    <div class="bg-white mt-5 relative">
        @if ($book->book_photo_path)
            <div class="img-container mx-auto">
                <img src="{{$book->book_photo_path}}" alt="">
            </div>
        @endif
        
        <div class="">
            <h2 class="text-lg font-bold">{{ $book->title }}</h2>
        
            <div class="mt-5">
                {!! $book->summary !!}
            </div>
        </div>
        <a class="stretched-link" href="{{route('book.show', $book->id)}}"></a>
    </div>
    @endforeach
    {{$books->links('pagination::bootstrap-4')}}
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js" integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw==" crossorigin="anonymous"></script>
<script>
    var url = "{{route('follow.store', $user->id)}}";
    var following_id = {{Auth::user()->id}};
    var followed_id = {{$user->id}};
</script>
@endpush