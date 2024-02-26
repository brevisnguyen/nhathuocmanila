<div>
    <div
        x-data="{ expanded: false }"
        class="mb-3 lg:mb-5 border px-2 py-3 lg:p-4 rounded shadow"
    >
        <div class="flex items-center justify-between text-sm lg:text-base mb-2.5 lg:mb-4 pb-1 lg:pb-2 border-b">
            <div class="text-amber-500">Mã ĐH: {{ $order->id }}</div>
            <div class="flex items-center gap-x-2">
                <span>{!! $order->status->icon() !!}</span>
                <span class="capitalize">{{ $order->status->getLabel() }}</span>
            </div>
        </div>
        <div
            x-show="!expanded"
            class=""
        >
            <div class="grid grid-cols-12 gap-x-3">
                <picture class="col-span-3 md:col-span-2 lg:w-28 h-auto">
                    <source srcset="{{ $order->items->first()->product->getFirstMediaUrl('products', 'thumb') }}">
                    <img class="rounded-md" src="{{ asset('storage/dummy_600x600.png') }}">
                </picture>
                <div class="col-span-9 md:col-span-10 flex flex-col gap-y-2 overflow-hidden text-xs lg:text-sm">
                    <h3 class="text-sm lg:text-base text-ellipsis font-semibold">{{ $order->items->first()->product->name }}</h3>
                    <div class="flex items-center justify-between">
                        <span>Quy cách: {{ $order->items->first()->unit->name }}</span>
                        <span class="font-semibold">x{{ $order->items->first()->quantity }}</span>
                    </div>
                    <div class="text-right text-rose-500">{{ money($order->items->first()->subtotal) }}</div>
                </div>
            </div>
        </div>
        <div
            x-show="expanded" x-collapse.duration.1000ms
            class="mb-2.5 lg:mb-4"
        >
            <div class="block lg:grid lg:grid-cols-12 lg:gap-x-3">
                <div class="mb-2.5 lg:mb-4 lg:col-span-4">
                    <h3 class="font-bold text-base">
                        <i class="fa-solid fa-location-dot text-gray-500"></i>
                        <span class="ml-1.5">Thông tin nhận hàng</span>
                    </h3>
                    <p class="ml-6 text-sm lg:text-base text-gray-600">{{ $user->name }}</p>
                    <p class="ml-6 text-sm lg:text-base text-gray-600">{{ $order->phone }}</p>
                    <p class="ml-6 text-sm lg:text-base text-gray-600">{{ $order->address }}</p>
                </div>
                <div class="mb-2.5 lg:mb-4 lg:col-span-8">
                    <h3 class="font-bold text-base">
                        <i class="fa-regular fa-pen-to-square text-amber-500"></i>
                        <span class="ml-1">Ghi chú</span>
                    </h3>
                    <div class="ml-6 text-sm lg:text-base text-gray-600">{!! $order->description !!}</div>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-base mb-2">
                    <i class="fa-solid fa-capsules text-green-500"></i>
                    <span class="ml-1.5">Sản phẩm</span>
                </h3>
                @foreach($order->items as $item)
                <div class="grid grid-cols-12 gap-x-3 py-2 border-b">
                    <picture class="col-span-3 md:col-span-2 lg:w-28 h-auto">
                        <source srcset="{{ $order->items->first()->product->getFirstMediaUrl('products', 'thumb') }}">
                        <img class="rounded-md" src="{{ asset('storage/dummy_600x600.png') }}">
                    </picture>
                    <div class="col-span-9 md:col-span-10 flex flex-col gap-y-2 overflow-hidden text-xs lg:text-sm">
                        <h3 class="text-sm lg:text-base text-ellipsis font-semibold">{{ $order->items->first()->product->name }}</h3>
                        <div class="flex items-center justify-between">
                            <span>Quy cách: {{ $order->items->first()->unit->name }}</span>
                            <span class="font-semibold">x{{ $order->items->first()->quantity }}</span>
                        </div>
                        <div class="text-right text-rose-500">{{ money($order->items->first()->subtotal) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div
            class="py-1 lg:py-2 my-2 lg:my-3 border rounded-md flex items-center justify-center text-xs lg:text-sm text-sky-500 hover:text-sky-700 cursor-pointer"
            x-on:click="expanded = ! expanded"
        >
            <span x-show="!expanded">Xem thêm <i class="fa-solid fa-chevron-down"></i></span>
            <span x-show="expanded">Thu gọn <i class="fa-solid fa-chevron-up"></i></span>
        </div>
        <div class="flex items-center justify-between lg:justify-end">
            <div class="text-xs lg:text-sm text-gray-600">Phí ship: {{ money($order->shipping) }}</div>
            <div class="text-sm lg:text-base lg:w-4/12 text-right">Tiền thuốc: <span class="text-red-500">{{ money($order->subtotal) }}</span></div>
        </div>
    </div>
</div>
