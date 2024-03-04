<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container">
        @if($name == '')
        <h2 class="text-xl md:text-3xl uppercase font-bold text-center mb-3 md:mb-5">danh sách thuốc mới nhất</h2>
        @else
        <h2 class="text-xl md:text-3xl font-bold text-center mb-3 md:mb-5">{{ $products->count() }} kết quả tìm kiếm cho <span class="text-lime-600">"{{ $name }}"</span></h2>
        @endif
        <p class="text-xs md:text-sm text-center mb-4 md:mb-8">
            Một số thuốc có sẵn nhưng chưa kịp cập nhật lên website, quý khách vui lòng liên hệ telegram @nhathuocmanila để biết chính xác nhất.
        </p>
        @if ($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-5 lg:gap-6">
                @foreach ($products as $product)
                    @livewire('product-card', ['product' => $product], key($product->id))
                @endforeach
            </div>
            <div class="my-4 flex justify-center">
                {{ $products->links() }}
            </div>
        @else
            <div class="my-5 flex flex-col items-center justify-center">
                <h3 class="text-xl md:text-2xl my-4">Không có sản phẩm nào phù hợp</h3>
                <a href="/" wire:navigate class="underline text-sky-500">Trở về trang chủ</a>
            </div>
        @endif
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
