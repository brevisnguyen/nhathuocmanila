<div>
    <div class="bg-slate-100">
        <div class="container py-6 md:py-10">
            <h1 class="text-3xl text-slate-800 font-semibold">{{ $category->name }}</h1>
        </div>
    </div>
    <div class="bg-white">
        <div class="container mt-4 flex items-center justify-between">
            <div class="text-base text-slate-800">{{ $products->count() }}&nbsp;sản phẩm</div>
            <div
                class="relative"
                x-data="{
                    open: false,
                    toggle() {
                        if (this.open) {
                            return this.close()
                        }
                        this.$refs.button.focus()
                        this.open = true
                    },
                    close(focusAfter) {
                        if (! this.open) return
                        this.open = false
                        focusAfter && focusAfter.focus()
                    }
                }"
                x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                x-id="['dropdown-button']"
            >
                <button
                    class="flex items-center gap-x-2 cursor-pointer"
                    x-ref="button"
                    x-on:click="toggle()"
                    :aria-expanded="open"
                    :aria-controls="$id('dropdown-button')"
                    type="button"
                >
                    Sắp xêp
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul
                    class="py-2 rounded-lg shadow-md w-40 mt-2 text-slate-800 bg-white absolute right-3 z-10"
                    x-ref="panel"
                    x-show="open"
                    x-transition.origin.top.left
                    :id="$id('dropdown-button')"
                    style="display: none;"
                >
                    <li wire:click="filter('lowest'), open=!open" class="w-full px-4 py-2.5 text-left cursor-pointer hover:bg-gray-50 disabled:text-gray-500"><p>Giá thấp đến cao</p></li>
                    <li wire:click="filter('highest'), open=!open" class="w-full px-4 py-2.5 text-left cursor-pointer hover:bg-gray-50 disabled:text-gray-500"><p>Giá cao đến thấp</p></li>
                    <li wire:click="filter('newest'), open=!open" class="w-full px-4 py-2.5 text-left cursor-pointer hover:bg-gray-50 disabled:text-gray-500"><p>Mới nhất</p></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container my-4">
            @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2 md:gap-4">
                @foreach($products as $product)
                <livewire:product-card :product="$product" :key="$product->id" />
                @endforeach
            </div>
            {{ $products->links(data: ['scrollTo' => false]) }}
            @else
            <div class="flex items-center justify-center">
                <p class="m-auto font-semibold text-xl my-6">Dữ liệu đang được cập nhật...</p>
            </div>
            @endif
        </div>
    </div>
</div>
