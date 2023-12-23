<div class="post bg-white flex items-center overflow-hidden mb-4 md:mb-5 hover:text-lime-500">
    <a href="{{ $post->getUrl() }}" class="img block h-[74px] flex-initial basis-[132px] md:h-[84px] md:basis-[144px]">
        <img class="w-full h-full object-cover !rounded-lg" src="{{ $post->getImage() }}" alt="{{ $post->title . '-' . config('app.name') }}">
    </a>
    <div class="ml-3 flex-1">
        <a class="mb-[6px] block" href="{{ $post->getUrl() }}">
            <h3 class="text-base font-semibold mb-1 line-clamp-2 text-ellipsis">{{ $post->title }}</h3>
        </a>
        <a class="block" href="{{ $post->getUrl() }}">
            <p class="!text-sm line-clamp-2 text-ellipsis">{{ $post->content }}</p>
        </a>
    </div>
</div>
