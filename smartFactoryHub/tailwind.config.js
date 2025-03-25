/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.php'],
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

