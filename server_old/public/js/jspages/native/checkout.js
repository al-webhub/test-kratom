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
/******/ 	return __webpack_require__(__webpack_require__.s = 16);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/jspages/mix/checkout.js":
/*!**********************************************!*\
  !*** ./resources/js/jspages/mix/checkout.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.addEventListener("load", function (event) {
  // Checkout 
  document.addEventListener('click', function (e) {
    var item = e.target;

    if (item.closest(".checkout__item:not(.active)")) {
      if (item.closest(".checkout__item:not(.active)").previousElementSibling.classList.contains('active')) {
        item.closest(".checkout__item:not(.active)").previousElementSibling.classList.add('noty');
      }

      setTimeout(function () {
        document.querySelectorAll(".checkout__item.active").forEach(function (item) {
          item.classList.remove('noty');
        });
      }, 7000);
    }

    if (item.closest(".checkout__item.active")) {
      item.closest(".checkout__item.active").classList.remove('noty');
    }

    if (!item.closest(".checkout__item")) {
      if (document.querySelector(".checkout__item.active")) {
        document.querySelector(".checkout__item.active").classList.remove('noty');
      }
    }
  }); // Checkout 
});

/***/ }),

/***/ "./resources/js/jspages/mix/common.js":
/*!********************************************!*\
  !*** ./resources/js/jspages/mix/common.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.addEventListener("load", function (event) {
  // PAGES PRELOADER	
  //document.querySelector('.preloader').classList.add('hide');
  document.querySelector('html').setAttribute('style', ""); // HEADER

  var burger = document.querySelector('.header__burger');
  var burgerList = document.querySelector(".header__nav");
  var burgerClose = document.querySelector('.header__close-nav');
  burger.addEventListener('click', function () {
    burgerList.classList.add("active");
    document.querySelector('html').classList.add('overflow');
  });
  burgerClose.addEventListener('click', function () {
    burgerList.classList.remove('active');
    document.querySelector('html').classList.remove('overflow');
  }); // POPUPS

  var overlay = document.querySelector('.overlay');
  var htmlOverflow = document.querySelector('html');
  document.addEventListener('click', function (e) {
    var item = e.target;

    if (item.closest('.js-button')) {
      var getData = item.closest('.js-button').getAttribute('data-target');
      var popupActive = document.querySelector('.popup.active, .popup2.active');
      var popup = document.querySelector('.popup[data-target = ' + getData + '], .popup2[data-target = ' + getData + ']');

      if (popupActive && !popupActive.classList.contains("popup-noty-cart")) {
        popupActive.classList.remove('active');
      }

      popup.classList.add('active');
      overlay.classList.add('active');
      htmlOverflow.classList.add('overflow');
    }
  });
  document.addEventListener('click', function (e) {
    var elem = e.target;

    if (elem.closest('.js-close')) {
      var popupActive = elem.closest('.popup.active');
      var popupReviews = document.querySelector(".popup-reviews.active");

      if (popupReviews) {
        popupReviews.querySelector('.clients-say__info__text').remove();
        popupReviews.querySelector('.clients-say__item__footer').remove();
      }

      if (popupActive) {
        popupActive.classList.remove('active');
      }

      if (popupActive && !document.querySelector(".popup-noty-cart").classList.contains("active")) {
        overlay.classList.remove('active');
        htmlOverflow.classList.remove('overflow');
      }
    }
  });
  overlay.addEventListener('click', function () {
    var popupActive = document.querySelector('.popup.active');
    var popupReviews = document.querySelector(".popup-reviews.active");

    if (popupReviews) {
      popupReviews.querySelector('.clients-say__info__text').remove();
      popupReviews.querySelector('.clients-say__item__footer').remove();
    }

    popupActive.classList.remove('active');
    overlay.classList.remove('active');
    htmlOverflow.classList.remove('overflow');
  }); // SCROLL TOP

  var wrapperToTop = document.querySelector('.button-to-top');
  var buttonToTop = document.querySelector('.to-top');
  document.addEventListener('scroll', function () {
    if (window.pageYOffset > 1000) {
      wrapperToTop.classList.add('show');
    } else {
      wrapperToTop.classList.remove('show');
    }
  });
  buttonToTop.addEventListener('click', function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }); // Main input

  var allInput = document.querySelectorAll('.js-input');

  function checkInput(inputItems) {
    inputItems.forEach(function (item) {
      var itemLenght = item.value.length;
      var inputWrapper = item.closest('.js-input-wrapper');

      if (itemLenght) {
        inputWrapper.classList.add('active-input');
      } else {
        inputWrapper.classList.remove('active-input');
      }

      item.addEventListener("keyup", function () {
        var itemLenght = item.value.length;

        if (itemLenght) {
          inputWrapper.classList.add('active-input');
        } else {
          inputWrapper.classList.remove('active-input');
        }
      });
    });
  }

  checkInput(allInput);
  document.addEventListener("click", function (e) {
    var item = e.target;

    if (item.closest(".general-tabs__item")) {
      var _allInput = document.querySelectorAll('.js-input');

      checkInput(_allInput);
    }
  }); // /Main input
  // Show password 

  document.addEventListener("click", function (e) {
    var item = e.target;

    if (item.closest(".show-password")) {
      var wrapperInput = item.closest(".js-input-wrapper");
      var activeInput = wrapperInput.querySelector(".js-input");
      var getState = activeInput.getAttribute("type");

      if (getState == "password") {
        activeInput.setAttribute("type", "text");
      } else {
        activeInput.setAttribute("type", "password");
      }
    }
  }); // /Show password
  // Drop

  var dropList = document.querySelectorAll('.js-drop-item');
  document.addEventListener('click', function (e) {
    var element = e.target;

    if (element.closest('.js-drop-button')) {
      var isActive = element.closest('.js-drop-item').classList.contains('active') ? true : false;
      dropList.forEach(function (item) {
        item.classList.remove('active');
      });

      if (isActive) {
        element.closest('.js-drop-item').classList.remove('active');
      } else {
        element.closest('.js-drop-item').classList.add('active');
      }
    }

    if (element.closest('.js-drop-contains')) {
      var _allInput2 = document.querySelectorAll('.js-input');

      checkInput(_allInput2);

      var _dropList = element.closest('.js-drop-item');

      var dropItems = _dropList.querySelectorAll('.js-drop-contains');

      dropItems.forEach(function (item) {
        item.classList.remove('active');
      });
      element.closest('.js-drop-contains').classList.add('active');
      var innerContent = element.closest('.js-drop-contains').querySelector('.text').innerHTML;

      var dropInput = _dropList.querySelector('.js-drop-input');

      if (dropInput) {
        dropInput.value = innerContent;
      }

      checkInput(_allInput2); // close dropdown

      _dropList.classList.remove('active');
    }
  });
  document.querySelector('body').addEventListener('click', function (event) {
    var dropItem = event.target.closest('.js-drop-item');

    if (!dropItem) {
      document.querySelectorAll('.js-drop-item').forEach(function (item) {
        item.classList.remove('active');
      });
      document.querySelector('.header__search__input').value = "";
    }

    if (dropItem) {
      if (!dropItem.classList.contains("active")) {
        document.querySelectorAll('.js-drop-item').forEach(function (item) {
          item.classList.remove('active');
        });
      }
    }
  }); // //Drop
  // More info

  function showMoreInfo() {
    var info = document.querySelectorAll('.js-item .js-content p');
    var content = document.querySelectorAll('.js-item .js-content');
    var moreButton = document.querySelectorAll('.js-item .js-more');

    if (info) {
      for (var i = 0; info.length > i; i++) {
        if (info[i].offsetHeight > content[i].offsetHeight) {
          moreButton[i].classList.add('show');
        } else {
          moreButton[i].classList.remove('show');
        }
      }
    }
  }

  showMoreInfo();
  window.addEventListener('resize', function () {
    showMoreInfo();
  });
  document.addEventListener('click', function (e) {
    var elem = e.target;

    if (elem.closest(".js-more")) {
      var wrapper = elem.closest(".js-more").closest('.js-item');
      var firstElem = wrapper.querySelector(".clients-say__info__text").cloneNode(true);
      var secondElem = wrapper.querySelector(".clients-say__item__footer").cloneNode(true);
      document.querySelector('.popup-reviews__wrapper').append(firstElem);
      document.querySelector('.popup-reviews__wrapper').append(secondElem);
    }
  }); // /More info

  /* Reviews */

  document.addEventListener('click', function (e) {
    var item = e.target;

    if (item.closest('.js-reviews-button')) {
      var wrapper = item.closest('.js-drop-item');
      wrapper.classList.remove('active');
    }
  });
  /* //Reviews */

  /* Check pass */

  var inputPass = document.querySelector('.js-password');
  var inputPassComfirm = document.querySelector('.js-password-confirm');
  var passButon = document.querySelector('.js-pass-button');
  var inputValue;
  var inputValueComfirm;
  inputPass.addEventListener('keyup', function () {
    inputValue = this.value;

    if (inputValue.length > 7) {
      document.querySelector('.js-check-pass-item[data-target = min-value]').classList.add("active");
      inputPassComfirm.closest('.input__wrapper').classList.remove('disabled');
    } else {
      document.querySelector('.js-check-pass-item[data-target = min-value]').classList.remove("active");
      inputPassComfirm.closest('.input__wrapper').classList.add('disabled');
    }

    if (inputValue.match(/\d/)) {
      document.querySelector('.js-check-pass-item[data-target = number]').classList.add("active");
    } else {
      document.querySelector('.js-check-pass-item[data-target = number]').classList.remove("active");
    }

    if (inputValue.match(/[A-Za-z]/)) {
      document.querySelector('.js-check-pass-item[data-target = letter]').classList.add("active");
    } else {
      document.querySelector('.js-check-pass-item[data-target = letter]').classList.remove("active");
    }
  });
  inputPassComfirm.addEventListener('keyup', function () {
    inputValueComfirm = this.value;

    if (inputValue == inputValueComfirm) {
      document.querySelector('.js-pass-button').classList.remove("disabled");
    } else {
      document.querySelector('.js-pass-button').classList.add("disabled");
    }
  });
  /* //Check pass */
});

/***/ }),

/***/ 16:
/*!*****************************************************************************************!*\
  !*** multi ./resources/js/jspages/mix/common.js ./resources/js/jspages/mix/checkout.js ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/html/kratomhelper.com/resources/js/jspages/mix/common.js */"./resources/js/jspages/mix/common.js");
module.exports = __webpack_require__(/*! /var/www/html/kratomhelper.com/resources/js/jspages/mix/checkout.js */"./resources/js/jspages/mix/checkout.js");


/***/ })

/******/ });