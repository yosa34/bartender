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
    <body id="userHome">
        <header>
            <nav>
                <h1>BAR Tender</h1>
                <div>
                    <p class="logout"><a href="{{ url('/logout')}}">Log out</a></p>
                </div>
            </nav>
        </header>
        <main id="userhome_main_app">
            <h2>UserHome</h2>
            <div>
                <section>
                    <h3>お気に入り</h3>
                    <ul class="home_recommended_list">
                        @foreach($dataList as $list)
                            <li>
                                <a href="/project_file/EmploymentWork/work/public/recipe/{{$list["id"]}}">
                                    <img src="/project_file/EmploymentWork/work/public/img/{{$list["img"]}}_{{$list["id"]}}.jpg" alt="{{ $list['name'] }}">
                                    <div>
                                        <p>{{$list['name']}}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </main>
        <footer>

        </footer>
        <script src=" {{ url('js/app.js') }} "></script>
    </body>
</html>
