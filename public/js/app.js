/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

id = $("body").attr("id");

__webpack_require__(/*! ./top */ "./resources/js/top.js");

__webpack_require__(/*! ./common */ "./resources/js/common.js");

/***/ }),

/***/ "./resources/js/common.js":
/*!********************************!*\
  !*** ./resources/js/common.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var _window = $(window),
    _header = $('.page_nav'),
    heroBottom;

_window.on('scroll', function () {
  heroBottom = 140;

  if (_window.scrollTop() > heroBottom) {
    _header.addClass('fixed');
  } else {
    _header.removeClass('fixed');
  }
});

_window.trigger('scroll');

/***/ }),

/***/ "./resources/js/top.js":
/*!*****************************!*\
  !*** ./resources/js/top.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

// カテゴリ用ドメイン
var baseURL = "/project_file/EmploymentWork/work/public/mainpage/getCategoryBase";
var categorySearchURL = "/project_file/EmploymentWork/work/public/mainpage/goCategoryReSearch";
var cocktailSearchURL = "/project_file/EmploymentWork/work/public/mainpage/goCocktailSearch"; // お気に入り

var goodCocktailURL = "/project_file/EmploymentWork/work/public/user/goodCocktail";
var noGoodCocktailURL = "/project_file/EmploymentWork/work/public/user/deleteGoodCocktail";
var getGoodFlgURL = "/project_file/EmploymentWork/work/public/user/getgoodFlg"; // カート

var kurtItemURL = "/project_file/EmploymentWork/work/public/user/kurtItem";
var noKurtItemURL = "/project_file/EmploymentWork/work/public/user/deleteKurtItem";
var getKurtFlgURL = "/project_file/EmploymentWork/work/public/user/getKurtFlg"; // 購入

var getKurtPurchaseURL = "/project_file/EmploymentWork/work/public/user/getKurtPurchase"; // リスト

var getKurtListURL = "/project_file/EmploymentWork/work/public/user/getKurtList";
var getViewListURL = "/project_file/EmploymentWork/work/public/user/getViewList";
var getGoodListURL = "/project_file/EmploymentWork/work/public/user/getGoodList";
var getPurchaseListURL = "/project_file/EmploymentWork/work/public/user/getPurchaseList";
var getRecipeItemListURL = "/project_file/EmploymentWork/work/public/user/getRecipeItemList";
var home = new Vue({
  el: '#home_main_app',
  data: {
    openSearch: false,
    goodFlg: false,
    kurtFlg: false,
    purchaseFlg: false,
    loadCateList: false,
    loadCateAllList: false,
    loadReSaerch: false,
    loadItemList: false,
    loadKurtList: false,
    loadViewList: false,
    loadGoodList: false,
    loadPurchaseList: false,
    loadRecipeList: false,
    loadRecipeItemList: false,
    categoryList: [{
      id: '0',
      name: '該当する値がありません',
      base: '0'
    }],
    categoryAllList: [{
      id: '0',
      name: '該当する値がありません'
    }],
    cocktailList: [{
      id: '0',
      name: ''
    }],
    itemAllList: [{
      id: '0',
      name: ''
    }],
    kurtList: [{
      id: '0',
      name: ''
    }],
    viewList: [{
      id: '0',
      name: ''
    }],
    goodList: [{
      id: '0',
      name: ''
    }],
    purchaseList: [{
      id: '0',
      name: ''
    }],
    recipeItemList: [{
      no: '0',
      text: ''
    }],
    cocktailName: "",
    value: 0,
    all_price: 0,
    price: 0,
    untaxed: 0
  },
  computed: {},
  methods: {
    clickOpenSearch: function clickOpenSearch(event) {
      this.openSearch = !this.openSearch;
    },
    clickCategoryReturn: function clickCategoryReturn(event) {
      var self = this;
      self.loadCateList = true;
      self.loadCateAllList = false;
      self.categoryAllList = [{
        id: '0',
        name: '該当する値がありません'
      }];
    },
    clickCategoryReSearch: function clickCategoryReSearch(id) {
      var self = this;
      self.loadCateAllList = false;
      self.loadCateList = true;
      self.getItemAllList(id);
    },
    clickCategoryList: function clickCategoryList(id) {
      var self = this;
      self.categoryAllList = [{
        id: '0',
        name: '該当する値がありません'
      }]; // console.log(id);

      i = 0;
      self.categoryList.forEach(function (key) {
        if (key.base === id) {
          // console.log(key.name);
          self.categoryAllList[i] = key;
          i++;
        }
      });
      self.loadCateList = false;
      self.loadCateAllList = true;
    },
    clickGoodCocktail: function clickGoodCocktail(cocktail_id) {
      var self = this; // console.log("お気に入り登録");

      axios.get(goodCocktailURL + "/" + cocktail_id).then(function (res) {
        // console.log(res.data);
        if (res.data) {
          self.goodFlg = true;
          alert('お気に入りに登録しました！');
        }
      });
    },
    clickNoGoodCocktail: function clickNoGoodCocktail(cocktail_id) {
      var self = this; // console.log("お気に入り解除");

      axios.get(noGoodCocktailURL + "/" + cocktail_id).then(function (res) {
        // console.log(res.data);
        self.goodFlg = false;
        alert('お気に入りから削除しました！');
      });
    },
    clickKurtItem: function clickKurtItem(item_id) {
      var self = this; // console.log("カート登録");

      axios.get(kurtItemURL + "/" + item_id).then(function (res) {
        // console.log(res.data);
        if (res.data) {
          self.kurtFlg = true;
          alert('カートに登録しました！');
        }
      });
    },
    clickNoKurtItem: function clickNoKurtItem(item_id) {
      var self = this; // console.log("カート解除");

      axios.get(noKurtItemURL + "/" + item_id).then(function (res) {
        self.kurtFlg = false;
        self.getKurtList();
        alert('カートから削除しました！');
      });
    },
    clickKurtPurchase: function clickKurtPurchase() {
      var self = this; // console.log("購入");

      axios.get(getKurtPurchaseURL).then(function (res) {
        // console.log("購入完了");
        self.purchaseFlg = false;
        self.loadKurtList = false;
        self.getPurchaseList();
        console.log("購入");
        alert('購入が完了しました！');
      });
    },
    getCategoryList: function getCategoryList() {
      var self = this;
      axios.get(baseURL).then(function (res) {
        self.categoryList = res.data; // console.log(self.categoryList);

        self.loadCateList = true;
      });
    },
    getItemAllList: function getItemAllList(id) {
      // id再検索
      // console.log("再検索");
      var self = this;
      axios.get(categorySearchURL + "/" + id).then(function (res) {
        self.itemList = res.data; // console.log(self.itemList);

        this.loadItemList = true;
      });
    },
    getCocktailList: function getCocktailList(itemId) {
      // id再検索
      var self = this;
      axios.get(cocktailSearchURL + "/" + itemId).then(function (res) {
        self.itemAllList = res.data;
        self.loadCateList = true;
        self.loadReSaerch = true;
      });
    },
    getRecipeItemList: function getRecipeItemList(itemId) {
      // レシピ素材リスト
      var self = this;
      axios.get(getRecipeItemListURL + "/" + itemId).then(function (res) {
        list = res.data;
        console.log(list);

        if (list.length > 0) {
          self.loadRecipeItemList = true;
          self.recipeItemList = list;
        } else {
          self.loadRecipeItemList = false;
        }
      });
    },
    getGoodList: function getGoodList() {
      // お気に入りリスト
      var self = this;
      axios.get(getGoodListURL).then(function (res) {
        list = res.data;

        if (list.length > 0) {
          self.loadGoodList = true;
          self.goodList = list;
        } else {
          self.loadGoodList = false;
        }
      });
    },
    getKurtList: function getKurtList() {
      // カートリスト
      var self = this;
      axios.get(getKurtListURL).then(function (res) {
        list = res.data;

        if (list.length > 0) {
          self.loadKurtList = true;
          self.purchaseFlg = true;
          self.kurtList = list;
          i = 0;
          price = 0;
          untaxed = 0;

          while (list.length > i) {
            price = price + Number(list[i].price);
            untaxed = untaxed + Math.floor(list[i].price * 1.08 - list[i].price);
            i++;
          }

          self.price = price;
          self.untaxed = untaxed;
          self.all_price = price + untaxed;
        } else {
          self.loadKurtList = false;
          self.purchaseFlg = false;
        }
      });
    },
    getViewList: function getViewList() {
      // 閲覧履歴リスト
      var self = this;
      axios.get(getViewListURL).then(function (res) {
        list = res.data;

        if (list.length > 0) {
          self.loadViewList = true;
          self.viewList = list;
        } else {
          self.loadViewList = false;
        }
      });
    },
    getPurchaseList: function getPurchaseList() {
      // 購入済みリスト
      var self = this;
      axios.get(getPurchaseListURL).then(function (res) {
        list = res.data;

        if (list.length > 0) {
          self.loadPurchaseList = true;
          self.purchaseList = list;
        } else {
          self.loadPurchaseList = false;
        }
      });
    },
    getGoodFlg: function getGoodFlg(itemId) {
      var self = this;
      axios.get(getGoodFlgURL + "/" + itemId).then(function (res) {
        if (res.data) {
          self.goodFlg = true;
          self.goodList = list;
        } else {
          self.goodFlg = false;
        }
      });
    },
    getKurtFlg: function getKurtFlg(itemId) {
      var self = this; // console.log("確認");

      axios.get(getKurtFlgURL + "/" + itemId).then(function (res) {
        // console.log(res.data);
        if (res.data) {
          self.kurtFlg = true;
          self.purchaseFlg = true;
        } else {
          self.kurtFlg = false;
        }
      });
    }
  },
  mounted: function mounted() {
    //Ajaxを実行
    this.getCategoryList();

    if (id === "item") {
      this.getCocktailList(itemId);
      this.getKurtFlg(itemId);
    }

    if (id === "recipe") {
      this.getCocktailList(recipe_id);
      this.getRecipeItemList(recipe_id);
      this.getGoodFlg(recipe_id);
    }

    if (id === "userHome") {
      this.getKurtList();
      this.getGoodList();
      this.getViewList();
      this.getPurchaseList();
    }
  }
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/Shared/Relocated Items/Security/works/project_file/EmploymentWork/work/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/Shared/Relocated Items/Security/works/project_file/EmploymentWork/work/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });