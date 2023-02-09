// include the css extraction and minification plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const autoprefixer = require('autoprefixer');

module.exports = {
  entry: ['./styles/main.scss', './scripts/index.js'],
  module: {
    rules: [
      // compile all .scss files to plain old css
      {
        test: /\.(sass|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              url: false,
              sourceMap: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [['autoprefixer']],
              },
            },
          },
          'sass-loader',
        ],
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: ['file-loader'],
      },
      {
        test: /\.m?js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
  plugins: [
    // extract css into dedicated file
    new MiniCssExtractPlugin({
      filename: '../../assets/styles/build/main.min.css',
    }),
    new CopyWebpackPlugin({
      patterns: [{ from: './images', to: '../../assets/images' }],
    }),
    new CopyWebpackPlugin({
      patterns: [{ from: './dist', to: '../../assets/scripts' }],
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      https: false,
      proxy: 'http://sklep.obrabiarka.loc', //need to be changed to local website address,
    }),
  ],
};
