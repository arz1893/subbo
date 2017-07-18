<div class="container" id="albumform-container">
    {!! Form::hidden('user_id', Auth::User()->id) !!}

    <div class="row">
        <div class="input-field">
            {!! Form::text('title', null, ['class' => 'validate']) !!}
            {!! Form::label('title', 'Album Title') !!}
        </div>
    </div>

    <div class="row">
        <div class="input-field">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
        </div>
    </div>

    <div class="row">
        <div class="">
            <label>
                <i class="fa fa-sort" aria-hidden="true"></i>
                Select Category
            </label> <br/>

            {!! Form::select('category_list[]', $categories, null, ['multiple' => 'multiple', 'id' => 'categoryList']) !!}
        </div>
    </div>

    <div class="row">
        <div class="input-field">
            {!! Form::label('price', 'Price') !!}
            {!! Form::input('number', 'price', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12">
            <button class="btn-large waves-effect green" style="width: 100%;">
                Update
            </button>
        </div>
    </div>
</div>