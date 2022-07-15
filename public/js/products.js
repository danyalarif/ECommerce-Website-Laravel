let counter = document.querySelector('.counter-container .number') 
let decrementButton = document.getElementsByClassName('decrement-button')[0]
let incrementButton = document.getElementsByClassName('increment-button')[0]
let cartButton = document.getElementById('cart-button')
let wishlistButton = document.getElementById('wishlist-button')


wishlistButton.onclick = addProductToWishlist

cartButton.onclick = addProductToCart
incrementButton.onclick = () => {
    updateCounter(1)
}
decrementButton.onclick = () => {
    updateCounter(-1)
}


function updateCounter(value){
    let total = parseInt(document.getElementById('stock').innerText.trim())
    let current = parseInt(counter.innerText)
    if (current + value <= 0 || current + value > total)
        return
    current += value
    counter.innerText = current.toString()
}

function addProductToCart(){
    let index = 0
    const urlParams = new URLSearchParams(window.location.search);
    let id = urlParams.get('productid');
    let name = document.getElementsByClassName('product-name')[index].innerHTML
    let image = document.getElementsByClassName('product-image')[index].getAttribute('src')
    let quantity = parseInt(document.getElementById('quantity').innerText.trim())
    let price = document.getElementsByClassName('product-price')[index].innerText
    let fee = Math.floor(Math.random() * (100 - 50) ) + 50;
    let category = document.getElementsByClassName('product-mainCategory')[index].innerText
    let subCategory = document.getElementsByClassName('product-category')[index].innerText
    product = {
        id: id,
        name: name,
        image: image,
        quantity: quantity,
        price: price,
        fee: fee,
        category: category,
        subCategory: subCategory
    }
    addProductToStorage(product)
}

function addProductToStorage(product){
    products = JSON.parse(localStorage.getItem("products") || "[]")
    products.push(product)
    localStorage.setItem("products", JSON.stringify(products));
    localStorage.setItem("products", JSON.stringify(products));
    document.getElementById('lblCartCount').innerText = products.length
}

function addProductToWishlist(){
    let t = [1, 2, 3, 4, 5]
    const urlParams = new URLSearchParams(window.location.search);
    let p = urlParams.get('productid');
    let url = '/wishlist';
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });
    $.ajax({
        url: url,
        type:"POST",
        dataType: 'json',
        data:{
            test: t,
            productid: p
        },
        success:function(response){
            console.log(response)
          if (response === 'success'){
          }
        },
        error: function (data) {
            console.log(data)
            //console.log('Error:', data);
            console.log('An error occurred')
        }
    });
}
