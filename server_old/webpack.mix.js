const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('packages/aimix/shop/src/resources/js/fields/modification.js', 'packages/aimix/shop/js/fields')
   .js('resources/js/main.js', 'public/js/main.js')
   .js('resources/js/news/news.js', 'public/js/news')
   .js('resources/js/news/singleNews.js', 'public/js/news')
   .js('resources/js/reviews/reviews.js', 'public/js/reviews')
   .js('resources/js/catalog/catalog.js', 'public/js/catalog')
   .js('resources/js/catalog/product.js', 'public/js/catalog')
   .js('resources/js/checkout/cartVue.js', 'public/js/checkout')
   .js('resources/js/checkout/checkout.js', 'public/js/checkout')
   .js('resources/js/account/transactions.js', 'public/js/account')
   .js('resources/js/account/edit.js', 'public/js/account')
   .js('resources/js/index/index.js', 'public/js/index')
   .js('resources/js/app.js', 'public/js')
   //General
   .js(['resources/js/jspages/mix/common.js'], 'public/js/jspages/native/common.js')
   //Home
   .js(['resources/js/index/index.js'], 'public/js/jspages/home.js')
   .js(['resources/js/jspages/mix/follow-us.js', 'resources/js/jspages/mix/common.js', 'resources/js/jspages/mix/infinity-slider.js'], 'public/js/jspages/native/index.js')
   .styles([
   		'resources/css/csspages/mix/common.css', 
   		'resources/css/csspages/mix/footer.css', 
   		'resources/css/csspages/popups/popup.css',
   		'resources/css/csspages/mix/product-card.css',
   		'resources/css/csspages/home.css', 
   		'resources/css/csspages/articles.css',
        'resources/css/csspages/mix/advantages-block.css',
        'resources/css/csspages/mix/about-us-block.css',
        'resources/css/csspages/popups/result-calc.css',
   	], 'public/css/csspages/home.css')
    // Shops
    .js(['resources/js/jspages/mix/common.js',], 'public/js/jspages/native/shops.js')
    .styles([
   		'resources/css/csspages/mix/common.css', 
   		'resources/css/csspages/mix/footer.css', 
   		'resources/css/csspages/popups/popup.css',
   		'resources/css/csspages/mix/product-card.css',
        'resources/css/csspages/shop.css',
   	], 'public/css/csspages/shops.css')
    // Product page
    .js(['resources/js/jspages/mix/common.js', 'resources/js/jspages/mix/infinity-slider.js','resources/js/jspages/mix/main-slider.js'], 'public/js/jspages/native/product-page.js')
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css', 
   		'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/popups/delivery.css',
   		'resources/css/csspages/mix/product-card.css',
        'resources/css/csspages/mix/delivery.css',
        'resources/css/csspages/product.css',
        'resources/css/csspages/reviews.css',
        'resources/css/csspages/mix/product-calc.css',
   	], 'public/css/csspages/product-page.css')
    // Checkout
    .js(['resources/js/jspages/mix/common.js', 'resources/js/jspages/mix/checkout.js'], 'public/js/jspages/native/checkout.js')
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css', 
   		'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/popups/bonuses.css',
        'resources/css/csspages/checkout.css',
        'resources/css/csspages/checkout-user.css',
        'resources/css/csspages/cart.css',
        'resources/css/csspages/mix/delivery.css',
        'resources/css/csspages/mix/product-calc.css',
   	], 'public/css/csspages/checkout.css')
    // Contact
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/contacts.css',
        'resources/css/csspages/popups/popup.css',
   	], 'public/css/csspages/contact.css')
    // About us
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/about-us.css',
        'resources/css/csspages/popups/popup.css',
   	], 'public/css/csspages/about-us.css')
    // Articles
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/mix/gidebooks.css',
        'resources/css/csspages/articles.css',
        'resources/css/csspages/popups/popup.css',
   	], 'public/css/csspages/articles.css')
    // Article
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/article.css',
        'resources/css/csspages/articles.css',
        'resources/css/csspages/popups/popup.css',
   		'resources/css/csspages/mix/product-card.css',
   	], 'public/css/csspages/article.css')
    // Profile
    .js(['resources/js/jspages/mix/common.js'], 'public/js/jspages/native/profile.js')
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/popups/withdrawal.css',
        'resources/css/csspages/popups/logout.css',
        'resources/css/csspages/profile.css',
        'resources/css/csspages/mix/subscribe.css',
        'resources/css/csspages/mix/product-calc.css',
   	], 'public/css/csspages/profile.css')
    // Reviews
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/reviews.css',
   	], 'public/css/csspages/reviews.css')
    //Advantages
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/advantages.css',
        'resources/css/csspages/mix/advantages-block.css',
   	], 'public/css/csspages/advantages.css')
    //Pay Delivery
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/pay-delivery.css',
        'resources/css/csspages/mix/delivery.css',
   	], 'public/css/csspages/pay-delivery.css')
    //FAQ
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/pay-delivery.css',
        'resources/css/csspages/faq.css',
   	], 'public/css/csspages/faq.css')
    //Earn
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/mix/subscribe.css',
        'resources/css/csspages/earn-with-us.css',
   	], 'public/css/csspages/earn.css')
    //Error page
    .styles([
   		'resources/css/csspages/mix/common.css',
   		'resources/css/csspages/mix/footer.css',
        'resources/css/csspages/popups/popup.css',
        'resources/css/csspages/error.css',
   	], 'public/css/csspages/error.css')
//    .styles(['resources/css/main.css'], 'public/css/main.css');
   
   