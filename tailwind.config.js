const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
  ],
  darkMode: "class", // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            coolGray: colors.coolGray,
            cyan: colors.cyan,
            sky: colors.sky
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms')
  ]
}
