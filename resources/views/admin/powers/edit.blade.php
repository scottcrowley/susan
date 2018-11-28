@extends('admin.layouts.app')

@section('content')
<div class="flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-white bg-blue p-3 rounded-t">
                Update the {{ $power->name }} Power
            </div>
            <div class="bg-white p-3 rounded-b">
                <form class="form-horizontal" method="POST" action="{{ route('admin.powers.update', [ 'power' => $power->id]) }}">
                    {{ method_field('PATCH') }}
                    @include('admin.powers._form', ['btnText' => 'Update Power', 'formType' => 'edit'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
