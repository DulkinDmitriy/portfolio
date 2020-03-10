const smartGrid = require('smart-grid')

const settings = {
    filename: 'smartgrid',
    outputStyle: 'scss',
    columns: 12,
    offset: '0px',
    container: {
        maxWidth: '1024px',
        fields: '24px',
    },
    breakPoints: {
        md: {
            width: '768px',
            fields: '25px'
        },
        sm: {
            width: '425px',
            fields: '20px'
        }
    }
}

smartGrid('./src/css', settings)