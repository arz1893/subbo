@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="chip red white-text center" style="width: 100%;">
            Error! {{$error}}
            <i class="close material-icons">close</i>
        </div>
    @endforeach
@endif