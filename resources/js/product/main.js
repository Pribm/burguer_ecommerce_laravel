document.getElementById('inputFile').addEventListener('click', changeIputFile)
document.getElementById('files').addEventListener('change', readFileInput)

function changeIputFile(e){
    e.currentTarget.childNodes[5].click()
}

function readFileInput(e){
    //Text Input
    document.getElementById('inputFile').childNodes[3].value = e.target.files[0].name
    document.getElementById('inputFile').childNodes[3].name = ''

    //Input File
    e.currentTarget.parentNode.childNodes[5].name = 'image'
    console.log(e.target.files)
}
