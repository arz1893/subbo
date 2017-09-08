@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Session::has('msg'))
            <div class="chip green white-text center" style="width: 100%;">
                Info! {{ \Session::get('msg') }}
                <i class="close material-icons">close</i>
            </div>
        @elseif(\Session::has('error'))
            <div class="chip red white-text center" style="width: 100%;">
                {{ \Session::get('error') }}
                <i class="close material-icons">close</i>
            </div>
        @endif

        <h5>Total Nett Earning</h5>
        <span style="font-size: 2em;" class="blue-grey-text">
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
            <a href="#modal-withdraw" class="btn amber modal-trigger" style="width: 100%">Withdraw</a> <br><br>
            <a href="{{ route('account_setting', Auth::user()->id) }}" style="font-size: 1.5em;"><u>Payout Settings</u></a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal-withdraw" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="green-text">Withdraw</h4>
            <p>Your deposit : {{ $currency->code . " " . number_format( $userWallet->deposit , 2 , '.', '.' ) }} </p>
            {{ Form::open(['method' => 'POST', 'action' => 'SalesController@withdrawDeposit', 'id' => 'form-deposit']) }}
                {{ Form::hidden('user_id', Auth::user()->id) }}
                <input type="hidden" id="max-withdraw" value="{{ $userWallet->deposit }}">
                {{ Form::label('withdraw_amount', 'How much ?') }}
                {{ Form::input('number', 'withdraw_amount', null, ['class' => 'validate', 'id' => 'txt_withdraw_amount']) }}
                <button type="button" id="btn-max-withdraw" class="btn amber darken-2" style="width: 100%">Max</button>
        </div>
        <div class="modal-footer">
            <button type="submit" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Withdraw</button>
            <button type="button" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection