<div class="container" id="albumform-container">

    <div class="row">
        <div class="">
            <label for="title" class="form-label">Title</label>
            {{ Form::text('title', null, ['class' => 'validate', 'placeholder' => 'Your album title\'s here', 'id' => 'title']) }}
        </div>
    </div>

    <div class="row">
        <div class="">
            <label for="description" class="form-label">Description</label>
            {{ Form::textarea('description', null, ['class' => 'validate materialize-textarea', 'placeholder' => 'Your album description\'s here ', 'id' => 'description']) }}
        </div>
    </div>

    <div class="row" id="category_container">
        <label for="category_list" class="form-label">Select Category</label>
        {!! Form::select('category_list[]', $categories, null, ['multiple', 'id' => 'categoryList', 'placeholder' => 'Choose . . .']) !!}
    </div>

    <div class="row">
        <div class="">
            <label for="price" class="form-label">Price</label>
            {!! Form::input('number', 'price', null, ['class' => 'validate', 'step' => 'any', 'placeholder' => 'Rp.', 'id' => 'price']) !!}
        </div>
    </div>
</div>