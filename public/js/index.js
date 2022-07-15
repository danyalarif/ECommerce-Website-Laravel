let userButton = document.getElementById('userButton')
let adminButton = document.getElementById('adminButton')
userButton.onclick = () => {
    window.open('/auth', '_self')
}

adminButton.onclick = () => {
    window.open('/admin-home', '_self')
}