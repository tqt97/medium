<ul
    class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
    <li class="me-2">
        <a href="/" class="{{
    request('category')
    ? 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white'
    : 'inline-block px-4 py-2 text-white bg-blue-600 rounded-lg active' }}">
            All
        </a>
    </li>
    @forelse ($categories as $category)
        {{-- <li class="me-2">
            <a href="{{ route('categories.show', $category->id) }}"
                class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300 {{ request()->routeIs('categories.show', $category->id) ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : '' }}">
                {{ $category->name }}
            </a>
        </li> --}}
        {{-- <li class="me-2">
            <span class="inline-block p-4 text-gray-500 rounded-t-lg"> {{ $category->name }}</span>
        </li> --}}
        <li class="me-2">
            <a href="" class="{{
            Route::currentRouteNamed('post.byCategory') && request('category')->id == $category->id
            ? 'inline-block px-4 py-2 text-white bg-blue-600 rounded-lg active'
            : 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white'
                    }}">
                {{ $category->name }}
            </a>
        </li>
    @empty
        {{ $slot }}
    @endforelse
    {{-- <li>
        <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
    </li> --}}
</ul>
