<a
    href="{{ route($route) }}"
    class="@if(Route::is($route)) text-gray-800 hover:text-gray-800 @else text-gray-300 hover:text-gray-500 @endif px-3 py-2 font-medium hover:no-underline"
    aria-current="page"
>
    {{ $title }}
</a>
