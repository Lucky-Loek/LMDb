<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- JavaScript --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <title>Homepage</title>
</head>
<body>
<section class="section">
    <div class="container">
        <div class="tile is-ancestor">

            @foreach($screenings->chunk(3) as $chunk)
                <div class="tile is-parent is-2 is-vertical">

                    @foreach($chunk as $screening)
                        <div class="tile is-child">
                            <article class="tile is-child card">
                                <div class="card-image">
                                    <figure class="image is-3by4">
                                        <img src="{{ 'storage/' . $screening->poster_thumbnail_file_path }}" alt="Placeholder image">
                                    </figure>
                                </div>
                            </article>
                        </div>
                    @endforeach

                </div>
            @endforeach()

        </div>
    </div>
</section>
</body>
</html>
