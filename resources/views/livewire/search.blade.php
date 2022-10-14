<div>
    <form class="pb-6 grid">
        <input
            wire:model.debounce.500ms="query"
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
            placeholder="Искать"
        >
    </form>

    <div class="search__result divide-y divide-dashed">
        @foreach($products as $product)
            <div class="p-2">
                <a href="#" class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                    <h3>{{ $product->title }}</h3>
                </a>
            </div>
        @endforeach
        @if($products && $query)
            <p>Ничего не найдено</p>
        @endif
    </div>
</div>
