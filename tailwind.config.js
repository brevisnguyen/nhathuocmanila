import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php"
    ],
    theme: {
        extend: {},
        container: {
            center: true,
            padding: '0.7rem',
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1280px',
        },
        fontFamily: {
            'nunito': ['Nunito', 'sans-serif'],
        }
    },
    plugins: [forms],
};
