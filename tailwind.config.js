/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",

  ],
  theme: {
    extend: {
      gridTemplateColumns: {
        '2-custom': 'repeat(2, minmax(0, 1fr))',
      },

      width: {
        '100': '29rem',
      }
    },
  },
  plugins: [],
}

