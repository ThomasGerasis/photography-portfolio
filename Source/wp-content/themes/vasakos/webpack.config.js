const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require("webpack");
// const TerserPlugin = require('terser-webpack-plugin');
const glob = require("glob-all");
const PurgecssPlugin = require("purgecss-webpack-plugin");
const purgecssWordpress = require("purgecss-with-wordpress");

function collectSafelist() {
  return {
    standard: ["onesignal", /^onesignal-/, /^onesignal_/],
    //  deep: [/^safelisted-deep-/],
    //  greedy: [/^safelisted-greedy/],
  };
}

module.exports = {
  context: path.resolve(__dirname, "assets"),
  entry: {
    main: "./js/scripts.js",
    bootstrap: "./js/bootstrap.js",
    slider: "./js/slider.js",
    "infinite-scroll": "./js/infinite-scroll.js",
    "active": "./js/active.js",
    "about": "./js/about.js",
    // "contact": "./js/contact.js",
  },
  output: {
    filename: "[name].min.js",
    path: path.resolve(__dirname, "dist"),
    assetModuleFilename: "[name][ext]",
    clean: true,
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "css/[name].min.css",
    }),
    new webpack.WatchIgnorePlugin({
      paths: [/node_modules/],
    }),
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      'window.jQuery': 'jquery'
    }),
    //  new PurgecssPlugin({
    //    paths: glob.sync(["./**/*.php"]),
    //    safelist: [purgecssWordpress.safelist, collectSafelist],
    //  }),
  ],
  watchOptions: {
    aggregateTimeout: 200,
    poll: 1000,
    ignored: /node_modules/,
    followSymlinks: true,
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              importLoaders: 1,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: ["autoprefixer"],
              },
            },
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("sass"),
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/i,
        type: "asset/resource",
        generator: {
          filename: 'fonts/[name][ext]' // Output path inside `dist`
        }
      },
    ],
  },
};