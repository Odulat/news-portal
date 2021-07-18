<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse($articles as $article)
                        <a href="{{ route('show', $article->id) }}">
                            <div class="p-5">
                                <div class="rounded overflow-hidden shadow-lg">
                                    <img class="w-full" src="{{ asset('storage/' . $article->image) }}" alt="Sunset in the mountains">
                                    <div class="px-6 py-4">
                                        <div class="font-bold text-xl mb-2">{{ $article->title }}</div>
                                        <p class="text-gray-700 text-base">
                                            {{ $article->text }}
                                        </p>
                                    </div>
                                    <div class="px-6 pt-4 pb-2">
                                        @foreach($article->categories as $category)
                                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-700">Nothing to show</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
