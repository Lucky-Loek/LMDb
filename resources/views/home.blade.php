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

<section class="hero is-primary is-fullheight">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Loek Movie Database
            </h1>
            <h2 class="subtitle">
                An eye jerking web app that tells you how much time you could've done better things than watching tv instead.
            </h2>
        </div>
    </div>
</section>

<section class="hero is-light is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <p class="title">You have watched a screen for {{ $runtimeInSeconds }} seconds.</p>
            <p class="title">That is {{ round($runtimeInSeconds / 60) }} minutes.</p>
            <p class="title">Which is {{ round($runtimeInSeconds / 60 / 60) }} hours.</p>
            <p class="title">That equals some {{ round($runtimeInSeconds / 60 / 60 / 24) }} days.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        @foreach($screenings->chunk(6) as $chunk)
            <div class="columns">

                @foreach($chunk as $screening)
                    <div class="column is-2">
                        <article class="card">
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
</section>

<footer class="footer">
    <div class="content has-text-centered">
        <p>
            <strong>LMDb</strong> by <a href="https://github.com/Lucky-Loek" target="_blank">Loek van der Linde</a>.
            The source code is licensed <a href="http://opensource.org/licenses/mit-license.php" target="_blank">MIT</a>.
        </p>
        <p>
            The website content is licensed
            <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank">CC BY NC SA 4.0</a> as
            everything is downloaded through <a href="https://www.omdbapi.com/">OMDb</a>.
        </p>
    </div>
</footer>
</body>
</html>
