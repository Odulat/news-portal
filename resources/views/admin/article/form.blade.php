@extends('admin.index')

@section('form')
    @if(isset($article))
        <form action="{{ route('admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="flex flex-col -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                                Title
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('title') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" placeholder="Type title..." name="title" value="{{ old('title', $article->title ?? '') }}">
                            @error('title')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                                Text
                            </label>
                            <textarea class="appearance-none block w-full h-64 bg-gray-200 text-gray-700 border @error('text') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="text" placeholder="Type some text..." name="text">{{ old('text', $article->text ?? '') }}</textarea>
                            @error('text')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="image">
                                Image
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('image') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white mb-3 focus:border-gray-500" type="file" id="image" name="image">
                            @if(isset($article) && $article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-32 h-32 mt-2">
                            @endif
                            @error('image')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="category_id">
                                Category
                            </label>
                            <div class="relative mb-3">
                                @forelse($categories as $category)
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ $category->id }}" name="categories[]" @if(isset($article) && in_array($category->id, $article->categories->pluck('id')->toArray())) checked @endif>
                                            <span class="ml-2">{{ $category->name }}</span>
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-gray-700">Nothing to show</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col -mx-3 mb-2">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                @if(isset($article)) Update @else Create @endif
                            </button>
                        </div>
                    </div>
                    @if (session('error'))
                        <p class="text-red-500 text-xs italic">{{ session('error') }}</p>
                    @endif
                </form>
        @endsection
