<div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
    <div class="container">
        <div class="flex px-3">
            <img class="rounded-full w-20 h-20" src="{{ $user->avatar }}" alt="{{ $user->name }}">
            <div class="ml-3 flex flex-col">
                <p class="font-bold text-base mb-1">{{ $user->name }}</p>
                <p class="text-slate-700">{{ $user->email }}</p>
            </div>
        </div>
        <div class="mt-3 grid grid-cols-3 gap-x-3 p-2 bg-slate-100">
            <div class="flex flex-col items-center bg-white p-2 font-semibold shadow">
                <i class="fa-solid fa-box text-2xl text-rose-500"></i>
                <p class="mt-2">{{ $user->orders->count() }} đơn hàng</p>
            </div>
            <div>
                <livewire:user.update-password-form />
            </div>
            <div class="flex flex-col items-center bg-white p-2 font-semibold shadow">
                <i class="fa-brands fa-telegram text-2xl text-sky-500"></i>
                <p class="mt-2">Telegram</p>
            </div>
        </div>
    </div>
    <div class="h-2 md:h-4 lg:h-6 bg-neutral-100 my-3 md:my-6"></div>
</div>
