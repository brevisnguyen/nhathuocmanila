<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container">
        <div class="md:grid md:grid-cols-2 gap-y-4 gap-x-8">
            <picture class="mx-auto mb-6 md:mb-0">
                <source srcset="{{ $product->getFirstMediaUrl('products', 'medium') }}" media="(max-width: 800px)">
                <source srcset="{{ $product->getFirstMediaUrl('products', 'large') }}" media="(min-width: 800px)">
                <img class="mb-6 md:mb-0" src="https://placehold.co/600x600">
            </picture>
            <div
                x-data="{
                    quantity: 1,
                    unitId: 1,
                    priceText: '',
                    setPrice(id, name, amount) {
                        this.priceText = amount + ' / ' + name;
                        this.unitId = id;
                    },
                    init() {
                        this.unitId = '{{ $product->units->firstWhere('pivot.default', 1)->id }}',
                        this.priceText = '{{ money($product->units->firstWhere('pivot.default', 1)->pivot->amount) . ' / ' . $product->units->firstWhere('pivot.default', 1)->name }}'
                    }
                }"
            >
                <div class="mb-4 md:mb-10">
                    <h1 class="text-2xl mb-3 md:mb-6 font-bold">{{ $product->name }}</h1>
                    <div class="flex items-center divide-x divide-gray-400 text-sm my-2">
                        <p class="pr-2">Đã bán:&nbsp;{{ $product->sold }}</p>
                        <p class="px-2">
                            <i class="fa-solid fa-star text-yellow-400 ml-1"></i>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        </p>
                    </div>
                </div>
                <div class="my-4 md:my-5">
                    <div class="text-2xl font-bold text-lime-600 mb-3 md:mb-5" x-text="priceText"></div>
                    <div class="flex flex-nowrap">
                    @foreach($product->units as $unit)
                        <div
                            class="px-4 py-2 rounded-md mr-4 cursor-pointer"
                            x-bind:class="unitId == '{{$unit->id}}' ? 'bg-lime-700 text-white' : 'bg-slate-200 text-gray-700'"
                            x-on:click="setPrice('{{ $unit->id }}', '{{ $unit->name }}', '{{ money($unit->pivot->amount) }}')"
                        >
                            {{ $unit->name }}
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="mb-3 md:mb-5 lg:mb-8 italic text-sm">
                    <p><span class="text-rose-500">*</span> Giá đã bao gồm Thuế.</p>
                    <p><span class="text-rose-500">*</span> Phí vận chuyển và các chi phí khác (nếu có) sẽ được thể hiện khi đặt hàng.</p>
                </div>
                <div class="mb-5">
                    <table class="w-full">
                        <tbody>
                            <tr class="flex flex-col md:flex-row mb-4">
                                <td class="w-32 text-left font-semibold flex-none">Danh mục</td>
                                <td>
                                    @foreach($product->categories as $category)
                                    <a class="underline text-slate-700 hover:text-lime-600 mr-2"
                                        href="{{ $category->url }}"
                                    >{{ $category->name }}</a>
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="flex">
                                <td class="w-32 text-left font-semibold flex-none">Xuất xứ</td>
                                <td class="">Việt Nam</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-4 md:mb-8 lg:mb-8 flex items-center">
                    <p class="w-32 text-left font-semibold flex-none">Số lượng</p>
                    <div class="grid grid-cols-4 gap-x-1 w-40 border">
                        <button x-on:click="quantity--" class="col-span-1 p-2 text-blue-500"><i class="fa-solid fa-minus"></i></button>
                        <input
                            x-model="quantity"
                            type="number" name="quantity" id="quantity" max="99" min="1" readonly
                            class="outline-none border-none col-span-2 text-center out-of-range:bg-red-500">
                        <button x-on:click="quantity++" class="col-span-1 p-2 text-blue-500"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                @if ($product->status == App\Enums\Status::SOLD_OUT)
                    <div class="mb-3 md:mb-5 lg:mb-8">
                        <p class="text-rose-600 font-semibold text-sm md:text-base">Sản phẩm tạm hết hàng!</p>
                    </div>
                @endif
                <div class="action-button mb-3 md:mb-5 lg:mb-8 grid grid-cols-12">
                    <a
                        href="{{ 'https://t.me/' . app(\App\Settings\WebSettings::class)->telegram }}"
                        target="_blank"
                        class="flex items-center justify-center text-blue-500 col-span-3 rounded-xl border border-blue-500"
                    >
                        <i class="fa-brands fa-telegram mr-1"></i>
                        Liên hệ
                    </a>
                    <button
                        @disabled($product->status == App\Enums\Status::SOLD_OUT)
                        class="px-4 py-2 flex items-center justify-center col-span-8 md:col-span-6 col-start-5 md:col-start-6 rounded-xl bg-blue-500 text-white disabled:opacity-70"
                        wire:click="addToCart(unitId, quantity),Toaster.success('Thêm vào giỏ hàng thành công!')"
                    >
                        <i class="fa-solid fa-cart-plus mr-1 md:mr-2"></i>
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>

    <div
        class="container mb-10"
        x-data="{ expanded: false }"
    >
        <h3 class="font-bold text-lg mb-2">Thông tin {{ $product->name }}</h3>

        <div x-show="expanded" x-collapse.duration.1000ms.min.50px>
            {!! $product->description !!}
        </div>

        <div class="py-1 flex justify-center">
            <button
                x-on:click="expanded = ! expanded"
                class="text-sm text-sky-500 hover:text-sky-600"
            >
                <span x-show="!expanded">Xem thêm <i class="fa-solid fa-chevron-down"></i></span>
                <span x-show="expanded">Thu gọn <i class="fa-solid fa-chevron-up"></i></span>
            </button>
        </div>
    </div>

    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>

    <div class="container">
        <h3 class="font-bold text-lg mb-2">Sản phẩm liên quan</h3>
        @if($relatedProducts->isNotEmpty())
        <section id="relate-items" class="splide mb-4 relative" aria-label="Relate products">
            <div class="splide__track">
                <ul class="splide__list">
                @foreach($relatedProducts as $product)
                    <li class="splide__slide"><livewire:product-card :product="$product" :id="$product->id" /></li>
                @endforeach
                </ul>
            </div>
        </section>
        @else
        <div class="flex items-center justify-between">
            <p class="text-slate-600 m-auto">Dữ liệu đang được cập nhật...</p>
        </div>
        @endif
    </div>
</div>
