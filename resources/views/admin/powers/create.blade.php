@extends('admin.layouts.app')

@section('content')
<div class="flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-white bg-blue p-3 rounded-t">
                Add a Susan Card Power
            </div>
            <div class="bg-white p-3 rounded-b">
                <form class="form-horizontal" method="POST" action="{{ route('admin.powers.store') }}">
                    @include('admin.powers._form', ['formType' => 'create'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
