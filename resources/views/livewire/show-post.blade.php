<div>
    <div class="container bg-white dark:bg-gray-800 my-5">
        <div class="flex flex-col md:grid md:grid-cols-12 md:gap-x-3">
            <div class="right md:col-span-8 md:px-2">
                <div class="header mb-4 md:mb-8">
                    <h1 class="title text-3xl md:text-4xl font-semibold">{{ $post->title }}</h1>
                    <div class="flex mt-5 items-center justify-between">
                        <div class="flex gap-x-2 items-center">
                            <div class="w-9 h-9 rounded-full flex bg-gray-200 text-indigo-500 text-2xl"><i class="fa-solid fa-user-doctor m-auto"></i></div>
                            <p class="text-gray-400">bởi <span class="text-gray-600">Admin</span></p>
                            <span>-</span>
                            <p>{{ $post->updated_at->diffForHumans() }}</p>
                        </div>
                        <p class="text-base text-lime-600 md:mr-8 flex items-center"><i class="fa-regular fa-eye mr-1"></i>{{ $post->views }}&nbsp;<span class="hidden md:block">lượt đọc</span></p>
                    </div>
                </div>
                <div class="featured-img">
                    <img class="aspect-auto bg-center object-cover" src="{{ $post->getImage() }}" alt="{{ $post->title }}">
                </div>
                <div class="share mt-2 grid grid-cols-3 md:grid-cols-6 gap-x-3">
                    <a class="py-1.5 flex gap-x-2 justify-center items-center text-xl bg-blue-400 text-white md:col-span-2"
                        target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ $post->getUrl() }}&amp;src=sdkpreparse"
                    >
                        <i class="fa-brands fa-square-facebook"></i>
                        <span class="text-sm hidden md:block">Chia sẻ trên</span>
                        <span class="text-sm">Facebook</span>
                    </a>
                    <a href="https://t.me/share/url?url={{ $post->getUrl() }}"
                        class="py-1.5 flex gap-x-2 justify-center items-center text-xl bg-sky-400 text-white md:col-span-2"
                    >
                        <i class="fa-brands fa-telegram"></i>
                        <span class="text-sm hidden md:block">Chia sẻ trên</span>
                        <span class="text-sm">Telegram</span>
                    </a>
                    <button x-on:click="navigator.clipboard.writeText(window.location.href)"
                        class="py-1.5 flex gap-x-2 justify-center items-center text-xl bg-stone-400 text-white md:col-span-2"
                    >
                        <i class="fa-solid fa-copy"></i>
                        <span class="text-sm">Sao chép</span>
                    </button>
                </div>
                <div class="content mt-4">{!! $post->content !!}</div>
            </div>
            <div class="left md:col-span-4 md:px-4 mt-4">
                <div class="border-b-2 border-gray-200 w-full pb-1 after:content-[''] after:w-40 after:bg-red-600 after:h-[2px] after:block after:relative after:-bottom-[6px]">
                    <h2 class="text-xl font-bold">Có thể bạn sẽ thích</h2>
                </div>
                <div class="flex flex-col mt-3 md:mt-5">
                    <?php $first_post = $posts->first(); $posts = $posts->skip(1);?>
                    <div class="hidden md:block basis-[100%] overflow-hidden">
                        <a href="{{ $first_post->getUrl() }}" class="relative overflow-hidden group">
                            <div class="absolute bottom-0 left-0 w-full h-2/5 bg-gradient-to-b from-gray-700/60 z-10"></div>
                            <div class="absolute bottom-2 left-2 text-white text-xl line-clamp-2 text-ellipsis z-10">{{ $first_post->title }}</div>
                            <img class="aspect-video object-cover bg-center group-hover:scale-110" src="{{ $first_post->getImage() }}" alt="{{ $first_post->title }}">
                        </a>
                    </div>
                    <div class="flex flex-col gap-y-2 md:mt-3">
                        @foreach($posts as $p)
                        <div class="grid grid-cols-6 md:grid-cols-5 gap-x-2">
                            <a href="{{ $p->getUrl() }}" class="col-span-2"><img class="object-cover" src="{{ $p->getImage() }}" alt="{{ $p->title }}"></a>
                            <div class="col-span-4 md:col-span-3 flex flex-col justify-between overflow-hidden">
                                <a href="{{ $p->getUrl() }}">
                                    <h3 class="font-semibold line-clamp-3 text-ellipsis hover:text-lime-700">{{ $p->title }}</h3>
                                </a>
                                <div class="flex justify-between items-center text-sm">
                                    <p>{{ $p->updated_at->diffForHumans() }}</p>
                                    <p class="text-lime-600"><i class="fa-regular fa-eye"></i>&nbsp;{{ $p->views }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
