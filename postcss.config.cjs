const { purgeCSSPlugin } = require('@fullhuman/postcss-purgecss');

module.exports = (ctx) => ({
  plugins: [
    require('autoprefixer'),
    ...(ctx.env === 'production'
      ? [
          purgeCSSPlugin({
            content: [
              './resources/views/**/*.blade.php',
              './resources/js/**/*.js',
              './resources/js/**/*.vue',
            ],
            safelist: {
              standard: [
                /^btn/, 
                /^modal/, 
                /^show/, 
                /^collapse/, 
                /^dropdown/, 
                /^navbar/, 
                /^active/, 
                /^alert/,
                /^form/,
                /^input/,
                /^card/,
                /^table/,
                /^badge/,
                /^text/,
                /^bg/,
                /^border/,
                /^rounded/,
                /^shadow/,
                /^p-/,
                /^m-/,
                /^w-/,
                /^h-/,
                /^d-/,
                /^flex/,
                /^justify/,
                /^align/,
                /^position/,
                /^overflow/
              ],
              deep: [/^soft-ui/],
              greedy: [/^tooltip/, /^popover/]
            },
            defaultExtractor: content => content.match(/[\w-/:%.]+(?<!:)/g) || [],
            // Add these options for better Bootstrap/Soft UI compatibility
            variables: true,
            keyframes: true,
          }),
        ]
      : []),
  ],
});