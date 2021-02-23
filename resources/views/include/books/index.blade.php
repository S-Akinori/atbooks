<div class="scrolling-pagination">
    @foreach ($books as $book)
    <div class="bg-white mt-5 py-3">
        <div class="flex">
            <div>
                <a href="{{route('home.index', $book->user_id)}}"><img class="w-12 h-12 rounded-full mx-2" src="{{$book->user->profile_photo_path}}" alt=""></a>
            </div>
            <div class="flex items-center">
                <a class="font-semibold text-lg" href="{{route('home.index', $book->user_id)}}">{{$book->user->name}}</a>
            </div>
        </div>

        <div class="mt-3 relative">
            @if ($book->book_photo_path)
            <div class="img-container mx-auto">
                <img src="{{$book->book_photo_path}}" alt="">
            </div>
            @endif
        
            <h2 class="text-lg font-bold">{{ $book->title }}</h2>
        
            <div class="mt-5">
                {!! $book->summary !!}
            </div>
            <a class="stretched-link" href="{{route('book.show', $book->id)}}"></a>
        </div>
    </div>
    @endforeach
    {{$books->links('pagination::bootstrap-4')}}
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js" integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw==" crossorigin="anonymous"></script>
@endpush