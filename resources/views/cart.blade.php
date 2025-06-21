<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>



    <!-- Header Section Begin -->
    @include('header')
    <!-- Header Section End -->



    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $id => $item)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ $item['thumb'] }}" alt="" style="width: 90px">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item['name'] }}</h6>
                                                <h5>${{ number_format($item['price'], 0) }}</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <div class="quantity">
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="number" name="quantity[{{ $id }}]" value="{{ $item['quantity'] }}" min="1">
                                                </div>
                                                <button type="submit">Update</button>
                                            </form>
                                        </td>
                                        <td class="cart__price">${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                                        <td class="cart__close">
                                            <a href="{{ route('cart.delete', $id) }}"><i class="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            @php
                                $total = 0;
                                foreach($cart as $item){
                                    $total += $item['price'] * $item['quantity'];
                                }
                            @endphp

                            <li>Total <span>${{ number_format($total, 0) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Footer Section Begin -->
    @include('layouts.footer')
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    @include('layouts.jsplugins')
</body>

</html>
