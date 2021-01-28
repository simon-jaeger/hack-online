module.exports = {
  devServer: {proxy: "http://hackonline.test", disableHostCheck: true},
  outputDir: "../backend/public/",
}

// NOTE: access dev server via localhost.test (register as custom hostname for 127.0.0.1) to avoid ajax lag
// --> see: https://www.dionysopoulos.me/improve-php-performance-on-windows.html
