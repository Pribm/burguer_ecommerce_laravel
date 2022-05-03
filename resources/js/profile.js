const axios = require('axios').default;

let addressFormId = 0;

document.addEventListener("DOMContentLoaded", function(event) {
    new window.Cleave('.zipcode', {
        numericOnly: true,
        delimiter: '-',
        blocks: [5,3]
    })

    let phones = document.getElementsByClassName('phone')
    phones = [...phones]

    phones.forEach(phone => {
        new window.Cleave(phone, {
            numericOnly: true,
            delimiters: ['(',')','-'],
            blocks: [3,3,3,4],
            prefix: '+1 '
        })
    });

    //Insert Events in first input group
    checkZipcode(document.getElementById('address-form-0').querySelectorAll('input'), 0)

    document.getElementById('addAddress').addEventListener('click', e => {
        e.preventDefault()
        createAddressForm(addressFormId)
    })

    let addressFormInputs = document.getElementById('address-form-0').querySelectorAll('input')
    addressFormInputs.forEach(input => {
        input.addEventListener('input', e => {
            if(e.target.nextElementSibling !== null && e.target.nextElementSibling.tagName === 'STRONG')
            {
                e.target.nextElementSibling.remove()
            }
        })
    })
});

const createAddressForm = id => {

    let canCreateNewAddress = false

    let addressformBefore = document.getElementById('address-form-'+addressFormId)
    let addressformAfter = addressformBefore.cloneNode(true)


    let formBeforeInputs = addressformBefore.querySelectorAll('input')

    formBeforeInputs.forEach(input => {
        if(input.value !== ''){
            canCreateNewAddress = true
        }else{
            canCreateNewAddress = false
        }
    })

    if(canCreateNewAddress)
    {
        if(document.getElementById('new-address-error-message')){
            document.getElementById('new-address-error-message').remove()
        }

        addressFormId = id+1
        addressformAfter.id = 'address-form-'+addressFormId
        addressformAfter.getElementsByClassName('address-number')[0].innerHTML = addressFormId+1

        let formAfterInputs = addressformAfter.querySelectorAll('input')

        formAfterInputs[0].name = "address["+addressFormId+"]['zipcode']";
        formAfterInputs[1].name = "address["+addressFormId+"]['sublocality']";
        formAfterInputs[2].name = "address["+addressFormId+"]['uf']";
        formAfterInputs[3].name = "address["+addressFormId+"]['city']";
        formAfterInputs[4].name = "address["+addressFormId+"]['country']";
        formAfterInputs[5].name = "address["+addressFormId+"]['house_number']";

        checkZipcode(formAfterInputs, addressFormId-1)
        document.getElementById('address-container').appendChild(addressformAfter)
    }else{
        let error = document.createElement('strong')
        error.classList.add('text-danger')
        error.id = 'new-address-error-message'
        error.innerHTML = 'Your address must be complete to create a new one'
        addressformBefore.after(error)
    }


}

function checkZipcode(nodeList, formIndex){

    new window.Cleave(nodeList[formIndex], {
        numericOnly: true,
        delimiter: '-',
        blocks: [5,3]
    })

    nodeList.forEach(node => {
        node.value = ''
    })

    nodeList[formIndex].addEventListener('input', e => {
        if(nodeList[formIndex].value.length >= 5 && nodeList[formIndex].value.length <= 6)
        {
            axios.get(window.location.href+'/adress?code='+nodeList[formIndex].value).then(res => {

                let inputList = e.target.parentNode.parentNode.parentNode.querySelectorAll('input')
                inputList[1].value = res.data.results[0].address_components[1].long_name
                inputList[2].value = res.data.results[0].address_components[3].long_name
                inputList[3].value = res.data.results[0].address_components[2].short_name
                inputList[4].value = res.data.results[0].address_components[4].long_name
            })
        }

        if(nodeList[formIndex].value.length > 8)
        {
            axios.get(window.location.href+'/adress?code='+nodeList[formIndex].value).then(res => {
                let inputList = e.target.parentNode.parentNode.parentNode.querySelectorAll('input')
                inputList[1].value = res.data.results[0].address_components[1].long_name
                inputList[2].value = res.data.results[0].address_components[3].long_name
                inputList[3].value = res.data.results[0].address_components[2].short_name
                inputList[4].value = res.data.results[0].address_components[4].long_name
            })
        }
    })
}


