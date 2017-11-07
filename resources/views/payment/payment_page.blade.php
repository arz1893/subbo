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

                    <!-- Products in cart -->
                    <div class="checkout-details">
                        <img class="checkout-image" src="{{ asset($imageCover->thumbnail_path) }}" width="75" height="75">
                        <span class="right">{{ $userCurrency->code . " " . number_format( $album->price , 2 , '.', '.' ) }}</span>
                        <div class="checkout-product-title">
                            <h6>{{ $album->title }}</h6>
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
                        <h5>Total <span class="right"> {{ $userCurrency->code . " " . number_format( $album->price , 2 , '.', '.' ) }}</span></h5>
                    </div>

                </div>
            </li>
        </ul>

        <h5 class="blue-grey-text">Pay with</h5>

        {{--<div id="paypal-button"></div>--}}

        <a href="#modal_paypal_confirm" style="margin: 1%" onclick="checkCurrency(this)">
            <img src="{{ asset('images/default/Paypal-icon.png') }}" width="75" height="75">
        </a>

        <a href="#!" id="snap-pay-button" style="margin: 1%">
            {{ Form::open(['action' => 'PaymentController@midtransFinish', 'id' => 'form-midtrans', 'style' => 'display:inline']) }}
                {{ Form::hidden('result_type', null, ['id' => 'result_type']) }}
                {{ Form::hidden('result_data', null, ['id' => 'result_data']) }}
            {{ Form::close() }}

            <img src="{{ asset('images/default/midtrans.png') }}" width="125">
        </a>

        <a href="#!" style="margin: 1%">
            <img src="{{ asset('images/default/visa-debit.png') }}" width="75" height="75">
        </a>
    </div>

    <!-- Modal Structure -->
    <div id="modal_paypal_confirm" class="modal">
        <div class="modal-content">
            <h4 class="blue-text">Info !</h4>
            <p>Are you sure want to buy this album</p>
        </div>
        <div class="modal-footer">
            {{ Form::open(['action' => 'PaymentController@buyWithPaypal', 'id' => 'form-paypal']) }}
                {{ Form::hidden('album_id', $album->id, ['id' => 'album_id']) }}
            {{ Form::close() }}

            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green-text" onclick="$('#form-paypal').submit()">
                Buy <i class="fa fa-dollar"></i>
            </a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">
                Cancel <i class="fa fa-ban"></i>
            </a>
        </div>
    </div>
@endsection

@push('page-script')
    <script type="text/javascript">
        paypal.Button.render({
            env: 'sandbox',
            client: {
                sandbox: 'AdL4stVjRPdbHHBGMDNGV9khGuwN5JJHFBvdDAZ6_I764zBUAXIFJmAvNmQ-Cho4-H1qM4zJi5A2Pn91'
            },
            style: {
                size: 'small',
                color: 'blue',
                shape: 'rect',
                label: 'checkout'
            },
            commit: true,       // Show 'Pay Now' button
            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '1.00', currency: 'USD' }
                            }
                        ]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(payment) {

                    console.log(payment);
                });
            }
        }, '#paypal-button');
    </script>
@endpush