<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Shakepad</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body id="register">
        <header>
                <p><a href="{{url('/')}}">Back</a></p>
                <p><a href="{{url('/login')}}">login</a></p>
        </header>
        <main id="new_main_app">
            <h1>Let's start making<br>
            good meals</h1>
            @isset($validationMsgs)
            <section id="errorMsg">
                <p>以下のメッセージをご確認ください</p>
                <ul>
                    @foreach($validationMsgs as $msg)
                    <li>{{$msg}}</li>
                    @endforeach
                </ul>
            </section>
            @endisset
            <form action="{{url('/goRegister')}}" method="post">
                @csrf
                <p><input type="text" name="name" placeholder="Your Name" value="{{$user->getName()}}" required></p>
                <p><input type="text" name="email" placeholder="Your Email" value="{{$user->getEmail()}}" required></p>
                <p><input type="password" name="passwd" placeholder="Password" required></p>
                <button type="submit" id="new_button">Create Account</button>
            </form>
        </main>
        <footer>

        </footer>
    </body>
</html>
