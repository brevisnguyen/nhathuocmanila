<div>
    <form wire:submit="register">
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Họ và Tên</label>
            <input wire:model="name" type="text" id="name" required autofocus autocomplete="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @error('name') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input wire:model="email" type="email" id="email" required autocomplete="username" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @error('email') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Mật khẩu</label>
            <input wire:model="password" type="password" id="password" required autocomplete="new-password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @error('password') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Xác nhận mật khẩu</label>
            <input wire:model="password_confirmation" type="password" id="password_confirmation" required autocomplete="new-password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @error('password_confirmation') <span class="mt-2 text-sm text-red-600 space-y-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-end justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                Đã có tài khoản, đăng nhập ngay!
            </a>
            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-500 focus:bg-lime-500 active:bg-lime-500 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Đăng ký
            </button>
        </div>
    </form>
</div>
