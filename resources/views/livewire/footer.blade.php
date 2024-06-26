<div class="bg-gray-100 border-t border-gray-300">
    <div class="container pb-3 md:pb-6 pt-6 md:pt-10">
        <div class="footer-top block lg:grid lg:grid-cols-2">
            <div class="logo w-full">
                <img class="h-14" src="" alt="">
                <h4 class="slogan mt-5 md:mt-10">{{ $site['site_slogan'] }}</h4>
                <h4 class="phone text-base text-indigo-500"><i class="fa-solid fa-square-phone"></i>&nbsp;<span class="font-bold">{{ $link['hotline'] }}</span></h4>
                <h4 class="font-semibold text-base mt-4 mb-2">Tìm chúng tớ trên</h4>
                <div class="socials flex gap-x-6 items-center">
                    <a href="{{ 'https://www.facebook.com/' . $link['facebook'] }}" class="hover:text-white hover:bg-lime-500 h-10 w-10 flex items-center justify-center rounded-full border border-solid border-gray-200 bg-white text-gray-600"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ 'https://www.tiktok.com/@' . $link['tiktok'] }}" class="hover:text-white hover:bg-lime-500 h-10 w-10 flex items-center justify-center rounded-full border border-solid border-gray-200 bg-white text-gray-600"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="{{ 'https://t.me/' . $link['telegram'] }}" class="hover:text-white hover:bg-lime-500 h-10 w-10 flex items-center justify-center rounded-full border border-solid border-gray-200 bg-white text-gray-600"><i class="fa-solid fa-paper-plane"></i></a>
                </div>
            </div>
            <div class="links w-full mt-6 grid grid-cols-2 gap-x-8">
                <div class="flex flex-col items-start">
                    <h3 class="font-semibold mb-2">Về chúng tôi</h3>
                    <ul>
                        <li class="mb-1"><a href="#" class="hover:text-lime-600">Giới thiệu</a></li>
                        <li class="mb-1"><a href="#" class="hover:text-lime-600">Liên hệ</a></li>
                        <li class="mb-1"><a href="#" class="hover:text-lime-600">Mua và nhận hàng</a></li>
                    </ul>
                </div>
                <div class="flex flex-col items-start">
                    <h3 class="font-semibold mb-2">Danh mục</h3>
                    <ul>
                        <li class="mb-1"><a href="#" class="hover:text-lime-600">Thực phẩm chức năng</a></li>
                        <li class="mb-1"><a href="#" class="hover:text-lime-600">Thuốc đặc trị</a></li>
                        <li class="mb-1"><a href="#" class="hover:text-lime-600">Bài viết hay</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bot mt-4 pt-3 border-t border-gray-300">
            <p class="text-center md:text-left">© 2023 Nhà Thuốc Manila. Đã đăng ký bản quyền</p>
        </div>
    </div>
</div>
