<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.9/cropper.css" integrity="sha512-949FvIQOibfhLTgmNws4F3DVlYz3FmCRRhJznR22hx76SKkcpZiVV5Kwo0iwK9L6BFuY+6mpdqB2+vDIGVuyHg==" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    </head>
    <body class="antialiased">

        <header class="h-96 w-full flex items-center justify-center">
            <div>
                <h2 class="text-7xl font-bold text-center">@Books</h2>
                <p class="font-bold text-center">本のメモが人とつながる。知識がつながる。</p>
            </div>
        </header>

        <div class="my-5 w-5/6 m-auto">
            <p class="my-3">
                本から学べることはたくさんあります。一方で読み終えてあまり吸収できていないことも多いです。
                そこで、本のメモを一緒にしていきませんか？
            </p>
            <div class="flex justify-center">
                <a href="{{route('register')}}" class="px-4 py-2 mx-auto bg-yellow-700 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-yellow-500 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">さっそく始める</a>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="{{ mix('js/main.js') }}"></script>
    </body>
</html>
