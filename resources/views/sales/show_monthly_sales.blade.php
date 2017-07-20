@extends('layouts.app')

@section('content')
    <div class="container">
        <h5>Total Nett Earning</h5>
        <span style="font-size: 1.5em;" class="blue-grey-text">
            {{ $currency->code . " " . number_format( $userWallet->deposit , 2 , '.', '.' ) }}
        </span>
        <hr>

        <h5>Next payout</h5>
        <span style="font-size: 1.5em;" class="blue-grey-text">Aug, 8th</span>
        <hr>

        <h5>Details</h5>
        <span style="font-size: 1.5em;">
            <span class="row">
                <span class="col s6">
                    <span class="blue-grey-text">Sales</span>
                </span>
                <span class="col s6">
                    <span class="blue-grey-text">
                        {{ $currency->code . " " . number_format( $userWallet->deposit , 2 , '.', '.' ) }}
                    </span>
                </span>
            </span>
            <span class="row">
                <span class="col s6">
                    <span class="blue-grey-text">Fees</span>
                </span>
                <span class="col s6">
                    <span class="blue-grey-text">
                        @if($userWallet->deposit == 0)
                            {{ $currency->code . " " . "00.00" }}
                        @else
                            {{ $currency->code . " " . number_format( $userWallet->deposit * 0.01 , 2 , '.', '.' ) }}
                        @endif
                    </span>
                </span>
            </span>
        </span>
        <hr>
        <div class="row">
            <div class="col s6">
                <h5>Nett</h5>
            </div>
            <div class="col s6 blue-grey-text" style="font-size: 1.5em;">
                @if($userWallet->deposit >= 10000)
                    {{ $currency->code . " " . number_format( $userWallet->deposit - ($userWallet->deposit * 0.01) , 2 , '.', '.' ) }}
                @else
                    {{ $currency->code . " " . number_format( $userWallet->deposit , 2 , '.', '.' ) }}
                @endif
            </div>
        </div>

        <div class="col s12 m12 l12">
            <a href="#!" class="btn amber" style="width: 100%">Withdraw</a> <br><br>
            <a href="{{ route('account_setting', Auth::user()->id) }}" style="font-size: 1.5em;"><u>Payout Settings</u></a>
        </div>
    </div>
@endsection