<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    @if($items->isNotEmpty())
    <div class="container px-3">
        <a href="{{ route('home') }}" wire:navigate class="text-sm text-blue-600">
            <i class="fa-solid fa-arrow-left-long mr-2"></i>
            Tiếp tục mua hàng
        </a>
    </div>
    <div class="pc container hidden lg:block">
        <div class="flex items-center h-12 px-3 border-b text-slate-800 font-semibold mt-4">
            <div class="w-5/12">Sản phẩm</div>
            <div class="w-2/12 text-center">Giá</div>
            <div class="w-3/12 text-center">Số lượng</div>
            <div class="w-2/12 text-center">Thành tiền</div>
            <div class="w-1/12 text-center">Thao tác</div>
        </div>
        <div class="my-4 text-base text-slate-800">
            @foreach ($items as $item)
            <div class="my-5">
                <div class="flex items-center">
                    <div class="w-5/12 flex">
                        <picture class="object-cover w-24 h-auto">
                            <source srcset="{{ $item->product?->getFirstMediaUrl('products', 'thumb') }}">
                            <img class="object-cover w-full" src="https://placehold.co/150x150">
                        </picture>
                        <div class="flex flex-col ml-8 overflow-hidden">
                            <p class="line-clamp-3 mr-3 mb-3 text-ellipsis">{{ $item->product?->name }}</p>
                            <p class="text-sm text-slate-500">Quy cách:&nbsp;{{ $item->unit?->name }}</p>
                        </div>
                    </div>
                    <div class="w-2/12 text-center text-gray-600 text-sm">
                        {{ money($item->amount) }}
                    </div>
                    <div class="w-3/12 text-center flex">
                        <div class="grid grid-cols-4 border w-4/5 mx-auto">
                            <button wire:click="updateItem({{ $item->sku }}, {{ $item->quantity - 1 }})" class="col-span-1 text-xs border-r"><i class="fa-solid fa-minus"></i></button>
                            <input value="{{ $item->quantity }}" type="number" name="quantity" id="quantity" max="99" min="1" readonly
                                class="border-none col-span-2 text-center text-xs out-of-range:bg-red-500">
                            <button wire:click="updateItem({{ $item->sku }}, {{ $item->quantity + 1 }})" class="col-span-1 text-xs border-l"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="w-2/12 text-center font-semibold text-sm">
                        {{ money($item->subtotal) }}
                    </div>
                    <div class="w-1/12 text-center">
                        <button wire:click="remove({{ $item->sku }})" class=" text-sm text-rose-600 mr-4">Xóa</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mb container my-4 block lg:hidden">
        @foreach ($items as $item)
        <div class="grid grid-cols-12 mb-3">
            <div class="col-span-3">
                <picture class="object-cover aspect-w-1 aspect-h-1">
                    <source srcset="{{ $item->product?->getFirstMediaUrl('products', 'thumb') }}">
                    <img class="h-auto aspect-w-1 aspect-h-1 object-cover" src="https://placehold.co/150x150">
                </picture>
            </div>
            <div class="col-span-9 ml-2 flex flex-col overflow-hidden">
                <h3 class="line-clamp-1 text-ellipsis font-semibold">{{ $item->product?->name }}</h3>
                <div class="text-xs text-gray-500">Quy cách:&nbsp;{{ $item->unit?->name }}</div>
                <div class="my-1 text-lime-700 text-sm font-bold">{{ money($item->amount) }}</div>
                <div class="flex items-end justify-between">
                    <div class="grid grid-cols-4 border">
                        <button wire:click="updateItem({{ $item->sku }}, {{ $item->quantity - 1 }})" class="col-span-1 text-xs border-r"><i class="fa-solid fa-minus"></i></button>
                        <input value="{{ $item->quantity }}" type="number" name="quantity" id="quantity" max="99" min="1" readonly
                            class="border-none col-span-2 text-center text-xs out-of-range:bg-red-500">
                        <button wire:click="updateItem({{ $item->sku }}, {{ $item->quantity + 1 }})" class="col-span-1 text-xs border-l"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <button wire:click="remove({{ $item->sku }})" class=" text-sm text-rose-600 mr-4">Xóa</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="container cart-empty flex flex-col items-center my-4">
        <p>Bạn chưa có sản phẩm nào!</p>
        <a href="{{ route('home') }}" wire:navigate class="underline text-blue-500 mt-4">Trở về Trang chủ</a>
    </div>
    @endif
    @if($items->isNotEmpty())
    <section class="bottom-0 sticky z-10 w-full bg-white items-center mt-3 border-t lg:container">
        <div class="flex items-center justify-between py-4 border-b border-dashed px-3">
            <p class="font-semibold">Phí ship</p>
            <p class="italic">*Hiển thị sau khi xác nhận đơn</p>
        </div>
        <div class="flex items-center justify-between pl-3">
            <div class="font-semibold">
                <span>Tổng tiền:</span>
                <span>{{ money($subtotal) }}</span>
            </div>
            <a href="{{ route('placed-order') }}" wire:navigate class=" bg-lime-600 text-white py-4 w-4/12 text-center">Đặt hàng</a>
        </div>
    </section>
    @endif
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
