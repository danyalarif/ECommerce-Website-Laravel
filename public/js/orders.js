let sentDates = document.getElementsByClassName('order-sent')
let recieveDates = document.getElementsByClassName('order-recieve')
let stats = document.getElementsByClassName('order-stats')

for (let i = 0; i < stats.length; i++){
    let d1 = new Date(sentDates[i].innerText.trim())
    let d2 = new Date(recieveDates[i].innerText.trim())
    if (d1 <= d2){
        stats[i].innerText = 'Shipped'
    }
    else{
        stats[i].innerText = 'Recieved'
    }
}