<div class="container">
    <div class="row">
        <div class="input-field">
            {{ Form::label('name', 'Profile Name : ') }}
            {{ Form::text('name', null, ['class' => 'validate']) }}
        </div>
    </div>

    <div class="row">
        <div class="input-field">
            {{ Form::label('about', 'About you') }}
            {{ Form::textarea('about', null, ['class' => 'materialize-textarea', 'placeholder' => 'Tell about yourself']) }}
        </div>
    </div>
</div>