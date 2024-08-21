/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},

        fontFamily: {
            display: ["'Public Sans', sans-serif"],
        },
        container: {
            center: true,
            padding: "0rem",
            screens: {
                sm: "600px",
                md: "728px",
                lg: "920px",
                xl: "980px",
                "2xl": "1320px",
            },
        },
        colors: {
            current: "currentColor",
            white: "#FFFFFF",
            black: "#000000",
            "primary-50": "#E9F8F3",
            "primary-500": "#20B486",
            "primary-900": "#06241B",
            "secondary-50": "#FFFAF5",
            "gray-700": "#363A3D",
            "gray-600": "#52565C",
            "gray-500": "#6D737A",
            "gray-black": "#1B1D1F",
            "gray-50": "#E7E9EB",
            "gray-white": "#FFFFFF",
            "gray-custom": "#E7E9EB",
            "pink-200": "#FFEEF0",
            "blue-200": "#F0F7FF",
        },
    },
    plugins: [require("flowbite/plugin"), require('daisyui'),],

};
