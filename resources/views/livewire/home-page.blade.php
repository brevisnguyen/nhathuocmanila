<div class="text-slate-900">
    <div class="container relative mb-4 flex flex-col gap-y-7 md:grid md:grid-cols-12">
        <div class="md:col-start-4 md:col-span-9 md:px-3">
            <section id="hero-banner" class="splide max-h-96" aria-label="Banner">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide"><img class="w-full object-cover max-h-96" src="{{ asset('storage/banner-unsplash.jpg') }}" alt=""></li>
                        <li class="splide__slide"><img class="w-full object-cover max-h-96" src="{{ asset('storage/banner-unsplash.jpg') }}" alt=""></li>
                        <li class="splide__slide"><img class="w-full object-cover max-h-96" src="{{ asset('storage/banner-unsplash.jpg') }}" alt=""></li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <section class="container">
        <div class="mb-8 md:mb-12 xl:mb-14 flex flex-col">
            <div class="mb-4 md:mb-10 w-fit">
                <h2 class="font-bold text-xl md:text-2xl text-slate-800 capitalize">sản phẩm nổi bật</h2>
                <div class="text-center border-2 border-lime-400 w-1/2"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 lg:gap-8">
                @foreach($hot_products as $product)
                <livewire:product-card :product="$product" :key="$product->id" />
                @endforeach
            </div>
        </div>
    </section>
    <section class="my-6 md:my-8 bg-neutral-100">
        <div class="container px-0 py-6">
            <div class="grid grid-rows-2 md:grid-rows-none md:grid-cols-2 md:gap-x-8">
                <img class="w-full object-cover max-h-24 md:max-h-48" src="{{ asset('storage/banner-unsplash.jpg') }}" alt="">
                <img class="w-full object-cover max-h-24 md:max-h-48" src="{{ asset('storage/banner-unsplash.jpg') }}" alt="">
            </div>
        </div>
    </section>
    <section class="container">
        <div class="mb-8 md:mb-12 xl:mb-14 flex flex-col">
            <div class="mb-4 md:mb-10 w-fit">
                <h2 class="font-bold text-xl md:text-2xl text-slate-800 capitalize">sản phẩm mới</h2>
                <div class="text-center border-2 border-lime-400 w-1/2"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 lg:gap-8">
                @foreach($hot_products as $product)
                <livewire:product-card :product="$product" :key="$product->id" />
                @endforeach
            </div>
        </div>
    </section>
    <section class="container my-6 md:my-8">
        <div class="mb-4 md:mb-10 flex justify-between">
            <div class="w-fit">
                <h2 class="font-bold text-xl md:text-2xl text-slate-800 capitalize">tin mới nhất</h2>
                <div class="text-center border-2 border-lime-400 w-1/2"></div>
            </div>
            <a href="{{ route('post.index') }}" class="flex items-center gap-x-1 text-sky-500">
                <span>Xem thêm</span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
        <div class="mt-4 flex flex-wrap md:gap-5">
            <?php $first_post = $posts->first(); $posts = $posts->skip(1);?>
            <div class="col-left basis-[100%] md:basis-[717px]">
                <a class="block" href="{{ $first_post->getUrl() }}">
                    <img src="{{ $first_post->getImage() }}" alt="{{ $first_post->title . '-' . config('app.name') }}" class="!md:max-h-96 max-h-[380px] w-full rounded-lg object-fill aspect-video">
                </a>
                <div class="pt-[12px]">
                    <a class="mt-1 md:mt-2 block" href="{{ $first_post->getUrl() }}">
                        <h3 class="text-lg md:text-2xl font-bold">{{ $first_post->title }}</h3>
                    </a>
                    <a class="mt-1 md:mt-2 block" href="{{ $first_post->getUrl() }}">
                        <p class="text-sm md:text-base line-clamp-2 md:line-clamp-3 text-ellipsis">{{ $first_post->content }}</p>
                    </a>
                </div>
            </div>
            <div class="mt-4 flex-1 md:col-span-2 md:mt-0">
            @foreach($posts as $i => $post)
                <livewire:post-card :post="$post" :key="$post->id" />
            @endforeach
            </div>
        </div>
    </section>
</div>
