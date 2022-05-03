import Cleave from 'cleave.js'

require('./bootstrap');

if(document.getElementById('price')){
    new Cleave('#price', {
        prefix: '$ ',
        numeral: true,
        numeralDecimalScale: 2,
        stripLeadingZeroes:true,
    })
}




