<div>
    <header>
        <div class="header-top hidden md:block w-full bg-neutral-100 text-slate-800">
            <div class="container py-3 flex flex-wrap justify-between">
                <div class="my-auto grid grid-cols-2 divide-x">
                    <a href="https://t.me/nhathuocmanila" class="inline-flex gap-x-1 justify-center items-center hover:text-lime-500">
                        <i class="fa-brands fa-telegram relative"></i>
                        <p class="my-auto">nhathuocmanila</p>
                    </a>
                    <p class="ps-4 text-sm my-auto">Tư vấn miễn phí 24/7</p>
                </div>
                <div class="social flex justify-center items-center gap-x-4">
                    <p class="text-sm text-slate-800 italic">Tìm chúng mình trên</p>
                    <a href="#" class="hover:text-blue-500"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-red-500"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" class="hover:text-lime-500"><i class="fa-brands fa-telegram"></i></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="grid grid-cols-12 items-center">
                <div class="logo col-span-9 md:col-span-3 px-2 py-3">
                    <a href="#"><img src="{{ asset('storage/logo-nha-thuoc-manila.png') }}" alt="logo nha thuoc manila"></a>
                </div>
                <div class="nav col-span-6 px-2 mx-auto hidden md:block">
                    <nav class="py-4 uppercase font-bold flex gap-x-10">
                        <a href="{{ route('homepage') }}" @class(['text-lime-500'=> request()->routeIs('homepage')]) class="hover:text-lime-500">home</a>
                        <a href="{{ route('homepage') }}" @class(['text-lime-500'=> request()->routeIs('share')]) class="hover:text-lime-500">share</a>
                        <a href="{{ route('homepage') }}" @class(['text-lime-500'=> request()->routeIs('contact')]) class="hover:text-lime-500">contact</a>
                    </nav>
                </div>
                <div class="contact col-span-3 px-2 text-right">
                    <a href="{{ route('homepage') }}" class="hover:text-lime-600">
                        <span class="mr-1 hidden md:inline-block">Giỏ hàng</span>
                        <i class="fa-solid fa-cart-shopping text-2xl md:text-base"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="hero container mb-4 mt-3">
        <div class="flex flex-col gap-y-7 md:grid md:grid-cols-12">
            <div class="md:col-span-3 md:px-3 relative" x-data="{open: true}" x-init="open=window.innerWidth > 768">
                <div class="categories-all bg-lime-600 text-white uppercase font-extrabold px-4 py-3">
                    <div class="flex justify-between items-center cursor-pointer" x-on:click="open = !open">
                        <div>
                            <i class="fa-solid fa-bars-staggered ml-4 mr-2"></i>
                            <span>Danh mục</span>
                        </div>
                        <i class="fa-solid fa-caret-down text-end"></i>
                    </div>
                </div>
                <ul x-show="open" x-transition.origin.top.left class="py-3 pl-10 border border-solid border-gray-200 text-slate-800">
                    <li class="py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">Danh mục 1</li>
                    <li class="py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">Danh mục 2</li>
                    <li class="py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">Danh mục 3</li>
                    <li class="py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">Danh mục 4</li>
                    <li class="py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">Danh mục 5</li>
                    <li class="py-2 cursor-pointer hover:ml-2 hover:text-lime-800 hover:transition-all hover:duration-200">Danh mục 6</li>
                </ul>
            </div>
            <div class="search md:col-span-9 md:px-3 mb-7">
                <div class="search-form flex flex-col md:flex-row justify-between mb-4 md:mb-8">
                    <div class="w-full md:w-3/4">
                        <form action="search">
                            <div class="flex items-center relative h-12 border border-solid border-gray-300">
                                <div class="font-bold ml-5 mr-8 hidden md:block">Tất cả danh mục</div>
                                <input type="text" placeholder="Bạn muốn tìm thuốc nào?" class="border-none placeholder:text-gray-400 outline-none ring-0 grow px-4">
                                <button type="submit" class="bg-lime-700 text-white px-3 md:px-6 h-full items-end">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                    <div class="search-phone flex items-center justify-center mt-2">
                        <div class="bg-slate-200 rounded-full mr-4 w-10 h-10 flex items-center justify-center text-lime-900"><i class="fa-solid fa-phone"></i></div>
                        <div class="grid grid-rows-2">
                            <span class="font-bold text-slate-950">0985 435 9999</span>
                            <span class="text-slate-500">Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
