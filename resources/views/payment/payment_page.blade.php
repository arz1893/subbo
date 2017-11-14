@extends('layouts.app')

@section('content')
    <div class="container">
        <h5 class="blue-grey-text">Payment</h5>
        <hr>

        <!-- Order Recap -->
        <ul class="collapsible checkout-header animated fadeindown delay-2" data-collapsible="accordion">
            <li>
                <div class="collapsible-header active">
                    Show order summary
                    <i class="ion-android-arrow-dropdown"></i>
                    <span class="checkout-price right">
                        <i class="medium material-icons">receipt</i>
                    </span>
                </div>
                <div class="collapsible-body z-depth-1">
                    {{ Form::open(['action' => 'PaymentController@createInvoice', 'id' => 'form_paypal_invoice']) }}
                        {{ Form::hidden('album_id', $album->id, ['id' => 'album_id']) }}
                    {{ Form::close() }}
                    <!-- Products in cart -->
                    <div class="checkout-details">
                        <img class="checkout-image" src="{{ asset($imageCover->thumbnail_path) }}" width="75" height="75">
                        <span class="right">{{ $userCurrency->code . " " . number_format( $album->price , 2 , '.', '.' ) }}</span>
                        <div class="checkout-product-title">
                            <h5 id="product_title" data-value="{{ $album->title }}">{{ $album->title }}</h5>
                            <h5>Description:</h5>
                            <p id="product_description">
                                {{ $album->description }}
                            </p>
                            <div>
                                @unless($album->categories->isEmpty())
                                    <h5>Category : </h5>
                                    <ul>
                                        @foreach($album->categories as $category)
                                            <div class="chip">
                                                <img src="{{ asset('images/default/' . $category->image) }}">
                                                {{ $category->category_name }}
                                            </div>
                                        @endforeach
                                    </ul>
                                @endunless
                            </div>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="total">
                        <h5>
                            Total
                            <span id="product_price"
                                  data-currency="{{ $userCurrency->code }}"
                                  data-value="{{ $convertedPrice }}"
                                  class="right">
                                {{ $userCurrency->code . " " . number_format( $album->price , 2 , '.', '.' ) }}
                            </span>
                        </h5>
                    </div>

                </div>
            </li>
        </ul>

        <h5 class="blue-grey-text">Pay with</h5>

        <div id="paypal-button-container"></div>

        {{--<a href="#modal_paypal_confirm" style="margin: 1%" onclick="checkCurrency(this)">--}}
            {{--<img src="{{ asset('images/default/Paypal-icon.png') }}" width="75" height="75">--}}
        {{--</a>--}}

        {{--<a href="#!" id="snap-pay-button" style="margin: 1%">--}}
            {{--{{ Form::open(['action' => 'PaymentController@midtransFinish', 'id' => 'form-midtrans', 'style' => 'display:inline']) }}--}}
                {{--{{ Form::hidden('result_type', null, ['id' => 'result_type']) }}--}}
                {{--{{ Form::hidden('result_data', null, ['id' => 'result_data']) }}--}}
            {{--{{ Form::close() }}--}}

            {{--<img src="{{ asset('images/default/midtrans.png') }}" width="125">--}}
        {{--</a>--}}

        {{--<a href="#!" style="margin: 1%">--}}
            {{--<img src="{{ asset('images/default/visa-debit.png') }}" width="75" height="75">--}}
        {{--</a>--}}
    </div>

@endsection

@push('page-script')
    <script src="{{ asset('js/paypal/paypal_payment_config.js') }}" type="text/javascript"></script>
@endpush