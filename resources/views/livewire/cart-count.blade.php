<div>
    <a href="{{ route('home') }}" class="hover:text-lime-600 flex items-center justify-center">
        <span class="mr-1 hidden md:inline-block">Giỏ hàng</span>
        <div class="relative">
            <i class="fa-solid fa-cart-shopping text-2xl md:text-base text-rose-500"></i>
            @if($count != 0)
            <div class="absolute -top-3 -right-3 text-xs px-1.5 py-0.5 rounded-full bg-rose-500 text-white">{{ $count }}</div>
            @endif
        </div>
    </a>
</div>
