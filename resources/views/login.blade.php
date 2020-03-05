<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BerTender | Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body id="login">
        <header>
                <p><a href="{{url('/')}}">Back</a></p>
                <p><a href="{{url('/register')}}">Sin Up</a></p>
        </header>
        <main id="login_main_app">
            <h1>Welcome back to<br>
            BAR Tender</h1>
            @isset($validationMsgs)
                <section id="errorMsg">
                    <p>以下のメッセージをご確認ください。</p>
                    <ul>
                        @foreach($validationMsgs as $msg)
                            <li>{{$msg}}</li>
                        @endforeach
                    </ul>
                </section>
            @endisset
            <form action="{{url('/goLogin')}}" method="post">
                @csrf
                <p><input type="text" name="loginId" placeholder="Your Email" value="{{$loginId??""}}" required></p>
                <p><input type="password" name="loginPw" placeholder="Password" required></p>
                <button type="submit" id="login_button">Login</button>
                <p class="new_link"><a href="{{url('/register')}}">パスワードを忘れた方はこちらから</a></p>
            </form>
        </main>
        <footer>

        </footer>
        <script src=" {{ url('js/app.js') }} "></script>
    </body>
</html>
