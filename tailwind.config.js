module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      ],
  theme: {
    extend: {
        fontFamily: {
            'FlatBold': 'alfont_com_JF-Flat-Bold"',
            'Flatnormal':'alfont_com_JF-Flat-regular',
            'noto_Regular':'THESANSARABIC-SEMILIGHT',
            Noto_Sans_Arabic: ["Noto Sans Arabic", "sans-serif"],
          },
          screens: {
            'iphone13':'450px'
          }
        },

  },
  plugins: [],
}
