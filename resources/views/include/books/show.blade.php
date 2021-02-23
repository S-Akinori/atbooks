@if ($book->book_photo_path)
    <div class="img-container mx-auto">
        <img src="{{$book->book_photo_path}}" alt="">
    </div>
@endif

<div class="bg-white">
    @if (Auth::user()->id == $book->user_id)
    <div class="dropstart flex justify-end">
        <button class="btn" id="editContentButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="editContentButton">
            <li><a class="dropdown-item" href="{{route('book.edit', $book->id)}}">編集</a></li>
            <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmDeletion">削除</button></li>
        </ul>
    </div>
    @endif

    <div class="flex justify-between">
        <h2 class="text-lg font-bold mr-3">{{$book->title}}</h2>
        <p>{{explode(' ', $book->updated_at)[0]}}</p>
    </div>

    <div class="mt-5">
        <h2 class="mb-3 text-lg font-bold rounded bg-yellow-100 text-center"><i class="fas fa-book-open"></i> 要約と私の問い</h2>
        <div class="summary">
            {!! $book->summary !!}
        </div>
    </div>

    <div class="mt-5">
        <h2 class="mb-3 text-lg font-bold bg-yellow-100 text-center"><i class="fas fa-book-open"></i> メモ</h2>
        <div class="content">
            {!! $book->content !!}
        </div>
    </div>

    <div class="mt-5">
        <a class="px-2 py-1 rounded bg-gray-200 hover:bg-gray-300" href="{{route('search.index', ['key'=>$book->tag, 'search_type'=>'タグ'])}}">{{$book->tag}}</a>
    </div>

    <a class="block w-40 px-3 py-2 mx-auto my-3 text-center font-bold rounded bg-yellow-300 hover:bg-yellow-400" href="{{$book->book_link}}" target="_blank">この本を読む</a>
</div>


@push('modals')
<div id="tableOfContents" class="dropup">
    <button class="btn bg-red-100 rounded-full fixed bottom-5 right-5" id="tableOfContentsButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="far fa-file"></i>
    </button>
    <ul class="dropdown-menu max-h-60 overflow-y-scroll" aria-labelledby="tableOfContentsButton">

    </ul>
</div>

<div class="modal fade" id="confirmDeletion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">本当に削除しますか？</h5>
            </div>
            <div class="modal-body">
                一度削除すると元に戻せません
            </div>
            <div class="modal-footer">
                <form action="{{route('book.destroy', $book->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary">Yes</button>
                </form>
                <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endpush