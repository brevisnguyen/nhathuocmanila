<div>
    <div class="container relative mb-4 flex flex-col gap-y-7 md:grid md:grid-cols-12">
        <div class="md:col-start-4 md:col-span-9 md:px-3">
            <section id="hero-banner" class="splide max-h-96" aria-label="Banner">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($banners as $banner)
                        <li class="splide__slide">
                            <img class="w-full object-cover max-h-96" src="{{ $banner }}" alt="{{ config('app.name') }}">
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <section class="container my-4 md:my-8 xl:my-10">
        <div class="flex flex-col bg-gradient-to-b from-pink-100 to-pink-50 rounded-lg p-3">
            <div class="mb-4 md:mb-10 flex justify-between">
                <h2 class="font-bold text-xl md:text-4xl text-rose-600 capitalize">Flash sale</h2>
                <div class="flex font-extrabold text-base md:text-2xl text-slate-700">
                    <span class="mr-2">Kết thúc trong</span>
                    <span id="flash-sale-countdown"></span>
                </div>
            </div>
            <section id="flash-sale" class="splide md:mb-4" aria-label="Flash sale today">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($flash_sale as $product)
                        <li class="splide__slide"><livewire:product-card :product="$product" :id="$product->id" /></li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </section>
    <section class="my-4 md:my-8 xl:my-10 bg-neutral-100">
        <div class="container px-0 py-4">
            <img class="w-full object-cover max-h-24 md:max-h-48" src="{{ asset('storage/banner-unsplash.jpg') }}" alt="">
        </div>
    </section>
    <section class="container">
        <div class="mb-8 md:mb-12 xl:mb-14 flex flex-col">
            <div class="mb-4 md:mb-10 flex justify-between">
                <div class="w-fit">
                    <h2 class="font-bold text-xl md:text-2xl text-slate-800 capitalize">sản phẩm mới</h2>
                    <div class="text-center border-2 border-lime-400 w-1/2"></div>
                </div>
                <a
                    class="flex items-center gap-x-1 text-sky-500"
                    href="{{ route('all-products') }}"
                    wire:navigate
                >
                    <span>Xem thêm</span>
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-5 lg:gap-6">
                @foreach($products as $product)
                <livewire:product-card :product="$product" :id="$product->id" />
                @endforeach
            </div>
        </div>
    </section>
    @if($posts)
    <section class="container my-6 md:my-8">
        <div class="mb-4 md:mb-10 flex justify-between">
            <div class="w-fit">
                <h2 class="font-bold text-xl md:text-2xl text-slate-800 capitalize">tin tức mới nhất</h2>
                <div class="text-center border-2 border-lime-400 w-1/2"></div>
            </div>
            <a
                class="flex items-center gap-x-1 text-sky-500"
                href="{{ route('post-card') }}"
                wire:navigate
            >
                <span>Xem thêm</span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
        <div class="flex flex-wrap flex-col md:flex-row">
            @foreach($posts as $post)
                @if($loop->first)
                    <div class="basis-full md:basis-7/12 mb-4 md:mb-0 md:mr-5">
                        <a
                            class="overflow-hidden group"
                            href="{{ $post->url }}"
                            wire:navigate
                        >
                            <picture class="aspect-w-16 aspect-h-9 object-cover rounded">
                                <source srcset="{{ $post->getFirstMediaUrl('posts', 'medium') }}" media="(max-width: 800px)">
                                <source srcset="{{ $post->getFirstMediaUrl('posts', 'large') }}" media="(min-width: 800px)">
                                <img class="aspect-w-16 aspect-h-9 object-cover rounded" src="https://placehold.co/1280x720">
                            </picture>
                            <div class="mt-2">
                                <h3 class="text-lg md:text-2xl font-bold line-clamp-1 text-ellipsis mb-1 group-hover:text-lime-600">{{ $post->title }}</h3>
                                <p class="text-sm md:text-base line-clamp-2 text-ellipsis">{{ $post->content }}</p>
                            </div>
                        </a>
                    </div>
                @break
                @endif
            @endforeach
            <div class="flex-1 flex-col">
                @foreach($posts as $post)
                    @continue($loop->first)
                    <div class="overflow-hidden mb-4">
                        <a
                            class="grid grid-cols-12 text-sm md:text-base overflow-hidden group"
                            href="{{ $post->url }}"
                            wire:navigate
                        >
                            <picture class="col-span-4 object-cover aspect-w-16 aspect-h-9 rounded">
                                <source srcset="{{ $post->getFirstMediaUrl('posts', 'thumb') }}" media="(max-width: 800px)">
                                <source srcset="{{ $post->getFirstMediaUrl('posts', 'medium') }}" media="(min-width: 800px)">
                                <img class="object-cover aspect-w-16 aspect-h-9 rounded" src="https://placehold.co/320x180">
                            </picture>
                            <div class="ml-2 flex-1 col-span-8">
                                <h3 class="font-semibold line-clamp-1 text-ellipsis mb-1 group-hover:text-lime-600">{{ $post->title }}</h3>
                                <p class="line-clamp-2 text-ellipsis text-xs md:text-sm">{{ $post->content }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
