<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container">
        <h2 class="text-xl md:text-3xl uppercase font-bold text-center mb-3 md:mb-5">tin tức mới nhất</h2>
        <p class="text-xs md:text-sm text-center mb-4 md:mb-8">Bài viết được tác giả dựa theo kinh nghiệm bản thân và thu thập từ nhiều nguồn trên internet. Mọi ý kiến đóng góp xin gửi về Telegram @nhathuocmanila</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-5 md:gap-6">
            @foreach($posts as $post)
            <div class="flex flex-col">
                <a
                    class="overflow-hidden rounded mb-2"
                    href="{{ $post->url }}"
                    wire:navigate
                >
                    <picture class="aspect-video object-cover rounded hover:scale-105">
                        <source srcset="{{ $post->getFirstMediaUrl('posts', 'medium') }}" media="(max-width: 800px)">
                        <source srcset="{{ $post->getFirstMediaUrl('posts', 'large') }}" media="(min-width: 800px)">
                        <img class="aspect-video object-cover rounded hover:scale-105" src="https://placehold.co/640x360">
                    </picture>
                </a>
                <a href="{{ $post->url }}" wire:navigate>
                    <h3 class="text-lg md:text-xl font-bold line-clamp-1 text-ellipsis hover:text-lime-600">{{ $post->title }}</h3>
                </a>
                <p class="text-sm md:text-base my-2 line-clamp-3 text-ellipsis text-gray-600">{{ $post->content }}</p>
                <div class="flex items-center justify-between text-sm px-2">
                    <p>{{ $post->updated_at->diffForHumans() }}</p>
                    <a
                        wire:navigate
                        href="{{ $post->url }}"
                        class="text-sky-500 hover:mr-3"
                    >
                        Đọc tiếp<i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="my-3">
            {{ $posts->links() }}
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
