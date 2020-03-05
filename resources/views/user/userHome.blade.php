<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BerTender | UserHome</title>
        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src= "{{ url('js/vue.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script> 

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
        <main id="home_main_app">
            <h2>UserHome</h2>
            <nav>
                <ul>
                    <li><a href="{{ url('/mainpage/ranking')}}">RANKING</a></li>
                    <li><a href="{{ url('/mainpage/topics')}}">TOPICS</a></li>
                    <li><a href="{{ url('/mainpage/recommend')}}">RECOMMEND</a></li>
                </ul>
            </nav>
            @if(session("flashMsg"))
                <section>
                    <p>{{session("flashMsg")}}</p>
                </section>
            @endif
            <ul class="page_nav">
                <li><a href="#kurt">カート</a></li>
                <li><a href="#view">閲覧履歴</a></li>
                <li><a href="#good">お気に入り</a></li>
                <li><a href="#purchase">購入履歴</a></li>
            </ul>
            <div>
                <div class="user_profile">
                    <p>User Name：{{ $name }}</p>
                    <p>User Email：{{ $email }}</p>
                    <p><a href="{{ url('/user/userEdit')}}">Edit profile</a></p>
                </div>
            </div>
            <div>
                <section id="kurt" class="item">
                    <h3>カート</h3>
                    <ul class="home_recommended_list" v-if="loadKurtList">
                        <li v-for="value in kurtList">
                            <img :src="`/project_file/EmploymentWork/work/public/img/item/item_img${value.item_id}.jpg`" >
                            <div>
                                    <p>@{{value.item_name}}</p>
                                    <p>アルコール数：@{{value.alcohol}}％</p>
                                    <p>容量：@{{value.quantity}}㎖</p>
                                    <p class="price">¥@{{value.price}}</p>
                                    <p class="link"><a :href="`/project_file/EmploymentWork/work/public/items/item/${value.item_id}`">詳細を見る</a></p>
                                <p class="kurt_none" v-on:click="clickNoKurtItem(value.item_id)">削除する</p>
                            </div>
                        </li>
                    </ul>
                    <div v-else>
                        <p>カートは空です</p>
                    </div>
                    <ul  v-if="loadKurtList">
                        <li><p>小計：@{{price}}</p></li>
                        <li><p>税：@{{untaxed}}</p></li>
                        <li><p class="all_price">会計：¥@{{all_price}}</p></li>
                    </ul>
                    <p v-if="purchaseFlg" v-on:click="clickKurtPurchase" class="buttom">購入する</p>
                </section>
                <section id="view" class="cocktail">
                    <h3>閲覧履歴</h3>
                    <ul class="home_recommended_list" v-if="loadViewList">
                        <li v-for="value in viewList">
                            <img :src="`/project_file/EmploymentWork/work/public/img/recipe/recipe_img${value.item_id}.jpg`" >
                            <div>
                                <p>@{{value.item_name}}</p>
                                <p>閲覧日時@{{value.time}}</p>
                                <p class="link"><a :href="`/project_file/EmploymentWork/work/public/items/recipe/${value.item_id}`">詳細を見る</a></p>
                            </div>
                        </li>
                    </ul>
                    <div v-else>
                        <p>閲覧履歴はありません</p>
                    </div>
                </section>
                <section id="good" class="cocktail">
                    <h3>お気に入り</h3>
                    <ul class="home_recommended_list" v-if="loadGoodList">
                        <li v-for="value in goodList">
                            <img :src="`/project_file/EmploymentWork/work/public/img/recipe/recipe_img${value.item_id}.jpg`" >
                            <div>
                                <p>@{{value.item_name}}</p>
                                <p>@{{value.time}}</p>
                                <p class="link"><a :href="`/project_file/EmploymentWork/work/public/items/recipe/${value.item_id}`">詳細を見る</a></p>
                            </div>
                        </li>
                    </ul>
                    <div v-else>
                        <p>お気に入りはありません</p>
                    </div>
                </section>
                <section id="purchase" class="item">
                    <h3>過去の購入履歴</h3>
                    <ul class="home_recommended_list" v-if="loadPurchaseList">
                        <li v-for="value in purchaseList">
                            <img :src="`/project_file/EmploymentWork/work/public/img/item/item_img${value.item_id}.jpg`" >
                            <div>
                                <p>@{{value.item_name}}</p>
                                <p>購入日時：@{{value.purchase_time}}</p>
                                <p class="link"><a :href="`/project_file/EmploymentWork/work/public/items/item/${value.item_id}`">詳細を見る</a></p>
                            </div>
                        </li>
                    </ul>
                    <div v-else>
                        <p>購入離席はありません</p>
                    </div>
                </section>
            </div>
        </main>
        <footer>

        </footer>
        <script src=" {{ url('js/app.js') }} "></script>
    </body>
</html>
