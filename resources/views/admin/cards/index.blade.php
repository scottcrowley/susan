@extends('admin.layouts.app')

@section('content')
<div class="flex px-6 md:px-0">
    <div class="w-full max-w-sm md:max-w-lg lg:max-w-xl mx-auto">
        <div class="flex flex-col md:flex-row flex-no-wrap md:flex-wrap md:-mx-2">
            @if (count($cards))
                @foreach ($cards as $card)
                    <div class="w-full md:w-1/3 lg:w-1/4 md:px-2 mb-4">
                        <div class="border border-grey p-4" style="height: 256px;">
                            <p class="title">
                                {{ $card->name }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="text-center">There are currently no Cards available.</h3>
            @endif
        </div>
    </div>
</div>
@endsection