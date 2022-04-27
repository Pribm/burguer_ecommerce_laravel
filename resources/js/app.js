import Cleave from 'cleave.js'
require('./bootstrap');

new Cleave('#price', {
    prefix: '$ ',
    numeral: true,
    numeralDecimalScale: 2,
    stripLeadingZeroes:true,
})

