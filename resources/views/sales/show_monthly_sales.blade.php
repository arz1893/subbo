@extends('layouts.app')

@section('content')
    <div class="container">
        <h5>Total Nett Earning</h5>
        <span style="font-size: 1.5em;" class="blue-grey-text">
            {{ "Rp " . number_format( $userWallet->deposit , 2 , ',', '.' ) }}
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
                        {{ "Rp " . number_format( $userWallet->deposit , 2 , ',', '.' ) }}
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
                            Rp 0,00
                        @else
                            Rp 10.000,00
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
                    {{ "Rp " . number_format( $userWallet->deposit - 10000 , 2 , ',', '.' ) }}
                @else
                    {{ "Rp " . number_format( $userWallet->deposit , 2 , ',', '.' ) }}
                @endif
            </div>
        </div>

        <div class="col s12 m12 l12">
            <a href="#!" class="btn amber" style="width: 100%">Withdraw</a> <br><br>
            <a href="#!" style="font-size: 1.5em;"><u>Payout Settings</u></a>
        </div>
    </div>
@endsection