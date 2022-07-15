
let inputForm = document.getElementsByClassName('input-form')[0]

let passwordForm = document.getElementById('forgetPasswordForm')

inputForm.onsubmit = (event) => {
    localStorage.removeItem('products')
}

passwordForm.onsubmit = (event) => {
    if (document.getElementsByName('newPassword')[0].value.trim() !== document.getElementsByName('newConfirmPassword')[0].value.trim()){
        event.preventDefault()
    }
}



