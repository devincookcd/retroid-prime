const mix = require('laravel-mix')
const path = require('path')
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
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/js/'),
        'styles': path.resolve(__dirname, 'resources/sass/'),
        'img': path.resolve(__dirname, 'resources/img/')
      }
    },
    output: {
      chunkFilename: 'js/[name].bundle.js?id=[chunkhash]',
      publicPath: '/'
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
  .sass('resources/sass/app.scss', 'public/css')
