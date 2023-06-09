import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'bebas': ['Bebas Neue', 'sans-serif'],
                'montserrat': ['Montserrat', 'sans-serif'],
            },
        },
        colors: {
            'kuning': '#fcd34d',
            'kuningt': '#d97706',
            'kuningol': '#efb660',
            'kuninghm': '#ffd021',
            'oranye': '#f97316',
            'oranyet': '#b45309',
            'hijau': '#a3e635',
            'hijaut': '#16a34a',
            'hijauhv': '#7dd460',
            'abu': '#64748b',
            'hijauab': '#69b550',
        },
    },

    plugins: [
        require('flowbite/plugin'),
        require("daisyui")
    ],
};
