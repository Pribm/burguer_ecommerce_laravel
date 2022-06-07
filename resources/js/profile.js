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
            prefix: '+1 ',
            noImmediatePrefix: true
        })
    });


    let addressForms = document.querySelectorAll('.address_form')
    addressForms.forEach(addressForm => {
        checkZipcode(addressForm.querySelectorAll('input'), 0)
        addressFormId = parseInt(addressForm.id.replace('address-form-', ''))

    })

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

        //Clear the input address clone
        formAfterInputs.forEach(input => input.value = '')


        formAfterInputs[0].name = "address["+addressFormId+"][zipcode]";
        formAfterInputs[1].name = "address["+addressFormId+"][sublocality]";
        formAfterInputs[2].name = "address["+addressFormId+"][uf]";
        formAfterInputs[3].name = "address["+addressFormId+"][city]";
        formAfterInputs[4].name = "address["+addressFormId+"][country]";
        formAfterInputs[5].name = "address["+addressFormId+"][house_number]";
        formAfterInputs[6].name = "address["+addressFormId+"][id]";
        formAfterInputs[formAfterInputs.length-1].value = 'undefined'
        checkZipcode(formAfterInputs, 0)
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

    nodeList[formIndex].addEventListener('input', e => {
        if(nodeList[formIndex].value.length >= 5 && nodeList[formIndex].value.length <= 6)
        {
            axios.get(window.location.href+'/adress?code='+nodeList[formIndex].value).then(res => {
                let inputList = e.target.parentNode.parentNode.parentNode.querySelectorAll('input')
                if(res.data.status === 'OK'){
                    inputList[0].classList.remove('is-invalid')

                    inputList[1].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('route')).length !== 0 ? res.data.results[0].address_components.filter(address_component => address_component.types.includes('route'))[0].long_name +' ,' : ''} ${res.data.results[0].address_components.filter(address_component => address_component.types.includes('sublocality'))[0].long_name}`
                    inputList[2].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_1'))[0].short_name}`
                    inputList[3].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_2'))[0].long_name}`
                    inputList[4].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('country'))[0].long_name}`
                }else{

                    inputList[0].classList.add('is-invalid')

                    inputList[1].value = ''
                    inputList[2].value = ''
                    inputList[3].value = ''
                    inputList[4].value = ''
                }
            })
        }

        if(nodeList[formIndex].value.length > 8)
        {
            axios.get(window.location.href+'/adress?code='+nodeList[formIndex].value).then(res => {
                let inputList = e.target.parentNode.parentNode.parentNode.querySelectorAll('input')
                if(res.data.status === 'OK'){
                    inputList[1].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('route')).length !== 0 ? res.data.results[0].address_components.filter(address_component => address_component.types.includes('route'))[0].long_name +' ,' : ''} ${res.data.results[0].address_components.filter(address_component => address_component.types.includes('sublocality'))[0].long_name}`
                    inputList[2].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_1'))[0].short_name}`
                    inputList[3].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('administrative_area_level_2'))[0].long_name}`
                    inputList[4].value = `${res.data.results[0].address_components.filter(address_component => address_component.types.includes('country'))[0].long_name}`
                }else{
                    inputList[0].classList.add('is-invalid')

                    inputList[1].value = ''
                    inputList[2].value = ''
                    inputList[3].value = ''
                    inputList[4].value = ''
                }
            })
        }
    })
}

document.getElementById('upload_avatar_button').addEventListener('click', e => {
    e.preventDefault()
    document.getElementById('avatar_input').click()
})

document.getElementById('avatar_input').addEventListener('change', e => {

    let formData = new FormData()
    formData.append('avatar', e.target.files[0])
    axios.post(window.location.href+'/changeAvatar',formData).then(res => {
        if(res.data.avatar){
            if(document.getElementById('avatar_field')){
                document.getElementById('avatar_field') && document.getElementById('avatar_field').remove()
                let imageElement = document.createElement('img')
                imageElement.src = window.location.origin+'/get-thumbnail/avatars?image='+res.data.avatar
                imageElement.classList.add('rounded-circle')
                imageElement.style = `
                width: 45px;
                height: 45px;
                object-fit: cover;
                `
                imageElement.id = 'user_avatar_image'
                document.getElementById('change_avatar_area').prepend(imageElement)
            }else{
                let imageSrc = document.getElementById('user_avatar_image').src
                imageSrc.replace(/.*image=/g, match => document.getElementById('user_avatar_image').src = match+res.data.avatar)
            }

        }
    })

})
