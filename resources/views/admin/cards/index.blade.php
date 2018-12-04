@extends('admin.layouts.app')

@section('content')
<div class="flex px-6 md:px-0">
    <div class="w-full max-w-sm md:max-w-lg lg:max-w-xl mx-auto">
        @if (count($cards))
            <p class="mb-3">Showing {{ count($cards) }} {{ str_plural('Card', count($cards)) }}</p>
            <div class="flex flex-col md:flex-row flex-no-wrap md:flex-wrap md:-mx-2">
                @foreach ($cards as $card)
                    <div class="w-full md:w-1/3 lg:w-1/4 md:px-2 mb-4">
                        <div class="border border-grey p-4" style="height: 256px;">
                            <p class="title">
                                <a href="{{ route('admin.cards.show', $card->id) }}">
                                    {{ $card->name }}
                                </a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="title text-center">There are currently no Cards available.</p>
        @endif
    </div>
</div>
@endsection