module.exports = {
    devServer: {
        proxy: "http://homestead.test"
    },
    configureWebpack: {
        devtool: 'source-map'
    }
};