window.onload = () => {
    let cartButton = document.getElementsByClassName('cart-button')
    for (let i = 0;i < cartButton.length; i++)
    {
        cartButton[i].onclick = () => {
            addProductToCart(i)
        }
    }

    let addall = document.getElementById('add-all-to-cart')
    addall.onclick = () => {
        for (let i = 0; i < cartButton.length; i++){    //adding all items to cart
            addProductToCart(i)
        }   
    }

    let deleteButton = document.getElementsByClassName('delete-button')
    for (let i = 0;i < deleteButton.length; i++)
    {
        deleteButton[i].onclick = () => {
            deleteProduct(i)
        }
    }
    updateCount()
}

function deleteProduct(index){
    let p = document.getElementsByClassName('item-container')[index]
    pid = p.id
    let url = '/deleteWishlist';
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax({
        url: url,
        type:"POST",
        dataType: 'json',
        data:{
            productid: pid
        },
        success:function(response){
            p.remove()
            updateCount()
        },
        error: function (data) {
            //console.log('Error:', data);
            console.log('An error occurred')
        }
    });
}

function addProductToCart(index){
    let p = document.getElementsByClassName('item-container')[index]
    let id = p.id
    let name = document.getElementsByClassName('product-title')[index].innerHTML
    let image = document.getElementsByClassName('product-image')[index].getAttribute('src')
    let quantity = 1
    let price = document.getElementsByClassName('product-price')[index].innerText
    let fee = Math.floor(Math.random() * (100 - 50) ) + 50;
    let category = document.getElementsByClassName('product-category')[index].innerText
    let subCategory = document.getElementsByClassName('product-sub-category')[index].innerText
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
}

function updateCount(){
    let temp = document.getElementsByClassName('item-container')
    let total = temp.length
    countSpan = document.getElementById('total')
    countSpan.innerText = total
}