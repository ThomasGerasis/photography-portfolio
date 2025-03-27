const glob = require("glob-all");
const path = require("path");
const zlib = require("zlib");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { PurgeCSSPlugin } = require("purgecss-webpack-plugin");
const CompressionPlugin = require("compression-webpack-plugin");

function collectSafelist() {
  return {
    standard: [],
    //  deep: [/^safelisted-deep-/],
    //  greedy: [/^safelisted-greedy/],
  };
}
module.exports = {
  context: path.resolve(__dirname, "assets"),
  entry: {
    core: "./js/script.js"
  },
  output: {
    filename: "js/[name].js",
    path: path.resolve(__dirname, "dist"),
    publicPath: "/dist/",
    clean: true
  },
  resolve: {
    extensions: [".ts", ".js"],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "css/[name].css",
    }),
    new PurgeCSSPlugin({
      paths: glob.sync([
          "./**/*.php",
          "./assets/js/**/*.js",
          "./assets/scss/**/*.scss",
      ]),
      safelist: collectSafelist,
      only: ['bootstrap'],
    }),
  ],
  watchOptions: {
    aggregateTimeout: 200,
    poll: 1000,
    ignored: /node_modules/,
    followSymlinks: true
  },
  module: {
    rules: [
      {
        test: /\.ts$/,
        use: "ts-loader",
        exclude: [/node_modules/],
      },
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
        test: /\.(png|svg|jpg|jpeg|gif)$/i,
        type: "asset/resource",
      },
    ],
  },

  
};
