import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                display: ['"Baloo 2"', ...defaultTheme.fontFamily.sans],
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                primary: {
                    DEFAULT: '#FFB020',
                    dark: '#E89A0C',
                    light: '#FFD98A',
                },
                secondary: {
                    DEFAULT: '#0F8B7F',
                    dark: '#0B6B62',
                    light: '#5FBDB3',
                },
                accent: {
                    DEFAULT: '#FF6B4A',
                    dark: '#E5502E',
                },
                ink: '#242423',
                cream: '#FFFDF9',
                'tint-yellow': '#FFF3DA',
                'tint-teal': '#E8F5F2',
            },
            borderRadius: {
                pill: '999px',
            },
        },
    },

    plugins: [forms],
};
