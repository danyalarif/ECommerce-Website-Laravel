
let loginButton = document.getElementById('loginButton')
let registerButton = document.getElementById('registerButton')
validateInput()

const pattrens = {
    name : /[A-Za-z\s]{4,20}/,
    email: /([A-Za-z0-9\.#$]{5,})@([a-z]+)\.([a-z]+)/,
    password: /(?=.*[A-Za-z]+)(?=.*[0-9]+)(?=.*[!@#$%&^*]+)(?=.*[A-Za-z0-9!@#$%&^*]{10,})/,
    mobileNumber: /[0-9]{11}/
}

const validationText = {
    name: [document.getElementById('name-validator'), 'Invalid Name, can only contain letters'],
    email: [document.getElementById('email-validator'), 'Invalid email'],
    password: [document.getElementById('password-validator'), 'Password must contain atleast one letter, digit and symbol'],
    confirmPassword: [document.getElementById('confirmPassword-validator'), 'Passwords do not match'],
    mobileNumber: [document.getElementById('mobileNumber-validator'), 'Invalid Mobile number']
}

registerButton.onclick = (event) =>{
    validateUserRegistration(event)
} 

function validateInput(){
    let name = document.getElementById('name')
    let email = document.getElementById('email')
    let password = document.getElementById('password')
    let confirmPassword = document.getElementById('confirmPassword')
    let mobileNumber = document.getElementById('mobileNumber')
    name.onkeyup = () => {validateField('name', name)}
    email.onkeyup = () => {validateField('email', email)}
    password.onkeyup = () => {validateField('password', password)}
    confirmPassword.onkeyup = () => {
        const para = validationText['confirmPassword'][0]
        if (password.value.trim() === confirmPassword.value.trim()){
            para.innerText = ''
        }
        else{
            para.innerText = validationText['confirmPassword'][1]
        }
    }
    mobileNumber.onkeyup = () => {validateField('mobileNumber', mobileNumber)}

}

function validateUserRegistration(event){
    resetForm()
    //getting data
    let name = document.getElementById('name')
    let email = document.getElementById('email')
    let password = document.getElementById('password')
    let confirmPassword = document.getElementById('confirmPassword')
    let mobileNumber = document.getElementById('mobileNumber')
    let address = document.getElementById('address').value
    let res1 = validateField('name', name)
    let res2 = validateField('email', email)
    let res3 = validateField('password', password)
    let res4 = validateField('mobileNumber', mobileNumber)
    let res5 = password.value.trim() === confirmPassword.value.trim()
    if (!res5){
        const para = validationText['confirmPassword'][0]
        para.innerText = validationText['confirmPassword'][1]
    }
    if (!(res1) || !(res2) || !(res3) || !(res4) || !(res5)){
        event.preventDefault()
    }
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

function resetForm(){
    for (let i in validationText){
        validationText[i][0].innerText = ' '
    }
}

loginButton.onclick = () => {
    window.open('login', '_self')
}