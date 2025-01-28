import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                defaultColor: "#1A4D2E",
                defaultColor2: "#4F6F52",
                defaultColor3: "#267345",
                defaultColor4: "#F5EFE6",
                defaultColor5: "#85A947",
                defaultColor6: "#EFE3C2",
                defaultColor7: "#1c240f",
                darkColor1: "#333333",
                darkColor2: "#303632",
            },
            gridTemplateColumns: {
                'minmaxfill': 'repeat(auto-fill,minmax(12rem,0.5fr))'
            },
        },
    },

    plugins: [forms],
};
