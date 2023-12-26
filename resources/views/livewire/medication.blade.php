<div class="bg-slate-200 py-4">
    <div class="container bg-white rounded-xl p-2 md:p-4 shadow-md">
        <div class="flex flex-col md:flex-row gap-y-3 gap-x-5">
            <div class="">
                <img class="w-full rounded-xl" src="{{ $medicine->getImage() }}" alt="Hình ảnh {{ $medicine->name }}">
            </div>
            <div class="">
                <div class="medicine-name">
                    <h3 class="text-lg md:text-2xl md:mb-4 font-bold">{{ $medicine->name }}</h3>
                    <div class="flex items-center divide-x divide-gray-400 text-sm my-2">
                        <p class="pr-2">Đã bán:&nbsp;{{ $medicine->sold_count }}</p>
                        <p class="px-2">{{ rand(3, 5) }}<i class="fa-solid fa-star text-yellow-400 ml-1"></i></p>
                    </div>
                </div>
                <div class="my-3 md:my-6 font-bold text-2xl text-lime-600">{{ my_money($medicine->price) }}&nbsp;/&nbsp;<span class="!text-sm">{{ $medicine->unit->name }}</span></div>
                <div class="base-info">
                    <table class="w-full">
                        <tbody>
                            <tr class="block md:flex md:mb-3">
                                <td class="w-[155px] flex text-left">Danh mục</td>
                                <td class="mt-1 md:mt-0 flex text-left">
                                    <div class="flex">
                                        @foreach($medicine->categories as $cat)
                                        <span>{{ $cat->name }},&nbsp;</span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr class="block md:flex md:mb-3">
                                <td class="w-[155px] flex text-left">Thành phần chính</td>
                                <td class="mt-1 md:mt-0 flex text-left">
                                    <div class="flex">
                                        @foreach($medicine->components as $comp)
                                        <span>{{$comp}},&nbsp;</span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr class="block md:flex md:mb-3">
                                <td class="w-[155px] flex text-left">Đơn vị tính</td>
                                <td class="mt-1 md:mt-0 flex text-left">
                                    <p class="text-sm font-semibold bg-lime-100 text-lime-700 px-2 py-1 rounded-lg">{{ $medicine->unit->name }}</p>
                                </td>
                            </tr>
                            <tr class="block md:flex md:mb-3">
                                <td class="w-[155px] flex text-left">Xuất sứ</td>
                                <td class="mt-1 md:mt-0 flex text-left">Việt Nam</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="act-button flex items-center justify-center my-3 md:my-5">
                    <a href="#" class="px-3 py-1.5 mx-4 rounded-xl bg-white text-blue-600 border border-blue-500 flex"><i class="fa-solid fa-paper-plane m-auto"></i>&nbsp;Liên hệ</a>
                    <button class="px-4 py-2 mx-4 flex items-center gap-x-2 rounded-xl bg-blue-500 text-white">
                        <i class="fa-solid fa-plus"></i>
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white rounded-xl p-2 md:p-4 shadow-md mt-4 md:mt-6">
        <h3 class="font-bold text-lg mb-2">Giới thiệu {{ $medicine->name }}</h3>
        <p>{{ $medicine->description }}</p>
    </div>
    <div class="container bg-white rounded-xl p-2 md:p-4 shadow-md mt-4 md:mt-6">
        <h3 class="font-bold text-lg mb-2">Sản phẩm liên quan</h3>
        @if($relates->isNotEmpty())
        <section id="relate-items" class="splide mb-4 relative" aria-label="Relate products">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($relates as $product)
                    <li class="splide__slide"><livewire:product-card :product="$product" /></li>
                    <li class="splide__slide"><livewire:product-card :product="$product" /></li>
                    <li class="splide__slide"><livewire:product-card :product="$product" /></li>
                    <li class="splide__slide"><livewire:product-card :product="$product" /></li>
                    <li class="splide__slide"><livewire:product-card :product="$product" /></li>
                    <li class="splide__slide"><livewire:product-card :product="$product" /></li>
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
