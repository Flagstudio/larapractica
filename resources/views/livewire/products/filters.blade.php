@section('page_title', 'Товары')

<div class="grid gap-x-8 gap-y-10 lg:grid-cols-4">
    <form class="">
        <div class="pb-6 border-b border-gray-200">
            <span>Категория: </span>
            <select wire:model="category">
                <option value="0">Все</option>
                @foreach($categoriesList as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="pb-4 pt-4 border-b border-gray-200">
            <span>Цена: </span>
            <input
                wire:model.debounce.500ms="priceMin"
                type="text"
                class="mt-1 w-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
            >
            -
            <input
                wire:model.debounce.500ms="priceMax"
                type="text"
                class="mt-1 w-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
            >
        </div>
        <div class="pb-4 pt-4">
            <span>Цвет: </span>
            @foreach($colorsList as $color)
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                        <input
                            wire:model.debounce.500ms="colors"
                            value="{{ $color->id }}"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="comments" class="font-medium text-gray-700">
                            {{ $color->title }}
                            <span>
                                ({{ $color->facet }})
                            </span>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    <div class="lg:col-span-3">
        <div class="flex justify-end">
            <span>Сортировка: </span>
            <select class="">
                <option value="null">По популярности</option>
                <option value="price">По возрастанию цены</option>
                <option value="">По убыванию цены</option>
            </select>
        </div>

        <div class="grid gap-x-8 gap-y-10 lg:grid-cols-3 mt-4">
            @foreach($products as $product)
                @livewire('products.card', ['product' => $product], key($product->id))
            @endforeach
        </div>
    </div>
</div>
