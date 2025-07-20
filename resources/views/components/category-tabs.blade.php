<ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 justify-center">
    <li class="me-2">
        <a href="/" class="{{
    request('category')
    ? 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-800 dark:hover:text-white'
    : 'inline-block px-4 py-2 text-white bg-gray-900 rounded-lg active' }}">
            All
        </a>
    </li>
    @forelse ($categories as $category)
        <li class="me-2 border border-gray-200 rounded-lg">
            <a href="" class="{{
            Route::currentRouteNamed('post.byCategory') && request('category')->id == $category->id
            ? 'inline-block px-4 py-2 text-white bg-gray-600 rounded-lg active'
            : 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-800 dark:hover:text-white'
                    }}">
                {{ $category->name }}
            </a>
        </li>
    @empty
        {{ $slot }}
    @endforelse

</ul>
