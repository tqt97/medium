@php
    $isEdit = $post?->id ?? false;
    $title = $isEdit ? 'Update Post' : 'Create a new post';
    $action = $isEdit ? route('admin.posts.update', $post) : route('admin.posts.store');
    $button = $isEdit ? 'Update' : 'Create';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($title) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ $action }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="flex gap-6">
                            <div class="w-2/3">
                                <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                        :value="old('title', $post->title ?? '')" autofocus />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <!-- Content -->
                                <div class="mt-6">
                                    <x-input-label for="content" :value="__('Content')" />
                                    <x-input-textarea id="content" class="block mt-1 w-full" rows="10"
                                        name="content">{{ old('content', $post->content ?? '') }}</x-input-textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                            </div>
                            <div class="w-1/3">
                                <!-- Category -->
                                <div>
                                    <x-input-label for="category_id" :value="__('Category')" />
                                    <select id="category_id" name="category_id"
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>
                                <!-- Published At -->
                                <div class="mt-6">
                                    <x-input-label for="published_at" :value="__('Published At')" />
                                    <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local"
                                        name="published_at" :value="old('published_at', isset($post->published_at) ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : '')"
                                        autofocus />
                                    <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                                </div>
                                <!-- Image -->
                                <div class="mt-6">
                                    <x-input-label for="image" :value="__('Image')" />
                                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                                        autofocus />
                                    @if($isEdit && $post->imageUrl())
                                        <img src="{{  $post->imageUrl() }}" class="mt-2 h-32" />
                                    @endif
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <x-primary-button class="mt-6">
                            {{ $button }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
