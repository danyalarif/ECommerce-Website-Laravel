let depositButton = document.getElementsByClassName('deposit-button')[0]
let submitButton = document.getElementsByClassName('deposit-submit-button')[0]
let creditButton = document.getElementsByClassName('add-card-button')[0]
depositButton.onclick = () => {
    let isCredit = parseInt(document.getElementById('isCredit').innerText.trim())
    if (isCredit == 0){
        alert('Credit card not found!')
        return
    }
    let depositDiv = document.getElementsByClassName('deposit-amount-container')[0]
    depositDiv.style.display = 'block'
}

submitButton.onclick = (event) => {
    let amount = document.getElementById('amount').value
    if (!(verifyAmount(amount))){
        event.preventDefault()      //if invalid
        let para = document.getElementsByClassName('amount-validator')[0]
        para.innerText = 'Invalid amount!'
    }
}

creditButton.onclick = () =>{
    let isCredit = parseInt(document.getElementById('isCredit').innerText.trim())
    if (isCredit == 1){
        alert('Credit card already added!')
        return
    }
    window.open('creditcard', '_self')
}

function verifyAmount(amount){
    let amountRegex = /[0-9]{1,}/
    let res = amountRegex.test(amount)
    return res
}