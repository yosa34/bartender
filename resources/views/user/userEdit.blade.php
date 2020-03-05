<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BerTender | UserEdit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body id="userEdit">
        <header>
            <nav>
                <p><a href="{{url('/user/userHome')}}">Back</a></p>
            </nav>
        </header>
        <main id="useredit_main_app">
            <h2>UserEdit</h2>
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
            <form action="/project_file/EmploymentWork/work/public/goUserEdit" method="post">
                @csrf
                <p><input type="text" name="name" placeholder="Your Name" value="{{$user->getName()}}" required></p>
                <p><input type="text" name="email" placeholder="Your Email" value="{{$user->getEmail()}}" readonly="readonly"></p>
                <button type="submit" id="new_button">Edit Account</button>
            </form>
        </main>
        <footer>

        </footer>
        <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>
