/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                maroon: {
                    50: "#fdf2f3",
                    100: "#fbe6e9",
                    200: "#f3cdd2",
                    300: "#e59ca3",
                    400: "#ce6a73",
                    500: "#a73845", // main maroon
                    600: "#8a2e3a",
                    700: "#6f2530",
                    800: "#591e28",
                    900: "#451720",
                    950: "#2a0c12",
                },
                gold: {
                    50: "#fefce8",
                    100: "#fef9c3",
                    200: "#fef08a",
                    300: "#fde047",
                    400: "#facc15",
                    500: "#eab308", // main gold
                    600: "#ca8a04",
                    700: "#a16207",
                    800: "#854d0e",
                    900: "#713f12",
                    950: "#422006",
                },
            },
        },
    },
    plugins: [],
};
