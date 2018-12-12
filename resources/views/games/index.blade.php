@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-2/3 md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-grey-darkest bg-blue-light p-3 rounded-t">
                Played Games
            </div>
            <div class="bg-white px-3 py-4 rounded-b">
                @if (count($games))
                    @foreach ($games as $game)
                        <div class="flex items-center justify-between h-8 item-list">
                            <p class="text-sm"><span class="font-semibold">{{ $game->name }}</span></p>
                            @if (! $game->completed)
                                @if (array_has($game->meta['players'], auth()->id()))
                                    <button class="btn text-xs p-1">Continue Game</button>
                                @else
                                    <p class="text-xs text-blue-dark font-semibold">Incomplete Game</p>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>No games have been played yet. Click <a href="/games/create">here</a> to start a new game.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
