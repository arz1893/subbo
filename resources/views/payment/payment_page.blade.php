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
                        <span class="right">{{ "Rp " . number_format( $album->price , 2 , ',', '.' ) }}</span>
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
                        <h5>Total <span class="right"> {{ "Rp " . number_format( $album->price , 2 , ',', '.' ) }}</span></h5>
                    </div>

                </div>
            </li>
        </ul>

        <h5 class="blue-grey-text">Pay with</h5>
        <a href="#modal_payment_confirm">
            <img src="{{ asset('images/default/Paypal-icon.png') }}" width="75" height="75">
        </a>
        <a href="#!">
            <img src="{{ asset('images/default/maestro-logo.png') }}" width="75" height="75">
        </a>
        <a href="#!">
            <img src="{{ asset('images/default/visa-debit.png') }}" width="75" height="75">
        </a>
    </div>

    <!-- Modal Structure -->
    <div id="modal_payment_confirm" class="modal">
        <div class="modal-content">
            <h4 class="blue-text">Info !</h4>
            <p>Are you sure want to buy this album</p>
        </div>
        <div class="modal-footer">
            {{ Form::open(['action' => 'PaymentController@buyAlbum', 'id' => 'form-payment']) }}
                {{ Form::hidden('album_id', $album->id) }}
            {{ Form::close() }}
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green-text" onclick="$('#form-payment').submit()">
                Buy <i class="fa fa-dollar"></i>
            </a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">
                Cancel <i class="fa fa-ban"></i>
            </a>
        </div>
    </div>
@endsection