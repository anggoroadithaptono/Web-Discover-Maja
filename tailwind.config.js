// tailwind.config.js
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.{js,ts}",
    "./resources/css/**/*.css",
    "./public/css/**/*.css"
  ],
  theme: {
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"]
      },
      colors: {
        kopi: {
          DEFAULT: '#3e2f1c',
          muda: '#f4f1ea',
          tua: '#8c6239',
          krem: '#d5bfa3'
        }
      },
      animation: {
        'fade-in': 'fadeIn 0.4s ease-in',
        'fade-out': 'fadeOut 0.4s ease-in',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', transform: 'rotateY(-90deg)' },
          '100%': { opacity: '1', transform: 'rotateY(0)' },
        },
        fadeOut: {
          '0%': { opacity: '1', transform: 'rotateY(0)' },
          '100%': { opacity: '0', transform: 'rotateY(90deg)' },
        },
      }
    },
  },
  plugins: [],
}
