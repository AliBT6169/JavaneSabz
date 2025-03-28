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
                adminColor1: "#b2d5e6",
                adminColor2: "#3e95c1",
                adminColor3: "#1f4b60",
                adminColor4: "#132d3a",
            },
            gridTemplateColumns: {
                'minmaxfill': 'repeat(auto-fill,minmax(14rem,2fr))'
            },
            boxShadow: {
                'inner-2': 'inset -3px 0px 4px 0'
            },
        },
    },

    plugins: [forms],
};
