@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="flex flex-col h-full items-center mt-32">
        <div>
            <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
                {{ config('app.name', 'Laravel') }}
            </h1>
        </div>
        <a href="{{ route('games.index') }}" class="btn is-blue w-1/2 text-center">Let's Begin...</a>
    </div>
</div>
@endsection