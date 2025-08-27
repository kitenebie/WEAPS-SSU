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
        primary: {
          50:  '#fdf2f2',
          100: '#fde8e8',
          200: '#fbd5d5',
          300: '#f8b4b4',
          400: '#f98080',
          500: '#7B1113', // Main maroon
          600: '#660d0f',
          700: '#500a0b',
          800: '#3a0708',
          900: '#250405',
          950: '#150202',
        },
      },
    },
  },
  plugins: [],
}
