<div>
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'link-telegram-modal')"
        class="flex flex-col items-center bg-white p-2 font-semibold shadow w-full"
    >
        <i class="fa-brands fa-telegram text-2xl text-sky-500"></i>
        <p class="mt-2">Telegram</p>
    </button>

    @teleport('body')
    <x-modal name="link-telegram-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="linkToTelegram" class="p-6">
            <h2 class="text-lg font-bold text-gray-900 uppercase mb-5 text-center">Liên kết tài khoản Telegram</h2>

            <div>
                <label for="telegram_id" class="block font-medium text-sm text-gray-700">ID tài khoản Telegram</label>
                <input wire:model="telegram_id" type="text" id="telegram_id" autofocus class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
