<div class="group relative">
    <div class="group relative">
        <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img
                src="{{ $viewImage }}" alt="Front of men's Basic Tee in black."
                class="h-full w-full object-cover object-center lg:h-full lg:w-full"
            >
        </div>
        <div class="mt-4 flex justify-between">
            <div>
                <h3 class="text-sm text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        {{ $product->title }}
                    </a>
                </h3>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $product->price }} Р</p>
            </div>
        </div>
    </div>
    <div class="flex justify-center space-x-2 pt-3 items-center">
        @if($product->colors->count() > 1)
            @foreach($product->colors as $key => $color)
                <div
                    wire:click="chooseColor({{ $color->id }})"
                    class="w-4 h-4 border rounded-full cursor-pointer {{ $color->class }}"
                ></div>
            @endforeach
        @endif

        <div class="w-8 h-8 border rounded-full cursor-pointer bg-sky-300 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </div>
    </div>
</div>
