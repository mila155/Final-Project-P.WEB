// const { heroui } = require("@heroui/react");
/** @type {import('tailwindcss').Config} */
// const defaultTheme = require("tailwindcss/defaultTheme");
export default {
  darkMode: 'class',
  // lightMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./node_modules/@heroui/theme/dist/**/*.{js,ts,jsx,tsx}"
  ],
  theme: {
    extend: {
      // animation: {
      //   glow: 'glow 1.5s infinite',
      // },
      // keyframes: {
      //   glow: {
      //     '0%, 100%': { boxShadow: '0 0 10px #ff00ff' },
      //     '50%': { boxShadow: '0 0 20px #ff00ff' },
      //   },
      fontFamily: {
        alata: ['Alata', 'sans-serif'],
        barlow: ['Barlow', 'sans-serif'],
        geist: ['Geist', 'sans-serif'],
        lato: ['Lato', 'sans-serif'],
        mulish: ['Mulish', 'sans-serif'],
        opensans: ['Open Sans', 'sans-serif'],
        outfit: ['Outfit', 'sans-serif'],
        sofia: ['Sofia Sans Semi Condensed', 'sans-serif'],
        ubuntu: ['Ubuntu', 'sans-serif'],
        body: [
        'Inter', 
        'ui-sans-serif', 
        'system-ui', 
        '-apple-system', 
        'system-ui', 
        'Segoe UI', 
        'Roboto', 
        'Helvetica Neue', 
        'Arial', 
        'Noto Sans', 
        'sans-serif', 
        'Apple Color Emoji', 
        'Segoe UI Emoji', 
        'Segoe UI Symbol', 
        'Noto Color Emoji'
        ],
        sans: [
          'Inter', 
          'ui-sans-serif', 
          'system-ui', 
          '-apple-system', 
          'system-ui', 
          'Segoe UI', 
          'Roboto', 
          'Helvetica Neue', 
          'Arial', 
          'Noto Sans', 
          'sans-serif', 
          'Apple Color Emoji', 
          'Segoe UI Emoji', 
          'Segoe UI Symbol', 
          'Noto Color Emoji'
        ]
      },
      colors: {
        primary: {
          // hijau
          // 50:  "#f0fdf4",  
          // 100: "#dcfce7",
          // 200: "#bbf7d0",
          // 300: "#86efac",
          // 400: "#4ade80",
          // 500: "#22c55e",  
          // 600: "#16a34a",
          // 700: "#15803d",
          // 800: "#166534",
          // 900: "#14532d",
          // 950: "#052e16" 
          // kuning
          50:  "#fefce8",
          100: "#fef9c3",
          200: "#fef08a",
          300: "#fde047",
          400: "#facc15",
          500: "#eab308", 
          600: "#ca8a04",
          700: "#a16207",
          800: "#854d0e",
          900: "#713f12",
          950: "#422006"  
        },
        light: "#fefcbf", // For lighter primary color
        DEFAULT: "#b7791f", // Normal primary color
        dark: "#744210", // Used for hover, active, etc.
        // hijauutama :  
        navlight : "#41CA1B",
        navdark : "#0F3107",
        // isilight : "#fafafa",
        // isidark : "#111827"
        isidark : "#1C1C1C"
      },
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('flowbite-typography'),
    require("kutty"),
    // heroui()
  ],
}