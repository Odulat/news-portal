@extends('admin.index')

@section('form')
    <form action="{{ route('admin.category.create') }}" method="POST">
        @csrf
        <div class="flex flex-col -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                    Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" placeholder="Type name..." name="name">
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex flex-col -mx-3 mb-2">
            <div class="w-full px-3 mb-6 md:mb-0">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                    Create
                </button>
            </div>
        </div>
        @if (session('error'))
            <p class="text-red-500 text-xs italic">{{ session('error') }}</p>
        @endif
    </form>
@endsection