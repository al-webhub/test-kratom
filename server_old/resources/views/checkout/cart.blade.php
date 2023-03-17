@extends('layouts.app')
@section('content')
<div id="checkout-cart" class="container-maxwidth checkout-cart">
  <div class="row">
    <div class="col-xs-12">
      {{ Breadcrumbs::render('cart') }}
    </div>
  </div>
        <div class="row">
    <div id="content" class="col-sm-12">
      <h1>Shopping cart</h1>
      <div>
        <div class="table-responsive">

          <div class="conteiner">
            <div class="row checkout-name-list">
              <div class="col-xs-4 col-md-2">
                <div class="text-bold">Image</div>
              </div>
              <div class="col-xs-8 col-md-4">
                <div class="text-bold">Product Name</div>
              </div>
              <div class="col-xs-4 col-md-2">
                <div class="text-bold">Quantity</div>
              </div>
              <div class="col-xs-4 col-md-2">
                <div class="text-bold">Unit Price</div>
              </div>
              <div class="col-xs-4 col-md-2">
                <div class="text-bold">Total</div>
              </div>
            </div>
            <template v-for="(product, key) in cart">
              <template v-for="modification in product">
                <div class="mt-1 checkout-item">
                  <div class="col-md-2 col-sm-2 img">
                    <div class="text-bold">
                        <a :href="modification.product_link">
                          <img :src="modification.product_image" :alt="modification.product_name" :title="modification.product_name" class="img-thumbnail">
                        </a> 
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-3 name">
                    <div>
                      <a class="text-bold" :href="modification.product_link">@{{ modification.product_name }}</a>
                      <br>
                      <small>Choose weight: @{{ modification.name }}</small>
                    </div>
                  </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="text-bold checkout-input-wrapper">
                        <button class="minus form-control" @click="modification.amount > 1 ? modification.amount-- : false">–</button>
                        <input type="text" size="1" v-model="modification.amount" class="form-control checkout__input">
                        <button class="plus form-control" @click="modification.amount++">+</button>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="text-center">$@{{ modification.price }}</div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="text-left text-bold">$@{{ modification.price * modification.amount }}</div>
                    </div>
                    <span class="input-group-btn checkout-delete">
                        <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger " @click="deleteFromCart(key, modification.id)"></button>
                    </span>
                </div>
                
              </template>
            </template>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3 col-sm-offset-9">
          <table class="table total-form table-bordered">
            <tbody>
            <tr>
              <td class="text-right"><strong>Subtotal:</strong></td>
              <td class="text-right text-bold">$@{{ total }}</td>
            </tr>
            <tr>
              <td class="text-right"><strong>Total:</strong></td>
              <td class="text-right">$@{{ total }}</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="buttons clearfix row">
        <div class="col-xs-6 text-left"><a href="{{ url('shop') }}" class="bnt-green">Continue Shopping</a></div>
        <div class="col-xs-6 text-right"><a href="{{ url('checkout') }}" class="bnt-orang">Checkout</a></div>
      </div>
      
      <span class="b-top"></span><span class="b-right"></span><span class="b-bottom"></span><span class="b-left"></span>
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ url('js/checkout/cartVue.js') }}"></script>
@endpush