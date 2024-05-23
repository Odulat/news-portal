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
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-xl mb-2">{{ $article->title }}</div>
                            @if(Auth::id() === $article->user_id)
                                <div class="flex space-x-4">
                                    <a href="{{ route('admin.article.edit', $article->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 4.868l3.9 3.9-9.9 9.9H5.332v-3.9l9.9-9.9zM14.732 3.368a1 1 0 011.415 0l3.9 3.9a1 1 0 010 1.415l-1.823 1.823-5.315-5.315L14.732 3.368z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7h.01M4 7h16M10 11v6M14 11v6M4 7h16M7 7v12a2 2 0 002 2h6a2 2 0 002-2V7M7 7h10H7z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
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
