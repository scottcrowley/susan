{{ csrf_field() }}

<div class="field-group">
    <label for="name" class="">Name</label>
    <div class="field">
        <input id="name" type="text" class="{{ $errors->has('name') ? 'border-red-dark' : 'border-grey-light' }}" name="name" value="{{ old('name', $card->name) }}" required autofocus>
        {!! $errors->first('name', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group">
    <label for="name">Health</label>
    <div class="field">
        <input id="health" type="text" class="{{ $errors->has('health') ? 'border-red-dark' : 'border-grey-light' }}" name="health" value="{{ old('health', $card->health) }}" required>
        {!! $errors->first('health', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group">
    <label for="name">Damage</label>
    <div class="field">
        <input id="damage" type="text" class="{{ $errors->has('damage') ? 'border-red-dark' : 'border-grey-light' }}" name="damage" value="{{ old('damage', $card->damage) }}" required>
        {!! $errors->first('damage', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group">
    <label for="name">Rarity</label>
    <div class="field">
        <input id="rarity_id" type="text" class="{{ $errors->has('rarity_id') ? 'border-red-dark' : 'border-grey-light' }}" name="rarity_id" value="{{ old('rarity_id', $card->rarity_id) }}" required>
        {!! $errors->first('rarity_id', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group">
    <label for="name">Power</label>
    <div class="field">
        <input id="power_id" type="text" class="{{ $errors->has('power_id') ? 'border-red-dark' : 'border-grey-light' }}" name="power_id" value="{{ old('power_id', $card->power_id) }}" required>
        {!! $errors->first('power_id', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group">
    <label for="name">Image</label>
    <div class="field">
        <input id="image" type="text" class="{{ $errors->has('image') ? 'border-red-dark' : 'border-grey-light' }}" name="image" value="{{ old('image', $card->image) }}">
        {!! $errors->first('image', '<span class="danger">:message</span>') !!}
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
            {{ $btnText ?? 'Add Card' }}
        </button>
    </div>
</div>