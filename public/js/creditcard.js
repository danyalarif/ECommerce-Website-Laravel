
const pattrens = {
    name : /[A-Za-z\s]{4,20}/,
    creditcard: /[0-9]{16}/,
    cvc: /[0-9]{3}/
}

const validationText = {
    name: [document.getElementById('name-validator'), 'Invalid Name, can only contain letters and must be 4-20 in length'],
    creditcard: [document.getElementById('credit-validator'), 'Invalid card number'],
    cvc: [document.getElementById('cvc-validator'), 'invalid cvc'],
    date: [document.getElementById('date-validator'), 'invalid date'],
}

validateInput()

let submitButton = document.getElementsByClassName('submit-button')[0]

submitButton.onclick = (event) => {
    let p = document.getElementsByClassName('validation-para')[0]
    p.innerHTML = ''
    let name = document.getElementById('name').value
    let creditcard = document.getElementById('creditcard').value
    let date = document.getElementById('card-date').value
    let cvc = document.getElementById('cvc').value
    let res1 = pattrens['name'].test(name)
    let res2 = pattrens['creditcard'].test(creditcard)
    let res3 = pattrens['cvc'].test(cvc)
    let today = new Date()
    let currentDate = new Date(date)
    if (today >= currentDate || date.length < 1){
        validationText['date'][0].innerText = validationText['date'][1]
    }
    if (!(res1) || !(res2) || !(res3) || (today >= currentDate) || (date.length < 1)){
        event.preventDefault()
    }
}


function validateInput(){
    let name = document.getElementById('name')
    let creditcard = document.getElementById('creditcard')
    let cvc = document.getElementById('cvc')
    let date = document.getElementById('card-date')
    name.onkeyup = () => {validateField('name', name)}
    creditcard.onkeyup = () => {validateField('creditcard', creditcard)}
    cvc.onkeyup = () => {validateField('cvc', cvc)}

}


function validateField(key, field)
{
    let para = validationText[key][0]
    if (pattrens[key].test(field.value)){
        para.innerText = ''
        return true
    }
    else{
        para.innerText = validationText[key][1]
        return false
    }
}