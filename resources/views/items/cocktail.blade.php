<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>BerTender | Cocktail</title>
        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script> 

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body id="item">
        <header>
            <nav>
                <p><a href="/project_file/EmploymentWork/work/public/mainpage/goCategorySearch/{{$itemData->getCategoryId()}}"></a></p>
                <div>
                    <p class="logout"><a href="/project_file/EmploymentWork/work/public/logout">Log out</a></p>
                    <p><a href="/project_file/EmploymentWork/work/public/user/userHome">{{$name}}</a></p>
                </div>
            </nav>
        </header>
        <main id="home_main_app">
            <div>
                <h1>{{ $itemData->getItemName() }}</h1>
                <div class="item_box">
                    <p><img src="/project_file/EmploymentWork/work/public/img/item/item_img{{$itemData->getItemId()}}.jpg" alt="{{ $itemData->getItemMakerName() }}"></p>
                    <div>
                        <table>
                            <tr>
                                <th>メーカー名</th><td>
                                    <p>{{ $itemData->getItemMakerName() }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>アルコール名</th><td>
                                    <p>{{ $itemData->getAlcohol() }}%</p>
                                </td>
                            </tr>
                            <tr>
                                <th>数量</th><td>
                                    <p>{{ $itemData->getQuantity() }}㎖</p>
                                </td>
                            </tr>
                            <tr>
                                <th>カテゴリー名</th><td>
                                    <p>{{ $itemData->getCategoryName() }}</p>
                                </td>
                            </tr>
                            <tr class="price">
                                <th>値段</th><td>
                                    <p>¥{{ $itemData->getPrice() }}</p>
                                </td>
                            </tr>
                        </table>
                        <div class="comment_box">
                            <p>リキュールへのコメントの共有</p>
                            <div>
                                <input type="text" name="comment_text" id="comment_text" v-model="review"  placeholder="Comment Text...">
                                <p v-on:click="clickReview({{$itemData->getItemId()}})">共有</p>
                            </div>
                            <p><a href="#comment">コメントを見る</a></p>
                        </div>
                        <div class="kuet_box">
                            <div v-if="kurtFlg" v-on:click="clickNoKurtItem({{$itemData->getItemId()}})" class="flgOn"><img src="{{ url('img/common/kurt_plus.png') }} " alt="カートから外す"><p>カートから外す</p></div>
                            <div v-else v-on:click="clickKurtItem({{$itemData->getItemId()}})"><img src="{{ url('img/common/kurt.png') }} " alt="カートへ入れる"><p>カートへ入れる</p></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="item_info">
                        <span>point</span>
                        <p>{{ $itemData->getItemInfo() }}</p>
                    </div>
                    <div v-if="loadCateList" class="item_list_box">
                        <h2>使用されているカクテル一覧</h2>
                        <ul class="item_list">
                            <li v-for="items in itemAllList">
                                <a :href="`/project_file/EmploymentWork/work/public/items/recipe/${items.recipe_id}`">
                                    <img :src="`/project_file/EmploymentWork/work/public/img/recipe/recipe_img${items.recipe_id}.jpg`" alt="">
                                    <p>@{{items.recipe_name}}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="comment" class="item_list_box">
                    <h2>共有されているコメント</h2>
                    <ul v-if="loadReviewList">
                        <li v-for="comments in reviewList">
                            <p>@{{comments.review}}</p>
                            <p>@{{comments.create_time}}</p>
                        </li>
                    </ul>
                    <ul v-else>
                        <li>共有されているコメントはありません</li>
                    </ul>
                </div>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>
<script>
     var itemId = {{ $itemData->getItemId() }};
     console.log(itemId);
</script>
<script src=" {{ url('js/app.js') }} "></script>

