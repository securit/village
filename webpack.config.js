const path = require('path')
const webpack = require('webpack')

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    },
    plugins: [
        // Add Builder Build Feature Flags
        // https://github.com/vuejs/vue-next/tree/master/packages/vue#bundler-build-feature-flags
        // Define Bundler Build Feature Flags
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: true,
        }),
    ],
}
