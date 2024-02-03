<div class="relative overflow-hidden group p-1">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 hidden group-hover:md:block z-10">
        <div class="mx-auto bg-white/80 hover:bg-white p-2">
            <a href="{{ $product->url }}" class="flex items-center justify-center gap-x-2 hover:text-lime-500"><i class="fa-solid fa-eye"></i>Chi tiết</a>
        </div>
    </div>
    <div class="flex flex-col !h-full text-left bg-slate-50 drop-shadow rounded-xl shadow-lg md:hover:border-2 md:hover:border-lime-600">
        <a href="{{ $product->url }}">
            <picture class="object-cover !rounded-t-xl">
                <source srcset="{{ $product->getFirstMediaUrl('products', 'medium') }}">
                <img class="rounded-t-xl" src="{{ asset('storage/dummy_600x600.png') }}">
            </picture>
        </a>
        <div class="product-info my-1 md:my-2 px-2">
            <a href="{{ $product->url }}" class="product-name text-base md:text-lg font-semibold text-slate-800 hover:text-lime-600">{{ $product->name }}</a>
            <p class="text-sm font-semibold text-blue-500 mt-1 md:mt-2">{{ my_money(200).' / '.$product->units[0]->name }}</p>
        </div>
        <div class="add-cart-button mx-auto">
            <button class="px-6 md:px-4 py-2 my-2 flex gap-x-2 items-center justify-center mx-auto bg-lime-600 text-white w-full rounded-xl">
                <i class="fa-solid fa-cart-plus"></i>
                <p><span class="block md:hidden">Bỏ túi</span><span class="hidden md:block">Thêm vào giỏ</span></p>
            </button>
        </div>
    </div>
</div>
