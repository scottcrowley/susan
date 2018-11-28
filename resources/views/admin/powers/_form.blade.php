{{ csrf_field() }}

<div class="field-group">
    <label for="name" class="">Name</label>
    <div class="field">
        <input id="name" type="text" class="{{ $errors->has('name') ? 'border-red-dark' : 'border-grey-light' }}" name="name" value="{{ old('name', $power->name) }}" required autofocus>
        {!! $errors->first('name', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group">
    <label for="name">Description</label>
    <div class="field">
        <input id="description" type="text" class="{{ $errors->has('description') ? 'border-red-dark' : 'border-grey-light' }}" name="description" value="{{ old('description', $power->description) }}" required>
        {!! $errors->first('description', '<span class="danger">:message</span>') !!}
    </div>
</div>

@if (count($errors))
    <div class="field-group">
        <ul class="danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="field-group">
    <div class="w-3/4 ml-auto">
        <button type="submit" class="btn is-blue">
            {{ $btnText ?? 'Add Power' }}
        </button>
    </div>
</div>