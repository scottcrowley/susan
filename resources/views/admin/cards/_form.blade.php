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

<div class="field-group items-center">
    <label for="name" style="padding-top: 0;">Rarity</label>
    <div class="field">
        {{-- <input id="rarity_id" type="text" class="{{ $errors->has('rarity_id') ? 'border-red-dark' : 'border-grey-light' }}" name="rarity_id" value="{{ old('rarity_id', $card->rarity_id) }}" required> --}}
        <div class="relative">
            @if (count($rarities))
                <select name="rarity_id" id="rarity_id" 
                    class="block appearance-none w-full bg-grey-lighter border border-grey-light text-grey-darker py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" 
                    required>
                    <option value="">Choose a rarity</option>
                    @foreach ($rarities as $rarity)
                        <option value="{{ $rarity->id }}" {{ (($formType == 'create' && old('rarity_id') == $rarity->id) || ($formType == 'edit' && $card->rarity->id == $rarity->id)) ? 'selected' : '' }}>{{ $rarity->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                    </svg>
                </div>
            @else
                <p class="text-blue text-base">There are currently no rarity levels. Click <a href="{{ route('admin.rarities.create') }}" class="no-underline hover:underline text-blue-darker">here</a> to add one.</p>
            @endif
        </div>
        {!! $errors->first('rarity_id', '<span class="danger">:message</span>') !!}
    </div>
</div>

<div class="field-group items-center">
    <label for="name" style="padding-top: 0;">Power</label>
    <div class="field">
        {{-- <input id="power_id" type="text" class="{{ $errors->has('power_id') ? 'border-red-dark' : 'border-grey-light' }}" name="power_id" value="{{ old('power_id', $card->power_id) }}" required> --}}
        <div class="relative">
            @if (count($powers))
                <select name="power_id" id="power_id" 
                    class="block appearance-none w-full bg-grey-lighter border border-grey-light text-grey-darker py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                    required>
                    <option value="">Choose a power</option>
                    @foreach ($powers as $power)
                        <option value="{{ $power->id }}" {{ (($formType == 'create' && old('power_id') == $power->id) || ($formType == 'edit' && $card->power->id == $power->id)) ? 'selected' : '' }}>{{ $power->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                    </svg>
                </div>
            @else
                <p class="text-blue text-base">There are currently no powers available. Click <a href="{{ route('admin.powers.create') }}" class="no-underline hover:underline text-blue-darker">here</a> to add one.</p>
            @endif
        </div>
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