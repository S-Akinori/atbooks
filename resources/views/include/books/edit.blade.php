<x-jet-validation-errors>
    <x-slot name="attributes">
        class = "mx-2 rounded bg-red-300"
    </x-slot>
</x-jet-validation-errors>

<div class="bg-red-100 mx-2">
    <form id="bookForm" action="{{route('book.update', $book->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <input class="font-bold m-3 rounded border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:ring-opacity-50" type="text" name="title" value="{{$book->title}}" placeholder="タイトル">

        <input type="hidden" name="content" value="">
        <div id="content" class="bg-white m-3 rounded">
        </div>

        <input type="hidden" name="summary" value="">
        <div id="summary" class="bg-white m-3 rounded"></div>
        <input class="m-3 rounded border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:ring-opacity-50" type="text" name="tag" value="{{$book->tag}}" placeholder="タグ">

        <input type="file" class="mt-3" name="book_photo" accept=".png, .jpg">
        @if ($book->book_photo_path)
            <div id="preview" class="">
                <img src="{{$book->book_photo_path}}">
            </div>
        @else
            <div id="preview" class="hidden">
            </div>
        @endif

    </form>
    <button id="post" class="py-2 px-3 mt-3 bg-yellow-300 hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 rounded">保存</button>

    <div id="toolbarContainer" class="h-10 w-full fixed bottom-0 bg-white">
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button id="page" class=""><i class="far fa-file"></i></button>
        <button id="fact" class="ql-list " value="fact-list"><i class="far fa-circle"></i></button>
        <button id="abstraction" class="ql-list " value="abstraction-list"><i class="fas fa-circle"></i></button>
        <button id="action" class="ql-list " value="action-list"><i class="fas fa-star"></i></button>
    </div>
    <div id="summaryToolbarContainer" class="hidden h-10 w-full fixed bottom-0 bg-white">
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button class="ql-header" value="2"></button>
        <button id="fact" class="ql-list " value="fact-list"><i class="far fa-circle"></i></button>
        <button id="abstraction" class="ql-list " value="abstraction-list"><i class="fas fa-circle"></i></button>
        <button id="action" class="ql-list " value="action-list"><i class="fas fa-star"></i></button>
    </div> 

    @push('scripts')
        <script>
            var contentHtml = '{!! $book->content !!}';
            var summaryHtml = '{!! $book->summary !!}'
        </script>
    @endpush
</div>