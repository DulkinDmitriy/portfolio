const express = require('express')
const path = require('path')
const PORT = process.env.PORT || 5000

var phpExpress = require('php-express') ({
    binPath: 'php'
});

express()
  .use(express.static(path.join(__dirname, 'src')))
  .set('views', './src')
  .engine('php', phpExpress.engine)
  .set('view engine', 'php')
  .all(/.+\.php$/, phpExpress.router)
  .get('/', (req, res) => res.render('index'))
  .listen(PORT, () => console.log(`Listening on ${ PORT }`))