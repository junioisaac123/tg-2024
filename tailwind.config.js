import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                firefly: {
                    50: "#eefdfc",
                    100: "#d5f8f7",
                    200: "#b0f1f1",
                    300: "#7ae4e6",
                    400: "#3cd0d4",
                    500: "#21b3b9",
                    600: "#1e909c",
                    700: "#1f747f",
                    800: "#216069",
                    900: "#204f59",
                    950: "#10353d", // DARK
                },
                gothic: {
                    50: "#f2f7f9",
                    100: "#deeaef",
                    200: "#c1d7e0",
                    300: "#97bac9",
                    400: "#6a99ae", // blue
                    500: "#497991",
                    600: "#40657a",
                    700: "#395465",
                    800: "#344856",
                    900: "#2f3e4a",
                    950: "#1c2630",
                },
                "pearl-bush": {
                    50: "#f9f5f3",
                    100: "#f2e9e2",
                    200: "#ebddd3", // pink
                    300: "#d3b39e",
                    400: "#c08f77",
                    500: "#b3765c",
                    600: "#a66450",
                    700: "#8a5044",
                    800: "#70433c",
                    900: "#5b3833",
                    950: "#311b19",
                },
            },
        },
    },

    plugins: [forms],
};
