const path = require('path');

module.exports = (env = {}) => {

  const mode = env.production ? 'production' : 'development';

  const styleLoaders = [
    {
      loader: "file-loader",
      options: {
        name: '[name].[ext]'
      }
    },

    "extract-loader",

    {
      loader: "css-loader",
      options: {
        sourceMap: true
      }
    },
  ];

  return {
    devtool: 'inline-source-map',

    mode,

    entry: path.resolve(__dirname, 'js/index.js'),

    output: {
      path: path.resolve(__dirname, 'wp-content/themes/alex-theme/build'),
      filename: 'bundle.js'
    },

    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          use: {
            loader: "babel-loader"
          }
        },

        {
          test: /\.css$/,
          use: styleLoaders,
        }
      ]
    }
  };
};
