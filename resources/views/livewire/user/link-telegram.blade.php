<div>
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'link-telegram-modal')"
        class="flex flex-col items-center lg:flex-row lg:justify-center lg:gap-x-3 p-2 lg:py-4 w-full shadow-md hover:shadow-lg"
    >
        <i class="fa-brands fa-telegram text-2xl text-sky-500"></i>
        <p class="mt-2 lg:mt-0">Telegram</p>
    </button>

    @teleport('body')
    <x-modal name="link-telegram-modal" :show="$errors->isNotEmpty()">
        <form wire:submit="linkToTelegram" class="p-6">
            <h2 class="text-lg font-bold text-gray-900 uppercase mb-5 text-center">Liên kết tài khoản Telegram</h2>
            <p class="text-sm italic text-nowrap mb-5">
                Việc liên kết tài khoản Telegram giúp quý khách nhận thông tin về đơn hàng
                cũng như liên hệ với CSKH dễ dàng hơn.
                Lấy ID bằng cách chat với Bot <a href="https://t.me/nhathuocmanila_bot" target="_blank" class="text-blue-500">@nhathuocmanila_bot</a>
            </p>
            <div>
                <label for="telegram_id" class="block font-medium text-sm text-gray-700">ID tài khoản Telegram</label>
                <input wire:model="telegram_id" type="text" id="telegram_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @error('telegram_id') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-center mt-4 gap-x-5">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Hủy
                </button>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Xác nhận
                </button>
            </div>
        </form>
    </x-modal>
    @endteleport
</div>
