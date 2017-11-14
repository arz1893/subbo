@extends('home')

@section('main')
    @include('errors.errorlist')

    <div class="container">
        {{ Form::open(['method' => 'PATCh', 'action' => ['UserController@addBankAccount', Auth::user()]]) }}
            <div class="row">
                <div class="input-field">
                    {{ Form::label('bank_name', 'Bank Name : ') }}
                    {{ Form::text('bank_name', null, ['class' => '']) }}
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    {{ Form::label('account_number', 'Account Number : ') }}
                    {{ Form::text('account_number', null, ['class' => '']) }}
                </div>
            </div>
            <div class="row">
                <div class="input-field">
                    {{ Form::submit('add bank account', ['class' => 'btn blue lighten-2', 'style' => 'width: 100%']) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection