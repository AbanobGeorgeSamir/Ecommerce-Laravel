import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  './storage/framework/views/*.php',
  './resources/views/**/*.blade.php',
  './resources/js/**/*.js',
  './resources/js/**/*.vue',
  './resources/js/**/*.jsx',
  './app/View/Components/**/*.php',
  './app/Livewire/**/*.php'],

  theme: {
    extend: {
      fontFamily: {
        sans: ['"Instrument Sans"', ...defaultTheme.fontFamily.sans]
      },
      colors: {
        brand: {
          light: '#2a8c96',
          DEFAULT: '#1f6f78',
          deep: '#174e55',
          accent: '#f2b880'
        }
      },
      borderRadius: {
        '4xl': '2rem'
      }
    }
  },

  plugins: [forms]
};