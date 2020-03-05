<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BerTender</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

    </head>
    <body id="top">
        <main>
            <h1>BAR Tender</h1>
            <p>〜 Cocktail & Lique 〜</p>
            <div>
                <p id="login"><a href="{{url('/login')}}">Log in</a></p>
                <p id="signin">登録がまだの方は<a href="{{url('/register')}}">こちら</a>から</p>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>
