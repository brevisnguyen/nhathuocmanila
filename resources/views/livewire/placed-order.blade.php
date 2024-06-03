<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container block lg:grid lg:grid-cols-2 lg:gap-x-10">
        <div class="my-4">
            <h4 class="text-lg font-semibold mb-2">Thông tin người nhận</h4>
            <form wire:submit="placedOrder">
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Họ và Tên<span class="text-rose-500">*</span></label>
                    <input wire:model="name" placeholder="Tên người nhận hàng" type="text" id="name" required autocomplete="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @error('name') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label for="phone" class="block font-medium text-sm text-gray-700">Số điện thoại<span class="text-rose-500">*</span></label>
                    <input wire:model="phone" x-mask="9999 999 9999" placeholder="0123 456 7890" type="tel" id="phone" required autofocus autocomplete="tel" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @error('phone') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label for="address" class="block font-medium text-sm text-gray-700">Địa chỉ nhận hàng<span class="text-rose-500">*</span></label>
                    <input wire:model="address" placeholder="Tên tòa nhà, building, tower..." type="text" id="address" required autocomplete="street-address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @error('address') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4" x-data="{ payment: '{{ $payment }}' }">
                    <label for="payment" class="block font-medium text-sm text-gray-700">Phương thức thanh toán<span class="text-rose-500">*</span></label>
                    <div class="flex gap-x-3 md:gap-x-8 mt-1">
                        <label
                            class="flex px-4 py-2 border rounded shadow-md cursor-pointer"
                            x-bind:class="{ 'bg-lime-700 text-white': payment == '{{ \App\Enums\Payment::SHIP_COD->value }}' }"
                        >
                            <input type="radio" wire:model="payment" x-model="payment" value="{{ \App\Enums\Payment::SHIP_COD->value }}" class="sr-only opacity-0" />
                            <span class="relative flex flex-col">
                                <span class="font-semibold">{{ \App\Enums\Payment::SHIP_COD->getLabel() }}</span>
                                <span class="text-sm opacity-50">Thanh toán khi nhận hàng</span>
                            </span>
                        </label>
                        <label
                            class="flex px-4 py-2 border rounded shadow-md cursor-pointer"
                            x-bind:class="{ 'bg-lime-700 text-white': payment == '{{ \App\Enums\Payment::BANKING->value }}' }"
                        >
                            <input type="radio" wire:model="payment" x-model="payment" value="{{ \App\Enums\Payment::BANKING->value }}" class="sr-only opacity-0" />
                            <span class="relative flex flex-col">
                                <span class="font-semibold">{{ \App\Enums\Payment::BANKING->getLabel() }}</span>
                                <span class="text-sm opacity-50">Phí ship rẻ, ưu tiên</span>
                            </span>
                        </label>
                    </div>
                    @error('payment') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label for="note" class="block font-medium text-sm text-gray-700">Ghi chú</label>
                    <input wire:model="note" placeholder="Bạn cần lưu ý gì cho đơn hàng này không?" type="text" id="note" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @error('note') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
                </div>
            </form>
        </div>
        <div class="my-4">
            <h4 class="text-lg font-semibold mb-2">Thông tin đơn hàng</h4>
            <div class="text-sm divide-y divide-dashed">
                @foreach ($items as $item)
                <div class="grid grid-cols-12 py-2">
                    <div class="col-span-3">
                        <picture class="object-cover aspect-w-1 aspect-h-1 h-auto w-24 md:w-28">
                            <source srcset="{{ $item->product?->getFirstMediaUrl('products', 'thumb') }}">
                            <img class="h-auto w-24 md:w-28 aspect-w-1 aspect-h-1 object-cover" src="https://placehold.co/150x150">
                        </picture>
                    </div>
                    <div class="col-span-9 ml-2 flex flex-col overflow-hidden text-sm md:text-base">
                        <h3 class="line-clamp-1 md:line-clamp-none text-ellipsis font-semibold">{{ $item->product?->name }}</h3>
                        <div class="text-xs md:text-sm text-gray-500">Quy cách:&nbsp;{{ $item->unit?->name }}</div>
                        <div class="my-1 text-lime-700 text-sm font-bold">{{ money($item->amount) }}</div>
                        <div class="flex items-center justify-between">
                            <p>Số lượng: {{ $item->quantity }}</p>
                            <p>Thành tiên: <span class="text-lime-700 text-sm font-bold">{{ money($item->subtotal) }}</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <section class="bottom-0 sticky z-10 w-full bg-white items-center mt-3 border-t lg:container">
        <div class="flex items-center justify-between py-4 border-b border-dashed px-3">
            <p class="font-semibold">Phí ship</p>
            <p class="italic">*Hiển thị sau khi xác nhận đơn</p>
        </div>
        <div class="flex items-center justify-between pl-3">
            <div class="font-semibold">
                <span>Tổng tiền:</span>
                <span class="text-lime-700">{{ money($subtotal) }}</span>
            </div>
            <button wire:click="placedOrder" type="submit" class=" bg-lime-600 text-white py-4 w-4/12 text-center">Xác nhận</button>
        </div>
    </section>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
