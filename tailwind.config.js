module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
	extend: {},
    extend: {
      colors: {
        'purpink' :'#FC7AF8',
		    'darkpink' : '#EE2BE8',

        'primary' : '#06141D',
        'secondary' : '#1B2730',
        'secondary-2' : '#28353E',
        'extend-gray' : '#A4A9AC',
        'primary-white' : '#FEFEFE',
        'secondary-grey' : '#A4A9AC',

      },
      fontFamily: {
        poppins: ['Poppins'],
        inter: ['Inter']
      }
    },
  },
  plugins: [],
}
