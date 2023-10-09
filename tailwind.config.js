/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  darkMode: 'class',
  theme: {
    fontFamily: {
      sans:[
        'system-ui',
        '-apple-system',
        '"Segoe UI',
        'Robot',
        '"Helvetica Neue',
        'Arial',
        'sans-serif'
      ],
    },
    container: {
      center: true,
    },
    extend: {
      colors:{
        primary: {50:"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"},
        babyblue: "#253495"
      }
    }
    ,
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["light"]
  },
}