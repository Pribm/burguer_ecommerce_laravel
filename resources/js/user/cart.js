import axios from 'axios'

let addressRadioButtons = document.querySelectorAll('#select_address input')

addressRadioButtons.forEach(radioButton => {
    radioButton.addEventListener('click', e => {
        e.currentTarget.parentNode.parentNode.querySelectorAll('input').forEach(input => input.checked = false)
        e.target.checked = true

        if(e.target.checked){
            axios.get(window.location.origin+'/user/cart/calculate_distance/'+e.target.value).then(res => {
                if(typeof res !== 'undefined')
                {
                    document.getElementById('delivery_value').innerText = `$ ${res.data}`
                    document.getElementById('delivery_total').innerText = `$ ${Number(res.data) + Number(document.getElementById('subtotal').innerText.slice(1))}`
                }
            })
        }
    })
})


