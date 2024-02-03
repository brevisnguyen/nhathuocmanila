<div class="post bg-white flex overflow-hidden mb-4 md:mb-5 group">
    <a href="{{ $post->url }}" class="block h-[74px] flex-initial basis-[132px] md:h-[84px] md:basis-[144px]">
        <picture class="object-cover !rounded-lg">
            <source srcset="{{ $post->getFirstMediaUrl('posts', 'thumb') }}" media="(max-width: 800px)">
            <source srcset="{{ $post->getFirstMediaUrl('posts', 'medium') }}" media="(min-width: 800px)">
            <img class="object-cover !rounded-lg w-full h-full" src="{{ asset('storage/dummy_600x600.png') }}">
        </picture>
    </a>
    <div class="ml-3 flex-1">
        <a class="mb-[6px] block group-hover:text-lime-500" href="{{ $post->url }}">
            <h3 class="text-base font-semibold mb-1 line-clamp-1 text-ellipsis">{{ $post->title }}</h3>
        </a>
        <a class="block" href="{{ $post->url }}">
            <p class="!text-sm line-clamp-2 text-ellipsis">{{ $post->content }}</p>
        </a>
    </div>
</div>
