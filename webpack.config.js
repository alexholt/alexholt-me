const path = require('path');

module.exports = (env = {}) => {

  return {
    devtool: 'inline-source-map',

    mode: env.production ? 'production' : 'development',

    entry: path.resolve(__dirname, 'js/index.js'),

    output: {
      path: path.resolve(__dirname, 'wp-content/themes/alex-theme/'),
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
          use: ['style-loader', 'css-loader'],
        }
      ]
    }
  };
};
