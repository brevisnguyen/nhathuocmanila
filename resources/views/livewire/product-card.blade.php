<div class="relative overflow-hidden group">
    <div class="product-detail absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 hidden group-hover:md:block">
        <div class="mx-auto bg-white/80 hover:bg-white p-2">
            <a href="#" class="flex items-center justify-center gap-x-2 hover:text-lime-500"><i class="fa-solid fa-eye"></i>Chi tiết</a>
        </div>
    </div>
    <div class="flex flex-col text-left border border-solid border-gray-300 px-1 pt-1 pb-11">
        <img class="aspect-square " src="{{ asset('storage/Tobradex.png') }}" alt="Hình ảnh thuốc Tobradex - {{ config('aap.name') }}">
        <div class="product-info my-1 md:my-2">
            <a href="#" class="product-name text-sm md:text-base text-slate-800 hover:text-lime-500">
                Thuốc nhỏ mắt TobraDex
            </a>
            <p class="text-base font-medium text-slate-900 mt-1 md:mt-2">{{ my_money(266) }}</p>
        </div>
        <div class="add-cart-button mx-auto md:scale-y-0 md:group-hover:scale-y-100 transition-transform ease-out duration-400 absolute inset-x-0 bottom-0">
            <button class="px-4 py-2 md:py-3 flex gap-x-2 items-center justify-center mx-auto bg-lime-600 text-white w-full">
                <i class="fa-solid fa-cart-plus"></i>
                <p><span class="block md:hidden">Bỏ túi</span><span class="hidden md:block">Thêm vào giỏ</span></p>
            </button>
        </div>
    </div>
</div>
