<div class="w-full md:w-3/4 relative">
    <form action="search">
        <div class="flex items-center relative h-12 border border-solid border-gray-300">
            <div class="font-bold mx-5 hidden md:block">Tất cả danh mục</div>
            <input
                wire:model.live="query"
                wire:keydown.escape="reset"
                wire:keydown.tab="reset"
                type="text"
                placeholder="Bạn muốn tìm thuốc nào?"
                class="border-none placeholder:text-gray-400 outline-none ring-0 grow px-4"
            >
            <button type="submit" class="bg-lime-700 text-white px-3 md:px-6 h-full items-end">Tìm kiếm</button>
        </div>
    </form>
    <div class="absolute z-10 w-full bg-white shadow-md">
        @if($products->isNotEmpty())
        <ul class="p-2 border border-t-0 border-gray-300 grid grid-cols-1 md:grid-cols-2">
        @foreach($products as $product)
            <li class="flex flex-wrap gap-4">
                <img class="w-10 md:w-16 lg:w-24 h-full" src="{{ $product->getImage() }}" alt="">
                <div class="flex flex-col">
                    <h4 class="font-semibold text-wrap">{{ $product->name }}</h4>
                    <div class="flex gap-1">
                        @foreach($product->categories as $category)
                        <p class="px-2.5 py-0.5 text-xs font-medium rounded bg-green-100 text-green-800">{{ $category->name }}</p>
                        <p class="px-2.5 py-0.5 text-xs font-medium rounded bg-green-100 text-green-800">{{ $category->name }}</p>
                        <p class="px-2.5 py-0.5 text-xs font-medium rounded bg-green-100 text-green-800">{{ $category->name }}</p>
                        @endforeach
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
        @elseif($products->isEmpty() && strlen($query) >= 2)
        <div class="p-2 border border-t-0 border-gray-300 text-center">
            <p class="">Bạn đã nhập chính xác chưa? Bên mình không có loại đó ạ!</p>
        </div>
        @endif
    </div>
</div>
