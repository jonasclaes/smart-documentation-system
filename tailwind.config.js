const colors = require('tailwindcss/colors')


module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            sky: colors.sky,
            cyan: colors.cyan
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
