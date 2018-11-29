@extends('admin.layouts.app')

@section('content')
<div class="flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-white bg-blue p-3 rounded-t">
                {{ $card->name }}
            </div>
            <div class="bg-white p-4">
                <p class="mb-2 text-grey-darkest">Health: {{ $card->health }}</p>
                <p class="mb-2 text-grey-darkest">Damage: {{ $card->damage }}</p>
                <p class="mb-2 text-grey-darkest">Power: {{ $card->power->name }}</p>
                <p class="mb-2 text-grey-darkest">Rarity: {{ $card->rarity->name }}</p>
            </div>
            @can ('update', $card)
                <div class="border-t flex justify-between bg-white py-4 px-8 rounded-b">
                    <form action="{{ route('admin.cards.edit', $card->id) }}" method="GET">
                        {{ csrf_field() }}
                        <button type="submit" class="btn is-blue">Edit</button>
                    </form>
                    <delete-confirm-button classes="btn" label="Delete" table="cards" :data-set="{{ $card }}">
                        <span slot="title">Are you sure?</span>
                        Are you sure you want to do delete this card? You can not undo this action.
                    </delete-confirm-button>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection
