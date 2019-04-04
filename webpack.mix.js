const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const proxyUrl = process.env.MIX_BROWSERSYNC_PROXY_URL || 'canadadrives.local'

mix.browserSync({
  proxy: proxyUrl,
  ghostMode: false,
  port: 4420
})

/**
 * Code-splitting the JS bundle
 */
mix.webpackConfig(webpack => {
  return {
    output: {
      chunkFilename: 'js/[name].bundle.js?id=[chunkhash]',
      publicPath: '/'
    },
    resolve: {
      alias: {
        '@': global.path.resolve(__dirname, 'resources/assets/js/'),
        'styles': global.path.resolve(__dirname, 'resources/assets/sass/'),
        'img': global.path.resolve(__dirname, 'resources/assets/img/')
      }
    },
    plugins: [
      new webpack.ProvidePlugin({
        Promise: 'es6-promise-promise'
      })
    ],
    module: {
      rules: [
        {
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /node_modules/
        }
      ]
    }
  }
})

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
