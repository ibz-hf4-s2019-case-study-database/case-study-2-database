const path = require('path');

module.exports = {
    entry: ['./src/build.js', './src/build.scss'],
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, '../web/Assets')
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
            },
            {
                test: /\.m?js$/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                ['@babel/preset-env', {
                                    "targets": {
                                        "browsers": ["last 2 versions", "ie >= 10"]
                                    }
                                }
                                ]
                            ],
                        },
                    }
                ]
            }
        ]
    }
};