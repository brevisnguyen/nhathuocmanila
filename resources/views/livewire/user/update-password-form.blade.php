<div>
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'change-password-modal')"
        class="flex flex-col items-center bg-white p-2 font-semibold shadow w-full"
    >
        <i class="fa-solid fa-user-shield text-2xl text-yellow-500"></i>
        <p class="mt-2">Bảo mật</p>
    </button>

    @teleport('body')
    <x-modal name="change-password-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="updatePassword" class="p-6">
            <h2 class="text-lg font-bold text-gray-900 uppercase mb-5 text-center">Cập nhật mật khẩu</h2>

            <div>
                <label for="password" class="block font-medium text-sm text-gray-700">Mật khẩu mới</label>
                <input wire:model="password" placeholder="Nhập mật khẩu mới" type="password" id="password" required autocomplete="new-password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @error('password') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Xác nhận mật khẩu</label>
                <input wire:model="password_confirmation" type="password" id="password_confirmation" required autocomplete="new-password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @error('password_confirmation') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-center mt-4 gap-x-5">
                <button x-on:click="$dispatch('close')" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
