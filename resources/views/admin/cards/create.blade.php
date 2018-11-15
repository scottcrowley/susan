@extends('admin.layouts.app')

@section('content')
<div class="flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-white bg-blue p-3 rounded-t">
                Add a New Susan Card
            </div>
            <div class="bg-white p-3 rounded-b">
                <form class="form-horizontal" method="POST" action="{{ route('admin.cards.store') }}">
                    {{ csrf_field() }}
                    {{-- <input type="hidden" name="active" id="active" value="1"> --}}

                    <div class="flex items-stretch mb-3">
                        <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Name</label>
                        <div class="flex flex-col w-3/4">
                            <input id="name" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('name') ? 'border-red-dark' : 'border-grey-light' }}" name="name" value="{{ old('name') }}" required autofocus>
                            {!! $errors->first('name', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="flex items-stretch mb-3">
                        <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Health</label>
                        <div class="flex flex-col w-3/4">
                            <input id="health" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('health') ? 'border-red-dark' : 'border-grey-light' }}" name="health" value="{{ old('health') }}" required>
                            {!! $errors->first('health', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="flex items-stretch mb-3">
                        <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Damage</label>
                        <div class="flex flex-col w-3/4">
                            <input id="damage" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('damage') ? 'border-red-dark' : 'border-grey-light' }}" name="damage" value="{{ old('damage') }}" required>
                            {!! $errors->first('damage', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="flex items-stretch mb-3">
                        <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Rarity</label>
                        <div class="flex flex-col w-3/4">
                            <input id="rarity_id" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('rarity_id') ? 'border-red-dark' : 'border-grey-light' }}" name="rarity_id" value="{{ old('rarity_id') }}" required>
                            {!! $errors->first('rarity_id', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="flex items-stretch mb-3">
                        <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Power</label>
                        <div class="flex flex-col w-3/4">
                            <input id="power_id" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('power_id') ? 'border-red-dark' : 'border-grey-light' }}" name="power_id" value="{{ old('power_id') }}" required>
                            {!! $errors->first('power_id', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="flex items-stretch mb-3">
                        <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Image</label>
                        <div class="flex flex-col w-3/4">
                            <input id="image" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('image') ? 'border-red-dark' : 'border-grey-light' }}" name="image" value="{{ old('image') }}">
                            {!! $errors->first('image', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    @if (count($errors))
                        <div class="flex mb-3">
                            <ul class="list-reset w-3/4 ml-auto border border-red-dark rounded p-4">
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-dark text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex">
                        <div class="w-3/4 ml-auto">
                            <button type="submit" class="bg-blue hover:bg-blue-dark text-white text-sm font-semibold py-2 px-4 rounded mr-3">
                                Add
                            </button>
                            <button class="bg-transparent text-grey-dark border border-grey hover:text-grey-lightest hover:bg-grey-dark text-sm font-semibold py-2 px-4 rounded mr-3">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
