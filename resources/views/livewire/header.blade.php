<div>
    <header>
        <div class="header-top hidden md:block w-full bg-neutral-100 text-slate-800">
            <div class="container py-3 flex flex-wrap justify-between">
                <div class="my-auto grid grid-cols-2 divide-x">
                    <a href="{{ 'https://t.me/' . $website['telegram'] }}" target="_blank"
                        class="inline-flex gap-x-1 justify-center items-center hover:text-lime-500">
                        <i class="fa-brands fa-telegram relative"></i>
                        <p class="my-auto">nhathuocmanila</p>
                    </a>
                    <p class="ps-4 text-sm my-auto">Tư vấn miễn phí 24/7</p>
                </div>
                <div class="social flex justify-center items-center gap-x-4">
                    <p class="text-sm text-slate-800 italic">Tìm chúng mình trên</p>
                    <a href="{{ 'https://www.facebook.com/' . $website['facebook'] }}" target="_blank"
                        class="hover:text-blue-500">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="{{ 'https://www.tiktok.com/@' . $website['tiktok'] }}" target="_blank"
                        class="hover:text-red-500">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <a href="{{ 'https://t.me/' . $website['telegram'] }}" target="_blank" class="hover:text-lime-500">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="grid grid-cols-12 items-center">
                <div class="logo col-span-8 md:col-span-3 px-2 py-3">
                    <a href="{{ route('home') }}" wire:navigate>
                        <img src="{{ asset('storage/' . $website['logo_landscape']) }}" alt="{{ config('app.name') }}">
                    </a>
                </div>
                <div class="nav md:col-span-7 px-2 mx-auto hidden md:block">
                    <nav
                        class="py-4 uppercase font-bold flex md:gap-x-3 lg:gap-x-6 xl:gap-x-10 md:text-sm lg:text-base">
                        <a href="{{ route('home') }}" wire:navigate @class([
                            'hover:text-lime-500',
                            'text-lime-500' => request()->routeIs('home'),
                        ])>
                            trang chủ
                        </a>
                        <a href="{{ route('all-products') }}" wire:navigate @class([
                            'hover:text-lime-500',
                            'text-lime-500' => request()->routeIs('all-products'),
                        ])>
                            thuốc
                        </a>
                        <a href="{{ route('post-card') }}" wire:navigate @class([
                            'hover:text-lime-500',
                            'text-lime-500' => request()->routeIs('post-card'),
                        ])>
                            tin tức
                        </a>
                        <a href="{{ route('profile') }}" wire:navigate @class([
                            'hover:text-lime-500',
                            'text-lime-500' => request()->routeIs('profile'),
                        ])>
                            đơn hàng
                        </a>
                        <a href="{{ route('questions') }}" wire:navigate @class([
                            'hover:text-lime-500',
                            'text-lime-500' => request()->routeIs('questions'),
                        ])>
                            trợ giúp
                        </a>
                    </nav>
                </div>
                <div class="col-span-4 col-start-10 md:col-span-2 flex items-center justify-between lg:justify-around">
                    @livewire('cart-count', [], key('cart-count'))

                    @if (auth()->check())
                        <a wire:navigate href="{{ route('profile') }}" class="flex items-center">
                            <img class="w-6 h-6 rounded-full mr-2" src="{{ auth()->user()->avatar }}"
                                alt="Ảnh đại diện {{ auth()->user()->name }}">
                            <p class="hidden md:block">{{ auth()->user()->name }}</p>
                        </a>
                    @else
                        <a wire:navigate href="{{ route('profile') }}" class="text-2xl md:text-base text-blue-500">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-3 pb-4">
        <div class="flex flex-col gap-y-7 md:grid md:grid-cols-12 gap-x-3">
            <div
                x-data="{ open: window.innerWidth > 768 && @json(Route::currentRouteName() == 'home') }"
                class="md:col-span-3 relative"
            >
                <div class="categories-all bg-lime-600 text-white uppercase font-extrabold px-4 py-3">
                    <div class="flex justify-between items-center cursor-pointer" x-on:click="open = !open">
                        <div>
                            <i class="fa-solid fa-bars-staggered ml-4 mr-2"></i>
                            <span>Danh mục</span>
                        </div>
                        <i class="fa-solid fa-caret-down text-end"></i>
                    </div>
                </div>
                @if ($categories->isNotEmpty())
                    <ul x-show="open" x-transition.origin.top.left
                        class="p-3 border border-solid border-gray-200 text-slate-800 bg-white absolute w-full z-10 max-h-96 overflow-y-scroll scrollbar">
                        @foreach ($categories as $category)
                            <li
                                class="flex py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">
                                <a href="{{ $category->url }}" class="w-full">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="md:col-span-9 md:px-3">
                <div
                    class="flex flex-col md:flex-row justify-between"
                    x-data="{ show: @json(Route::currentRouteName() == 'home') }"
                >
                    <div class="grow md:w-8/12">
                        @livewire('search-box',[], key('search-box'))
                    </div>

                    <div class="hidden lg:flex items-center justify-center md:w-4/12">
                        <div
                            class="bg-slate-200 rounded-full mr-4 w-10 h-10 flex items-center justify-center text-lime-900">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="grid grid-rows-2">
                            <span class="font-bold">{{ $website['hotline'] }}</span>
                            <span class="text-gray-500 text-sm">Hỗ trợ 24/7</span>
                        </div>
                    </div>
                    <div class="block md:hidden" x-show="show">
                        <div class="my-4 grid grid-cols-3 gap-3 text-center items-stretch">
                            <div class="bg-slate-100 rounded-md shadow-md flex flex-col items-center p-1">
                                <img class="h-8 w-8" src="{{ asset('storage/can_mua_thuoc.png') }}" alt="">
                                <p class="text-sm font-bold">Thuốc đa dạng</p>
                            </div>
                            <div class="bg-slate-100 rounded-md shadow-md flex flex-col items-center p-1">
                                <img class="h-8 w-8" src="{{ asset('storage/tu_van_voi_duoc_sy.png') }}"
                                    alt="">
                                <p class="text-sm font-bold">Dược sỹ tư vấn</p>
                            </div>
                            <div class="bg-slate-100 rounded-md shadow-md flex flex-col items-center p-1">
                                <img class="h-8 w-8" src="{{ asset('storage/tim_nha_thuoc_gan_day.png') }}"
                                    alt="">
                                <p class="text-sm font-bold text-wrap">Ship mọi nơi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
