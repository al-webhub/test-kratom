<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('text.home'), route('home'));
});

// Home > Page
Breadcrumbs::for('page', function ($trail, $pageName) {
  $trail->parent('home');
  $trail->push($pageName);
});

// Home > Shop
Breadcrumbs::for('shop', function ($trail) {
  $trail->parent('home');
  $trail->push(__('text.Shop'), route('shop'));
});

// Home > Product
Breadcrumbs::for('product', function ($trail, $productName) {
  $trail->parent('shop');
  $trail->push($productName);
});

// Home > Guidebook
Breadcrumbs::for('guidebook', function ($trail) {
  $trail->parent('home');
  $trail->push(__('text.Guidebook'), route('guidebook'));
});

// Home > Guidebook > Article
Breadcrumbs::for('article', function ($trail, $articleTitle) {
  $trail->parent('guidebook');
  $trail->push($articleTitle);
});

// Home > Cart
Breadcrumbs::for('cart', function ($trail) {
  $trail->parent('home');
  $trail->push(__('text.Shopping_cart'), route('cart'));
});

// Home > Cart > Checkout
Breadcrumbs::for('checkout', function ($trail) {
  $trail->parent('cart');
  $trail->push('Checkout');
});

// Home > Account
Breadcrumbs::for('account', function ($trail) {
  $trail->parent('home');
  $trail->push(__('text.Account'), route('account'));
});

// Home > Account > Page
Breadcrumbs::for('accountPage', function ($trail, $pageName) {
  $trail->parent('account');
  $trail->push($pageName);
});