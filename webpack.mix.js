const mix = require('laravel-mix')
const path = require('path')
var SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin')
// var LiveReloadPlugin = require('webpack-livereload-plugin')

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

const proxyUrl = process.env.MIX_BROWSERSYNC_PROXY_URL || 'http://test-cms.local/'

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
      }),

      new SWPrecacheWebpackPlugin({
        cacheId: 'pwa',
        filename: 'service-worker.js',
        staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js,html}'],
        minify: true,
        stripPrefix: 'public/',
        handleFetch: true,
        dynamicUrlToDependencies: { // you should add the path to your blade files here so they can be cached
          // and have full support for offline first (example below)
          '/': ['resources/views/welcome.blade.php']
          // '/posts': ['resources/views/posts.blade.php']
        },
        staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
        navigateFallback: '/',
        runtimeCaching: [
          {
            urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
            handler: 'cacheFirst'
          },
          {
            urlPattern: /^https:\/\/cdn\.jsdelivr\.net\//,
            handler: 'cacheFirst'
            // urlPattern: /https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css/
          }
        ]
        // importScripts: ['./js/push_message.js']
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
