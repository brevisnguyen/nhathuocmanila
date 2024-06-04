<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container">
        <div class="flex flex-col md:grid md:grid-cols-12 md:gap-x-3">
            <div class="md:col-span-8 md:px-2">
                <div class="mb-4 md:mb-8">
                    <h1 class="mb-5 text-3xl md:text-4xl font-semibold">{{ $post->title }}</h1>
                    <div class="flex items-center justify-between text-sm md:text-base md:px-3">
                        <div class="flex items-center">
                            <img class="rounded-full w-7 h-7 mr-2" src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                            <p><span class="text-gray-500">bởi</span> {{ $post->user->name }}</p>
                            <p class="ml-2">{{ '- ' . $post->updated_at->diffForHumans() }}</p>
                        </div>
                        <p class="flex items-center md:text-sm text-gray-500">
                            <i class="fa-regular fa-eye mr-1"></i>
                            {{ $post->views }}&nbsp;<span class="hidden md:block">lượt đọc</span>
                        </p>
                    </div>
                </div>
                <div class="mb-3 md:mb-6 grid grid-cols-3 md:grid-cols-6 gap-x-3">
                    <a
                        target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ $post->url }}&amp;src=sdkpreparse"
                        class="py-1.5 flex justify-center items-center rounded bg-blue-500 text-white md:col-span-2"
                    >
                        <i class="fa-brands fa-square-facebook text-xl mr-2"></i>
                        <p class="text-sm flex"><span class="hidden md:block">Chia sẻ trên&nbsp;</span>Facebook</p>
                    </a>
                    <a
                        target="_blank"
                        href="https://t.me/share/url?url={{ $post->url }}"
                        class="py-1.5 flex justify-center items-center rounded bg-sky-500 text-white md:col-span-2"
                    >
                        <i class="fa-brands fa-telegram text-xl mr-2"></i>
                        <p class="text-sm flex"><span class="hidden md:block">Chia sẻ trên&nbsp;</span>Telegram</p>
                    </a>
                    <button
                        x-on:click="navigator.clipboard.writeText(window.location.href),Toaster.success('Sao chép thành công!')"
                        class="py-1.5 flex justify-center items-center rounded bg-stone-400 text-white md:col-span-2"
                    >
                        <i class="fa-solid fa-copy text-xl mr-2"></i>
                        <p class="text-sm flex">Sao chép<span class="hidden md:block">&nbsp;liên kết</span></p>
                    </button>
                </div>

                <div class="mb-4 md:mb-8">
                    <picture class="object-cover aspect-w-16 aspect-h-9 mx-auto">
                        <source srcset="{{ $post->getFirstMediaUrl('posts', 'large') }}">
                        <img class="object-cover aspect-w-16 aspect-h-9 mx-auto" src="https://placehold.co/1280x720">
                    </picture>
                </div>

                <div class="mb-4 md:mb-8 prose prose-base prose-a:text-blue-600 max-w-none">{!! $post->content !!}</div>
            </div>
            <div class="md:col-span-4 md:px-4">
                <div class="border-b-2 border-gray-200 w-full pb-1 after:content-[''] after:w-40 after:bg-red-600 after:h-[2px] after:block after:relative after:-bottom-[6px]">
                    <h2 class="text-xl font-bold">Có thể bạn sẽ thích</h2>
                </div>
                <div class="flex flex-col mt-3 md:mt-5">
                    @foreach($posts as $p)
                        @if($loop->first)
                            <div class="hidden md:block basis-full overflow-hidden mb-4">
                                <a href="{{ $p->url }}" wire:navigate class="relative group">
                                    <div class="absolute bottom-0 left-0 w-full py-3 bg-gradient-to-b from-gray-600/50 z-10">
                                        <h3 class="text-lg line-clamp-2 text-ellipsis px-2 text-white">{{ $p->title }}</h3>
                                    </div>
                                    <picture class="object-cover aspect-w-16 aspect-h-9 group-hover:scale-110 rounded">
                                        <source srcset="{{ $p->getFirstMediaUrl('posts', 'medium') }}">
                                        <img class="aspect-w-16 aspect-h-9 object-cover group-hover:scale-110 rounded" src="https://placehold.co/640x360">
                                    </picture>
                                </a>
                            </div>
                            @break
                        @endif
                    @endforeach
                    @foreach($posts as $p)
                        @continue($loop->first)
                        <div class="overflow-hidden mb-4">
                            <a
                                class="grid grid-cols-12 text-sm md:text-base overflow-hidden group"
                                href="{{ $p->url }}" wire:navigate
                            >
                                <picture class="col-span-4 object-cover aspect-w-16 aspect-h-9 rounded">
                                    <source srcset="{{ $p->getFirstMediaUrl('posts', 'thumb') }}" media="(max-width: 800px)">
                                    <source srcset="{{ $p->getFirstMediaUrl('posts', 'medium') }}" media="(min-width: 800px)">
                                    <img class="object-cover aspect-w-16 aspect-h-9 rounded" src="https://placehold.co/320x180">
                                </picture>
                                <div class="ml-2 flex-1 col-span-8">
                                    <h3 class="font-semibold line-clamp-1 text-ellipsis mb-1 group-hover:text-lime-600">{{ $p->title }}</h3>
                                    <p class="line-clamp-2 text-ellipsis text-xs md:text-sm">{{ $p->content }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
