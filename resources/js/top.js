// カテゴリ用ドメイン
var baseURL = "/project_file/EmploymentWork/work/public/mainpage/getCategoryBase";
var categorySearchURL = "/project_file/EmploymentWork/work/public/mainpage/goCategoryReSearch";
var cocktailSearchURL = "/project_file/EmploymentWork/work/public/mainpage/goCocktailSearch";
// お気に入り
var goodCocktailURL = "/project_file/EmploymentWork/work/public/user/goodCocktail";
var noGoodCocktailURL = "/project_file/EmploymentWork/work/public/user/deleteGoodCocktail";
var getGoodFlgURL = "/project_file/EmploymentWork/work/public/user/getgoodFlg";
// カート
var kurtItemURL = "/project_file/EmploymentWork/work/public/user/kurtItem";
var noKurtItemURL = "/project_file/EmploymentWork/work/public/user/deleteKurtItem";
var getKurtFlgURL = "/project_file/EmploymentWork/work/public/user/getKurtFlg";
// 購入
var getKurtPurchaseURL = "/project_file/EmploymentWork/work/public/user/getKurtPurchase";
// リスト
var getKurtListURL = "/project_file/EmploymentWork/work/public/user/getKurtList";
var getViewListURL = "/project_file/EmploymentWork/work/public/user/getViewList";
var getGoodListURL = "/project_file/EmploymentWork/work/public/user/getGoodList";
var getPurchaseListURL = "/project_file/EmploymentWork/work/public/user/getPurchaseList";
var getRecipeItemListURL = "/project_file/EmploymentWork/work/public/user/getRecipeItemList";
// コメント共有
var setReviewListURL = "/project_file/EmploymentWork/work/public/user/setReviewList";
var getReviewListURL = "/project_file/EmploymentWork/work/public/user/getReviewList";

var home = new Vue({
    el: '#home_main_app',
    data: {
        openSearch:false,
        goodFlg:false,
        kurtFlg:false,
        purchaseFlg:false,
        loadCateList: false,
        loadCateAllList:false,
        loadReSaerch:false,
        loadItemList:false,
        loadKurtList:false,
        loadViewList:false,
        loadGoodList:false,
        loadPurchaseList:false,
        loadRecipeList:false,
        loadRecipeItemList:false,
        loadReviewList:false,
        categoryList:[
            { id: '0', name: '該当する値がありません',base:'0'}
        ],
        categoryAllList:[
            { id: '0', name: '該当する値がありません' }
        ],
        cocktailList:[
            {id: '0' ,name:''}
        ],
        itemAllList: [
            {id: '0' ,name:''}
        ],
        kurtList: [
            {id: '0' ,name:''}
        ],
        viewList: [
            {id: '0' ,name:''}
        ],
        goodList: [
            {id: '0' ,name:''}
        ],
        purchaseList: [
            {id: '0' ,name:''}
        ],
        recipeItemList: [
            {no: '0' ,text:''}
        ],
        reviewList: [
            {no: '0' ,text:''}
        ],
        cocktailName:"",
        review:"",
        value: 0,
        all_price: 0,
        price: 0,
        untaxed: 0
    },
    computed: {

    },
    methods: {
        clickOpenSearch: function (event) {
            this.openSearch = !this.openSearch;
        },
        clickCategoryReturn: function (event) {
            var self = this;
            self.loadCateList = true;
            self.loadCateAllList = false;
            self.categoryAllList = [{ id: '0', name: '該当する値がありません' }];


        },
        clickCategoryReSearch: function (id) {
            var self = this;
            self.loadCateAllList = false;
            self.loadCateList = true;
            self.getItemAllList(id);
        },
        clickCategoryList(id){
            var self = this;
            self.categoryAllList = [{ id: '0', name: '該当する値がありません' }];

            // console.log(id);
            i = 0;
            self.categoryList.forEach( function(key) {
                if(key.base === id){
                    // console.log(key.name);
                    self.categoryAllList[i] = key;
                    i++;
                }
            })
            self.loadCateList = false;
            self.loadCateAllList = true;

        },
        clickGoodCocktail(cocktail_id){
            var self = this;
            // console.log("お気に入り登録");
            axios
                .get(goodCocktailURL+"/"+cocktail_id)
                    .then(function (res) {
                        // console.log(res.data);
                        if(res.data){
                            self.goodFlg = true;
                            alert('お気に入りに登録しました！');
                        }
                    });
        },
        clickNoGoodCocktail(cocktail_id){
            var self = this;
            // console.log("お気に入り解除");
            axios
            .get(noGoodCocktailURL+"/"+cocktail_id)
                .then(function (res) {
                    // console.log(res.data);
                    self.goodFlg = false;
                    alert('お気に入りから削除しました！');
                });

        },
        clickKurtItem(item_id){
            var self = this;
            // console.log("カート登録");
            axios
                .get(kurtItemURL+"/"+item_id)
                    .then(function (res) {
                        // console.log(res.data);
                        if(res.data){
                            self.kurtFlg = true;
                            alert('カートに登録しました！');
                        }
                    });
        },
        clickNoKurtItem(item_id){
            var self = this;
            // console.log("カート解除");
            axios
            .get(noKurtItemURL+"/"+item_id)
                .then(function (res) {
                    self.kurtFlg = false;
                    self.getKurtList();
                    alert('カートから削除しました！');
                });

        },
        clickKurtPurchase(){
            var self = this;
            // console.log("購入");
            axios
            .get(getKurtPurchaseURL)
                .then(function (res) {
                    // console.log("購入完了");
                    self.purchaseFlg = false;
                    self.loadKurtList = false;
                    self.getPurchaseList();
                    console.log("購入");
                    alert('購入が完了しました！');
                });

        },
        clickReview(item_id){
            var self = this;
            console.log("コメントしました");
            console.log(self.review);
            var review = self.review;
            axios
            .post(setReviewListURL+"/"+item_id+"/"+review)
                .then(function (res) {
                    self.getReviewList(item_id);
                    console.log("コメント共有完了");
                    alert('コメントを共有しました');
                });

        },
        getCategoryList(){
            var self = this;
            axios
                .get(baseURL)
                    .then(function (res) {
                        self.categoryList = res.data;
                        // console.log(self.categoryList);
                        self.loadCateList = true;
                    });
        },
        getItemAllList(id){
            // id再検索
            // console.log("再検索");
            var self = this;
            axios
                .get(categorySearchURL+"/"+id)
                    .then(function (res) {
                        self.itemList = res.data;
                        // console.log(self.itemList);
                        this.loadItemList = true;
                    });
        },
        getCocktailList(itemId){
            // id再検索
            var self = this;
            axios
                .get(cocktailSearchURL+"/"+itemId)
                    .then(function (res) {
                        self.itemAllList = res.data;
                        self.loadCateList = true;
                        self.loadReSaerch = true;
                    });
        },
        getRecipeItemList(itemId){
            // レシピ素材リスト
            var self = this;
            axios
                .get(getRecipeItemListURL+"/"+itemId)
                    .then(function (res) {
                        list = res.data;
                        console.log(list);
                        if( list.length > 0 ){
                            self.loadRecipeItemList = true;
                            self.recipeItemList = list;
                        }else{
                            self.loadRecipeItemList = false;
                        }
                    });
        },
        getGoodList(){
            // お気に入りリスト
            var self = this;
            axios
                .get(getGoodListURL)
                    .then(function (res) {
                        list = res.data;
                        if( list.length > 0 ){
                            self.loadGoodList = true;
                            self.goodList = list;
                        }else{
                            self.loadGoodList = false;
                        }
                    });
        },
        getKurtList(){
            // カートリスト
            var self = this;
            axios
                .get(getKurtListURL)
                    .then(function (res) {
                        list = res.data;
                        if( list.length > 0 ){
                            self.loadKurtList = true;
                            self.purchaseFlg = true;
                            self.kurtList = list;
                            i = 0;
                            price = 0;
                            untaxed = 0;
                            while(list.length>i){
                                price = price + Number(list[i].price);
                                untaxed = untaxed + Math.floor(((list[i].price * 1.08)-list[i].price));
                                i++;
                            }
                            self.price = price;
                            self.untaxed = untaxed;
                            self.all_price = price + untaxed;

                        }else{
                            self.loadKurtList = false;
                            self.purchaseFlg = false;
                        }
                    });
        },
        getViewList(){
            // 閲覧履歴リスト
            var self = this;
            axios
                .get(getViewListURL)
                    .then(function (res) {
                        list = res.data;
                        if( list.length > 0 ){
                            self.loadViewList = true;
                            self.viewList = list;
                        }else{
                            self.loadViewList = false;
                        }
                    });
        },
        getPurchaseList(){
            // 購入済みリスト
            var self = this;
            axios
                .get(getPurchaseListURL)
                    .then(function (res) {
                        list = res.data;
                        if( list.length > 0 ){
                            self.loadPurchaseList = true;
                            self.purchaseList = list;
                        }else{
                            self.loadPurchaseList = false;
                        }
                    });
        },
        getGoodFlg(itemId){
            var self = this;
            axios
                .get(getGoodFlgURL+"/"+itemId)
                    .then(function (res) {
                        if(res.data){
                            self.goodFlg = true;
                            self.goodList = list;
                        }else{
                            self.goodFlg = false;
                        }
                    });
        },
        getKurtFlg(itemId){
            var self = this;
            // console.log("確認");
            axios
                .get(getKurtFlgURL+"/"+itemId)
                    .then(function (res) {
                        // console.log(res.data);
                        if(res.data){
                            self.kurtFlg = true;
                            self.purchaseFlg = true;
                        }else{
                            self.kurtFlg = false;
                        }
                    });
        },
        getReviewList(itemId){
            var self = this;
            // console.log("確認");
            axios
                .get(getReviewListURL+"/"+itemId)
                    .then(function (res) {
                        list = res.data;
                        console.log(list);
                        if(res.data && list.length > 0){
                            self.loadReviewList = true;
                            self.reviewList = list;
                            console.log("通過");
                        }else{
                            self.loadReviewList = false;
                        }
                    });
        }
    },
    mounted:function(){
        //Ajaxを実行
        this.getCategoryList();

        if(id === "item"){
            this.getCocktailList(itemId);
            this.getKurtFlg(itemId);
            this.getReviewList(itemId);
        }
        if(id === "recipe"){
            this.getCocktailList(recipe_id);
            this.getRecipeItemList(recipe_id);
            this.getGoodFlg(recipe_id);
        }
        if(id === "userHome"){
            this.getKurtList();
            this.getGoodList();
            this.getViewList();
            this.getPurchaseList();
        }
      }
  })



