const colors = require('tailwindcss/colors')


module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
        blueGray: colors.blueGray,
        gray: colors.gray,
        white: colors.white,
        red: colors.red,
        green: colors.green
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms')
  ],
}
