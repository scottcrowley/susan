@extends('admin.layouts.app')

@section('content')
<div class="flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-white bg-blue p-3 rounded-t">
                {{ $power->name }}
            </div>
            <div class="bg-white p-4">
                <p class="mb-2 text-grey-darkest">Description: {{ $power->description }}</p>
                <div class="flex">
                   <p class="mb-2 text-grey-darkest mr-2">Cards using:</p>
                   <div class="flex-1">
                        @if (count($cards))
                            @foreach ($cards as $card)
                                <p class="mb-1">
                                    <a href="{{ route('admin.cards.show', $card->id) }}" class="no-underline text-grey-darker hover:underline">{{ $card->name }}</a>
                                </p>
                            @endforeach
                        @else 
                            <p class="text-grey-darkest">There are no cards using this power.</p>
                        @endif
                   </div>
                </div>
            </div>
            @can ('update', $power)
                <div class="border-t flex justify-between bg-white py-4 px-8 rounded-b">
                    <form action="{{ route('admin.powers.edit', $power->id) }}" method="GET">
                        {{ csrf_field() }}
                        <button type="submit" class="btn is-blue">Edit</button>
                    </form>
                    <delete-confirm-button classes="btn" label="Delete" table="powers" :data-set="{{ $power }}">
                        <span slot="title">Are you sure?</span>
                        Are you sure you want to do delete this power? This action is not undoable.
                    </delete-confirm-button>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection
