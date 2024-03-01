<div>
    <a href="{{ route('cart') }}" wire:navigate class="hover:text-lime-600 relative flex">
        <i class="fa-solid fa-cart-shopping text-2xl md:text-lg text-rose-500"></i>
        @if($count != 0)
        <div class="absolute -top-3 -right-3 text-xs px-1.5 py-0.5 rounded-full bg-rose-500 text-white">{{ $count }}</div>
        @endif
    </a>
</div>
