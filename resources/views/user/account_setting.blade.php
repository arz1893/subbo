@extends('home')

@section('main')
    <div class="container">
        <h4 class="blue-grey-text">Account Setting</h4>
        <hr>

        @if(\Session::has('error'))
            <div class="chip red white-text center" style="width: 100%;">
                Error! {{ \Session::get('error') }}
                <i class="close material-icons">close</i>
            </div>
        @elseif(\Session::has('success'))
            <div class="chip green lighten-1 white-text center" style="width: 100%;">
                Success! {{ \Session::get('success') }}
                <i class="close material-icons">close</i>
            </div>
        @endif

        <table class="highlight">
            <tbody>
                <tr>
                    <td>
                        E-mail :
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Password :
                    </td>
                    <td>
                        @if($user->password == null)
                            <span class="blue-grey-text">You haven't set your password</span> <br>
                            <a href="#modal_add_password">
                                Add your password <i class="fa fa-shield" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="#modal_password">
                                Change your password <i class="fa fa-shield" aria-hidden="true"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Number :
                    </td>
                    <td>
                        @if($user->bank_name && $user->account_number != null)
                            <ul class="collection">
                                <li class="collection-item avatar">
                                    <i class="fa fa-credit-card circle blue lighten-2"></i>
                                    <span class="title">{{ $user->bank_name }}</span>
                                    <p>{{ $user->account_number }}</p>
                                    <a href="#modal_account" class="amber-text">
                                        <i class="fa fa-pencil-square fa-2x"></i>
                                    </a>
                                    <a href="#!" class="red-text">
                                        <i class="fa fa-trash fa-2x"></i>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <a href="#modal_account">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> add your bank account
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        Select Currency :
                    </td>
                    <td>
                        @if($user->currency == null)
                            <a href="#modal_currency">
                                set your currency <i class="fa fa-pencil-square"></i>
                            </a>
                        @else
                            @foreach($currencies as $currency)
                                @if($user->currency_id == $currency->id)
                                    {{ $currency->code }} - {{ $currency->country }}
                                    <a href="#modal_currency">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div>
            <h4 class="blue-grey-text">Social</h4>
            <hr>
            connect with : <br>
            <table class="highlight">
                <tbody>
                    <tr>
                        <td>
                            <a href="#!" class="btn waves-effect waves-light blue pulse">
                                <i class="fa fa-facebook-square " aria-hidden="true"></i> Facebook
                            </a>
                        </td>
                        <td>
                            @if($user->provider_id != null)
                                status : <span class="blue-text text-lighten-2">connected</span> <br>
                                <a href="#!" class="grey-text">disconnect account ?</a>
                            @else
                                status : <span class="red-text">disconnected</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#!" class="btn waves-effect waves-light purple pulse">
                                <i class="fa fa-instagram" aria-hidden="true"></i> Instagram
                            </a>
                        </td>
                        <td>
                            status : <span class="red-text">disconnected</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Section --}}
    <div id="modal_currency" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5 class="blue-grey-text">Set your currency</h5> <br>
            {{ Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@updateCurrency', Auth::user()], 'id' => 'form-currency']) }}
            <label for="currency_id" style="font-size: 1em; color: black;">Choose country</label>
            {{ Form::select('currency_id', $select_currency, null, ['id' => 'select_currency', 'placeholder' => 'choose. . .']) }}
            {{ Form::close() }}
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="$('#form-currency').submit()">Update</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
    </div>

    <div id="modal_account" class="modal modal-fixed-footer">
        <div class="modal-content">
            @if($user->account_number != null)
                <h5 class="blue-grey-text">Update your bank account</h5> <br>
            @else
                <h5 class="blue-grey-text">Add your bank account</h5> <br>
            @endif

            {{ Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@addBankAccount', $user], 'id' => 'form-bank-account']) }}
            <div class="row">
                <div class="">
                    {{ Form::label('bank_name', 'Bank Name : ', ['class' => 'form-label']) }}
                    {{ Form::text('bank_name', null, ['class' => 'validate']) }}
                </div>
            </div>
            <div class="row">
                <div class="">
                    {{ Form::label('account_number', 'Account Number : ', ['class' => 'form-label']) }}
                    {{ Form::text('account_number', null, ['class' => 'validate']) }}
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="waves-effect waves-green btn-flat">
                @if($user->account_number != null)
                    Update
                @else
                    Add
                @endif
            </button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>

            {{ Form::close() }}
        </div>
    </div>

    <div id="modal_add_password" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5 class="blue-grey-text">Add Password</h5> <br><br>
            {{ Form::open(['method' => 'POST', 'action' => ['UserController@changePassword', Auth::user()], 'id' => 'form-add-password']) }}
            <div class="row">
                <div class="">
                    {{ Form::label('password', 'New Password : ', ['class' => 'form-label']) }}
                    {{ Form::password('password', null, ['class' => 'validate', 'placeholder' => 'New Password', 'id' => 'password']) }}
                </div>
            </div>
            <div class="row">
                <div class="">
                    {{ Form::label('password_confirmation', 'Confirm Password : ', ['class' => 'form-label']) }}
                    {{ Form::password('password_confirmation', null, ['class' => 'validate', 'placeholder' => 'Confirm Password', 'id' => 'password_confirmation']) }}
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" href="#!" class="waves-effect waves-green btn-flat">Update</button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>

    <div id="modal_password" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5 class="blue-grey-text">Manage Password</h5>
            <a href="#!">forgot your password ? </a> <br> <br>
        {{ Form::open(['method' => 'POST', 'action' => ['UserController@changePassword', Auth::user()], 'id' => 'form-password']) }}
            <div class="row">
                {{ Form::hidden('user_id', $user->id) }}
                <div class="">
                    {{ Form::label('current_password', 'Current Password : ', ['class' => 'form-label']) }}
                    {{ Form::password('current_password', null, ['class' => 'validate', 'placeholder' => 'Old Password', 'id' => 'current_password']) }}
                </div>
            </div>
            <div class="row">
                <div class="">
                    {{ Form::label('password', 'New Password : ', ['class' => 'form-label']) }}
                    {{ Form::password('password', null, ['class' => 'validate', 'placeholder' => 'New Password', 'id' => 'password']) }}
                </div>
            </div>
            <div class="row">
                <div class="">
                    {{ Form::label('password_confirmation', 'Confirm Password : ', ['class' => 'form-label']) }}
                    {{ Form::password('password_confirmation', null, ['class' => 'validate', 'placeholder' => 'Confirm Password', 'id' => 'password_confirmation']) }}
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" href="#!" class="waves-effect waves-green btn-flat">Update</button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>
@endsection