/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php"],
    theme: {
        extend: {},
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '2rem',
                xl: '2rem',
            },
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1170px',
            'xl': '1170px',
            '2xl': '1170px',
        },
        fontFamily: {
            'nunito': ['Nunito', 'sans-serif'],
        }
    },
    plugins: [],
};
