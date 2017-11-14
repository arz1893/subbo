<div class="container" id="albumform-container">

    <div class="row">
        <div class="col s12 m12 l12">
            <label for="title" class="form-label">Title</label>
            {{ Form::text(
                'title',
                null,
                    ['class' => 'validate',
                    'placeholder' => 'Your album title\'s here',
                    'id' => 'title',
                    'style' => 'margin-bottom: 5px;']) }}
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12">
            <label for="description" class="form-label">Description</label>
            {{ Form::textarea(
                'description',
                 null,
                    ['class' => 'validate materialize-textarea',
                    'placeholder' => 'Your album description\'s here ',
                    'id' => 'description',
                    'style' => 'margin-bottom: -5px;']
                    )}}
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12" id="category_container" style="margin-top: 10px;">
            <label for="categoryList" class="form-label">Select Category</label>
            <select name="category_list[]" id="categoryList" multiple required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12">
            <label for="price" class="form-label">Price
                (<span id="min_price" data-value="{{ number_format($minPrice, 2, '.', '') }}" class="red-text">
                    *min price: {!!$currency->code . ' ' . number_format($minPrice, 2, '.', '') !!}
                </span>)
            </label>
            {!! Form::input(
                'number',
                'price',
                null,
                    ['class' => 'validate',
                     'step' => 'any',
                     'placeholder' => $currency->code,
                     'id' => 'price',
                     'style' => 'margin-bottom: 5px;']) !!}
        </div>
    </div>
</div>