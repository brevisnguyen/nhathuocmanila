<div class="relative overflow-hidden group shadow-md rounded-md">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 hidden group-hover:md:block z-10">
        <div class="mx-auto bg-white/80 hover:bg-white p-2">
            <a
                wire:navigate
                href="{{ $product->url }}"
                class="flex items-center justify-center gap-x-2 hover:text-lime-500"
            >
                <i class="fa-solid fa-eye"></i>
                Chi tiết
            </a>
        </div>
    </div>
    <div class="flex flex-col bg-slate-50 rounded-md group-hover:md:border-2 group-hover:md:border-lime-600">
        <picture class="object-cover rounded-t-md">
            <source srcset="{{ $product->getFirstMediaUrl('products', 'medium') }}">
            <img class="object-cover rounded-t-md" src="https://placehold.co/350x350">
        </picture>
        <div class="my-2 px-2">
            <a
                href="{{ $product->url }}" wire:navigate
                class="h-12 md:h-14 mb-2 font-semibold hover:text-lime-600 line-clamp-2 text-ellipsis"
            >
                {{ $product->name }}
            </a>
            <p class="text-xs md:text-sm line-clamp-1 text-ellipsis font-semibold text-blue-500">
                {{ money($sku?->amount ?? 999) .' / '. $sku?->unit?->name }}
            </p>
        </div>
        <button
            wire:click="addToCart, Toaster.success('Thêm vào giỏ hàng thành công!')"
            @disabled($product->status == App\Enums\Status::SOLD_OUT)
            class="m-auto px-5 py-2 mb-2 flex items-center justify-center bg-lime-600 text-white rounded-lg disabled:opacity-70"
        >
            <i class="fa-solid fa-cart-plus mr-1.5"></i>
            <span class="block md:hidden">Bỏ túi</span>
            <span class="hidden md:block">Thêm vào giỏ</span>
        </button>
    </div>
</div>
