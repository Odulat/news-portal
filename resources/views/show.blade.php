<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="px-5 py-4">
                        <a href="{{ route('index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            back
                        </a>
                    </div>
                    <div class="px-5 py-4">
                        <img class="w-full" src="{{ asset('storage/' . $article->image) }}" alt="Sunset in the mountains">
                    </div>
                    <div class="px-5 py-4">
                        <div class="font-bold text-xl mb-2">{{ $article->title }}</div>
                        <p class="text-gray-700 text-base">
                            {{ $article->text }}
                        </p>
                    </div>
                    <div class="px-5 pt-4 pb-2">
                        @foreach($article->categories as $category)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
