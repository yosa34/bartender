<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Shakepad</title>
        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script> 

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Arima+Madurai|Noto+Serif+JP&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
        <link href="{{ url('/css/app.css') }} " rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body id="recipe">
        <header>
            <nav>
                <p><a href="/project_file/EmploymentWork/work/public/items/item/{{$recipeData->getItemId()}}"></a></p>
                <div>
                    <p class="logout"><a href="/project_file/EmploymentWork/work/public/logout">Log out</a></p>
                    <p><a href="/project_file/EmploymentWork/work/public/user/userHome">{{$name}}</a></p>
                </div>
            </nav>
        </header>
        <main id="home_main_app">
            <div>
                <h1>{{$recipeData->getRecipeName()}}</h1>
                <div class="item_box">
                    <p><img src="/project_file/EmploymentWork/work/public/img/recipe/recipe_img{{$recipe_id}}.jpg" alt="{{$recipeData->getRecipeName()}}"></p>
                    <div>
                        <table>
                                <tr>
                                    <th>カクテルの材料</th>
                                </tr>
                                <tr v-if="loadRecipeItemList" v-for="recipe in recipeItemList">
                                    <td>
                                        <p>
                                            <a :href="`/project_file/EmploymentWork/work/public/items/item/${recipe.item_id}`">
                                                @{{ recipe.item_name }}
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td>データが存在しません</td>
                                </tr>
                        </table>
                        <div class="good_box">
                            <p v-if="goodFlg" v-on:click="clickNoGoodCocktail({{$recipe_id}})" class="flgOn">お気に入り解除</p>
                            <p v-else v-on:click="clickGoodCocktail({{$recipe_id}})">お気に入り</p>
                        </div>
                    </div>
                </div>

                <div class="item_info">
                    <span>point</span>
                    <p>{{$recipeData->getRecipeInfo()}}</p>
                </div>
                <div v-if="loadRecipeList" class="item_list_box">
                    <h2>レシピ</h2>
                    <ul class="item_list">
                        <li v-for="recipe in recipeTextList">
                            <span>@{{ recipe.no }}</span>
                            <p>@{{ recipe.text }}</p>
                        </li>
                    </ul>
                </div>

            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>
<script>
    var recipe_id = {{$recipe_id}};
</script>
<script src=" {{ url('js/app.js') }} "></script>

