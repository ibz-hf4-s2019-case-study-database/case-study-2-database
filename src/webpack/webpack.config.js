const path = require('path');

module.exports = {
    entry: ['./src/index.js', './src/index.scss'],
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist')
    },
    module: {
        rules: [
            {
                test: /.scss$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].css',
                            outputPath: '/'
                        }
                    },
                    {
                        loader: 'extract-loader'
                    },
                    {
                        loader: 'css-loader'
                    },
                    {
                        loader: 'sass-loader'
                    }
                ]
            }
        ]
    }
};