const navDropdown = document.getElementById('nav-dropdown')
const verticalNavbar = document.querySelectorAll('nav')[0]
const dropdownArrow = document.querySelector('#dropdown-arrow')
let showNavbar = false

let dropdownIsVisible = false

navDropdown.addEventListener('click', () => {
showNavbar = !showNavbar
if(showNavbar){
    verticalNavbar.childNodes[3].style = `
    top: 50px;
    `
    dropdownArrow.style.transform = `
    rotate(180deg)
    `
}else{
    verticalNavbar.childNodes[3].style = `
    top: -10000px;
    `

    dropdownArrow.style.transform = `
    rotate(0deg)
    `
}
})

function showDropdown(dropdownName)
{
    dropdownIsVisible = !dropdownIsVisible
    if(dropdownIsVisible){
        document.getElementById(dropdownName).style = `
        display: flex;
        flex-direction: column;
        `

        //Dropdown arrow Element
        document.getElementById(dropdownName).previousElementSibling.childNodes[3].style.transform = `
        rotate(-180deg)
        `


    }else{
        document.getElementById(dropdownName).style = `
        display: none;
        `

        //Dropdown arrow Element
        document.getElementById(dropdownName).previousElementSibling.childNodes[3].style.transform = `
        rotate(0deg)
        `
    }
}