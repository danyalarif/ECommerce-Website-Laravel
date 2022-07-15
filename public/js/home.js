
window.onload = () => {
    handleCategoriesClick()
    handleProductClick()
    //handling cart click
    let cartDiv = document.getElementsByClassName('cart-container')
    for (let i = 0;i < cartDiv.length; i++)
    {
        cartDiv[i].onclick = function(e){
            e.stopPropagation()
            addProductToCart(i)
        }
    }

    //handling wishlist click
    let wishlistDiv = document.getElementsByClassName('wishlist-container')
    for (let i = 0;i < wishlistDiv.length; i++)
    {
        wishlistDiv[i].onclick = function(e){
            e.stopPropagation();
            addProductToWishlist(i)
        }
    }
}



function addProductToCart(index){
    let p = document.getElementsByClassName('product-container')[index]
    let id = p.id
    let name = document.getElementsByClassName('product-name')[index].innerHTML
    let image = document.getElementsByClassName('product-image')[index].getAttribute('src')
    let quantity = 1
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
    if (products.some(e => e.id === product.id)) {
        return
    } 
    products.push(product)
    localStorage.setItem("products", JSON.stringify(products));
    document.getElementById('lblCartCount').innerText = products.length
}

function addProductToWishlist(index){
    let p = document.getElementsByClassName('product-container')[index].id
    let url = '/wishlist';
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax({
        url: url,
        type:"POST",
        dataType: 'json',
        data:{
            productid: p
        },
        success:function(response){
          if (response === 'success'){
          }
        },
        error: function (data) {
            //console.log('Error:', data);
            console.log('An error occurred')
        }
    });
}

function handleCategoriesClick(){
    let selectedCategory = null
    const categoriesTags = document.querySelectorAll('#categories-dropdown a')
    for (let link of categoriesTags)
    {
        link.onclick = () => {
            selectedCategory = link.innerHTML
            let newPage = 'category?category=' + selectedCategory      //passing the selected category as a query string to the next page
            window.open(newPage, '_self')
        }
    }
}

function handleProductClick(){
    let selectedProduct = null
    const products = document.getElementsByClassName('product-container')
    for (let product of products)
    {
        product.onclick = () => {
            //selectedProduct = product.getElementsByClassName('product-name')[0].innerHTML
            //let newPage = 'products?product=' + selectedProduct      //passing the selected category as a query string to the next page
            let newPage = 'products?productid=' + product.id
            window.open(newPage, '_self')
        }
    }
}



let cartButtons = document.getElementsByClassName('cart-container')
for (let i = 0; i < cartButtons.length; i++){
    cartButtons[i].addEventListener('click', function(e){
        if (cartButtons[i].classList.contains('rotate'))
            cartButtons[i].classList.remove('rotate')
        cartButtons[i].classList.add('rotate')
    })
}

let wishlistButton = document.getElementsByClassName('wishlist-container')
for (let i = 0; i < wishlistButton.length; i++){
    wishlistButton[i].addEventListener('click', function(e){
        if (wishlistButton[i].classList.contains('rotate'))
        wishlistButton[i].classList.remove('rotate')
        wishlistButton[i].classList.add('rotate')
    })
}