<div x-data="{
    name: $wire.name,
    highlightedIndex: 0,
    highlightNext() {
        this.highlightedIndex++;
        if (this.highlightedIndex > this.$refs.results.children.length - 1) {
            this.highlightedIndex = 0;
        }
        this.scrollIntoView();
    },
    highlighPrevious() {
        this.highlightedIndex--;
        if (this.highlightedIndex < 0) {
            this.highlightedIndex = this.$refs.results.children.length - 1;
        }
        this.scrollIntoView();
    },
    scrollIntoView() {
        console.log(this.highlightedIndex);
        this.$refs.results.children[this.highlightedIndex].scrollIntoView({
            block: 'nearest',
            behavior: 'smooth'
        });
    },
    onEnter() {
        let url = this.$refs.results.children[this.highlightedIndex].getAttribute('data-url');
        window.location = url;
    }
}" class="relative">
    <form wire:submit="search" class="flex items-center h-12 border border-gray-300">
        <div class="hidden md:block font-bold px-3">Tất cả danh mục</div>

        <input
            wire:model.live.debounce.300ms="name"
            x-on:keydown.down.stop.prevent="highlightNext"
            x-on:keydown.up.stop.prevent="highlighPrevious"
            x-on:keyup.enter.stop.prevent="onEnter"
            type="text" placeholder="Bạn muốn tìm thuốc gì ạ?"
            class="grow border-none outline-none focus:ring-0">

        <button type="submit" class="h-12 px-4 bg-lime-500 text-white">Tìm kiếm</button>
    </form>
    <div x-show.important="$wire.isShow" x-transition class="z-20 absolute w-full bg-white">
        <ul x-ref="results" class="border">
            @foreach ($results as $item)
                <li data-url="{{ $item->url }}" class="border-b px-2 py-1 hover:bg-gray-100" x-bind:class="{'bg-gray-100': @json($loop->index) === highlightedIndex}">
                    <a href={{ $item->url }}" class="flex">
                        <picture class="aspect-square object-cover h-12 w-12">
                            <source srcset="{{ $item->getFirstMediaUrl('products', 'thumb') }}">
                            <img class="aspect-square object-cover h-12 w-12" src="https://placehold.co/50x50">
                        </picture>
                        <p class="ml-3 text-sm">{{ $item->name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
