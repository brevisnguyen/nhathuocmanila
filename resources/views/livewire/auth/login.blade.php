<div>
    <form wire:submit="login">
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input wire:model="email" type="email" id="email" required autofocus autocomplete="username" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @error('title') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Mật khẩu</label>
            <input wire:model="password" type="password" id="password" required autocomplete="current-password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @error('title') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
        </div>
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="remember" id="remember" type="checkbox" class="rounded border-gray-300 text-lime-600 shadow-sm focus:ring-lime-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
            </label>
        </div>

        <div class="mt-4 flex justify-between items-end">
            <a href="{{ route('register') }}" wire:navigate class="text-sm text-gray-600 hover:text-gray-900 underline">Chưa có tài khoản, đăng ký ngay!</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-lime-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-500 focus:bg-lime-500 active:bg-lime-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Đăng nhập
            </button>
        </div>
    </form>
</div>
