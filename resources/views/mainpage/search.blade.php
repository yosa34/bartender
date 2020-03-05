<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BerTender | SEARCH</title>
        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script> 
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body id="home">
        <header>
            <nav>
                <h1>BAR Tender</h1>
                <div>
                    <p class="logout"><a href="{{url('/logout')}}">Log out</a></p>
                    <p><a href="{{url('/user/userHome')}}">{{$name}}</a></p>
                </div>
            </nav>
        </header>
        <main id="home_main_app">
            <nav>
                <ul>
                    <li><a href="{{ url('/mainpage/ranking')}}">RANKING</a></li>
                    <li><a href="{{ url('/mainpage/topics')}}">TOPICS</a></li>
                    <li><a href="{{ url('/mainpage/recommend')}}">RECOMMEND</a></li>
                </ul>
            </nav>
            <div class="search">
                <div>
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
                    <div v-if="openSearch" class="openSearch">
                        <p>カクテル名で検索</p>
                        <form :action="`/project_file/EmploymentWork/work/public/mainpage/goSearch/${cocktailName}`" method="post" id="searchBox" >
                            <input type="text" name="cocktailName" v-model="cocktailName" placeholder="キーワード検索">
                            <input type="submit" value="">
                        </form>
                        <p>カテゴリで絞り込み</p>
                        <div v-if="loadCateList" clas="categoryAllList">
                            <ul>
                                <li v-for="value in categoryList" v-if="value.base == null" >
                                    <p v-if="value.name != '中国酒'" v-on:click="clickCategoryList(value.id)">
                                        @{{value.name}}
                                    </p>
                                    <a v-else-if="value.name == '中国酒'":href="`/project_file/EmploymentWork/work/public/mainpage/goCategorySearch/${value.id}`">
                                        @{{value.name}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div v-if="loadCateAllList" las="loadCateList">
                            <ul>
                                <li v-on:click="clickCategoryReturn()"><p>戻る</p></li>
                                <li v-for="(value) in categoryAllList">
                                    <a :href="`/project_file/EmploymentWork/work/public/mainpage/goCategorySearch/${value.id}`">
                                        @{{value.name}}
                                    </a>
                                </li>
                                <li v-on:click="clickCategoryReturn()"><p>戻る</p></li>
                            </ul>
                        </div>
                    </div>
                    <div v-on:click="clickOpenSearch" class="open_search">
                        <p v-if="openSearch" class="open"><img src="{{ url('/img/common/return.png') }}" alt="開く" ></p>
                        <p v-else class="close"><img src="{{ url('/img/common/search.png') }}" alt="閉じる" ></p>
                    </div>
                </div>
            </div>
            <div class="itemList">
                <ul >
                    @forelse($itemList as $itemId => $item)
                    <li>
                        <a href="{{ url('/items/item/') }}/{{$item->getItemId()}}">
                            <p><img src="/project_file/EmploymentWork/work/public/img/item/item_img{{$item->getItemId()}}.jpg" alt=""></p>
                            <p>{{$item->getItemName()}}</p>
                        </a>
                    </li>
                    @empty
                    <li class="item_none">
                        <a colspan="5">該当のリキュール存在しません。</a>
                    </li>
                    @endforelse
                </ul>
            </div>
        </main>
        <footer>

        </footer>
        <script src=" {{ url('/js/app.js') }} "></script>
    </body>
</html>
