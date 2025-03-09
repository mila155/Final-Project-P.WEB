/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./portfolio.html"],
  theme: {
    container:{
      center: true,
      padding: '16px',
    },
    extend: {
      colors:{
        primary: '#fb923c',
        dark: '#052e16'
      },
      screens: {
        '2xl' : '1320px',
      },
    },
  },
  plugins: [],
}

