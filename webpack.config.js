// const MiniCssExtractPlugin = require('mini-css-extract-plugin');

// module.exports = {
//   plugins: [new MiniCssExtractPlugin()],
//   module: {
//     rules: [
//       {
//         test: /\.css$/i,
//         use: [MiniCssExtractPlugin.loader, 'css-loader'],
//       },
//     ],
//   },
// };
import css from 'file.css';

module.exports = {
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
};
