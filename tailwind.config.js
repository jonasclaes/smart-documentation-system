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
        lime: colors.lime,
        teal: colors.teal,
        cyan: colors.cyan,
        fuchsia: colors.fuchsia,
        gray: colors.gray,
        white: colors.white
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
