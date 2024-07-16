<div x-data="{
    highlightedIndex: '',
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
        if (this.highlightedIndex === '') {
            return false;
        }
        let url = this.$refs.results.children[this.highlightedIndex].getAttribute('data-url');
        window.location = url;
    }
}" class="relative">
    <form wire:submit="search" class="flex items-center h-12 border border-gray-300">
        <div class="hidden md:block font-bold px-3">Tất cả danh mục</div>

        <input
            required
            wire:model.live.debounce.300ms="name"
            x-on:keydown.down.stop.prevent="highlightNext"
            x-on:keydown.up.stop.prevent="highlighPrevious"
            x-on:keyup.enter.stop.prevent="onEnter"
            x-on:keyup.escape.stop.prevent="$wire.name = '', $wire.isShow = false, $wire.$refresh()"
            type="text" placeholder="Bạn muốn tìm thuốc gì ạ?"
            class="grow border-none outline-none focus:ring-0">

        <button type="submit" class="h-12 px-4 bg-lime-500 text-white">Tìm kiếm</button>
    </form>
    @error('name') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
    <div x-show.important="$wire.isShow" x-transition class="z-20 absolute w-full bg-white">
        <ul x-ref="results" class="border">
            @foreach ($results as $item)
                <li wire:key="{{ $item->id }}" data-url="{{ $item->url }}" class="border-b px-2 py-1 hover:bg-gray-100" x-bind:class="{'bg-gray-100': @json($loop->index) === highlightedIndex}">
                    <a href="{{ $item->url }}" wire:navigate class="flex">
                        <picture class="object-cover w-12 h-auto">
                            <source srcset="{{ $item->getFirstMediaUrl('products', 'thumb') }}">
                            <img class="object-cover w-12 h-auto" src="https://placehold.co/50x50">
                        </picture>
                        <p class="ml-3 text-sm">{{ $item->name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
