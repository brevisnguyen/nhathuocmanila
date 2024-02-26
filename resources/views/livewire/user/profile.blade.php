<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container lg:grid lg:grid-cols-12 lg:gap-5">
        <div class="lg:col-span-3">
            <div class="flex flex-row lg:flex-col items-center">
                <a href="{{ $user->avatar }}" target="_blank">
                    <img class="rounded-full w-20 h-20 lg:w-32 lg:h-32" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                </a>
                <div class="ml-3 lg:ml-0 lg:mt-3 flex flex-col lg:items-center">
                    <p class="font-bold text-base mb-1">{{ $user->name }}</p>
                    <p class="text-slate-700">{{ $user->email }}</p>
                </div>
            </div>
            <div class="mt-3 lg:mt-5 py-2 grid grid-cols-3 lg:grid-rows-3 lg:grid-cols-none gap-3">
                <div>
                    <livewire:user.update-password-form />
                </div>
                <div>
                    <a href="#orders" class="flex flex-col lg:flex-row lg:gap-x-3 items-center justify-center p-2 lg:py-4 shadow-md hover:shadow-lg">
                        <i class="fa-solid fa-bag-shopping text-2xl text-rose-500"></i>
                        <p class="mt-2 lg:mt-0">{{ $user->orders->count() }} đơn hàng</p>
                    </a>
                </div>
                <div>
                    <livewire:user.link-telegram />
                </div>
            </div>
        </div>
        <div id="orders" class="my-5 lg:my-0 lg:col-span-9">
            <h2 class="my-3 lg:my-0 lg:mb-5 text-lg font-semibold uppercase text-sky-500">
                <i class="fa-solid fa-basket-shopping mr-0.5 text-base"></i>
                Đơn hàng của bạn
            </h2>
            @if($user->orders->count() > 0)
            <div class="flex flex-col">
                @foreach($user->orders as $order)
                <livewire:user.show-order :order="$order" :id="$order->id" />
                @endforeach
            </div>
            @else
            <p class="py-6 mx-auto text-center">Bạn chưa có đơn hàng nào!</p>
            @endif
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
