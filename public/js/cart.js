let itemsContainer = document.getElementsByClassName('items-container')[0]

let cartEmptyButton = document.getElementsByClassName('cart-empty-button')[0]

let checkoutButton = document.getElementById('checkoutButton')

let products = JSON.parse(localStorage.getItem("products") || "[]")

for (const product of products){
    let p = createCartItem(product['name'], product['category'], product['subCategory'], product['image'], product['quantity'], product['price'], product['fee'])
    itemsContainer.appendChild(p)
}

updateCheckout()

handleCartItemDeletion()

cartEmptyButton.onclick = emptyCart

checkoutButton.onclick = (event) => {
    event.preventDefault()
    submitCart()
}

function handleCartItemDeletion(){
    let deleteButtons = document.getElementsByClassName('cart-delete-button')
    for (let i = 0; i < deleteButtons.length; i++){
        deleteButtons[i].onclick = () => {
            deleteCartProduct(i)
        }
    }
}

function deleteCartProduct(index){
    //delete the product from array which is maintained using cookies
    let items = document.querySelectorAll('.items-container > div')
    items[index].remove();
    //deleting from array
    products.splice(index, 1)
    //updating local storage
    localStorage.setItem("products", JSON.stringify(products));
    updateCheckout()
}

function submitCart(){
    //retrieving product ids and quantity
    productids = []
    productquantities = []
    for (let product of products){
        productids.push(product['id'])
        productquantities.push(product['quantity'])
    }
    let total = parseInt(document.getElementById('total').innerText.trim())
    let url = '/cart';
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax({
        url: url,
        type:"POST",
        dataType: 'json',
        data:{
            productids: productids,
            productquantities: productquantities,
            total: total
        },
        success:function(response){
            if (response === 'insufficient balance'){
                alert('Insufficient balance')
                return
            }
            localStorage.removeItem('products')
            window.open('/orders', '_self')
        },
        error: function (data) {
            //console.log('Error:', data);
            console.log(data)
            console.log(JSON.stringify(data))
        }
    });
}

function updateCheckout(){
    totalSpan = document.getElementById('total')
    subtotalSpan = document.getElementById('subtotal')
    feeSpan = document.getElementById('fee')
    subtotal = 0
    fee = 0
    for (const product of products){
        subtotal += (parseInt((product['price'])) * parseInt((product['quantity'])))
        fee += parseInt(product['fee'])        
    }
    total = subtotal + fee
    totalSpan.innerText = total
    feeSpan.innerText = fee
    subtotalSpan.innerText = subtotal
    let totalItems = document.getElementsByClassName('cart-count')[0]
    totalItems.innerText = products.length
}

function emptyCart(){
    let items = document.querySelectorAll('.items-container > div')
    for (i = 0;i < items.length; i++){
        items[i].remove()
    }
    products = []
    localStorage.setItem("products", JSON.stringify(products));
    updateCheckout()
}

function createCartItem(name, category, subcategory, image, quantity, price, fee){
    //dynamically creating the cart item div and its contents
    let parentDiv = document.createElement('div')
    parentDiv.classList.add('row', 'item-container')

    let headerDiv = document.createElement('div')
    headerDiv.classList.add('col-12', 'item-header')
    let spanone = document.createElement('span')
    let spantwo = document.createElement('span')
    let spanthree = document.createElement('span')
    spanone.classList.add('product-title')
    spantwo.classList.add('product-category')
    spanthree.classList.add('product-sub-category')
    spanone.innerText = name
    spantwo.innerText = category
    spanthree.innerText = subcategory
    headerDiv.append(spanone, spantwo, spanthree)

    let imageDiv = document.createElement('div')
    let imageContainer = document.createElement('div')
    let img = document.createElement('img')
    imageDiv.classList.add('col-12', 'col-sm-4', 'product-image-div')
    imageContainer.classList.add('image-container')
    img.setAttribute('src', image)
    imageContainer.appendChild(img)
    imageDiv.appendChild(imageContainer)

    let dataContainer = document.createElement('div')
    dataContainer.classList.add('col-12', 'col-sm-5', 'product-data-container', 'align-self-center')
    let quantityContainer = document.createElement('div')
    quantityContainer.classList.add('quantity-container')
    let span1 = document.createElement('span')
    let span2 = document.createElement('span')
    span1.innerText = 'Quantity x '
    span2.innerText = quantity
    span2.classList.add('quantity')
    quantityContainer.append(span1, span2)
    let priceContainer = document.createElement('div')
    priceContainer.classList.add('price-container')
    let span6 = document.createElement('span')
    let span7 = document.createElement('span')
    span6.innerText = 'Rs. '
    span7.innerText = price
    span7.classList.add('price')
    priceContainer.append(span6, span7)
    let feeContainer = document.createElement('div')
    feeContainer.classList.add('fee-container')
    let span3 = document.createElement('span')
    let span4 = document.createElement('span')
    let span5 = document.createElement('span')
    span3.innerText = 'Rs. '
    span4.innerText = fee
    span4.classList.add('price')
    span5.innerText = ' (shipping fee)'
    feeContainer.append(span3, span4, span5)
    dataContainer.append(quantityContainer, priceContainer, feeContainer)
    
    let deleteContainerDiv = document.createElement('div')
    deleteContainerDiv.classList.add('col-12', 'col-sm-3', 'product-delete-container', 'align-self-center')
    let deleteContainer = document.createElement('div')
    deleteContainer.classList.add('product-delete-button-container')
    let button = document.createElement('button')
    button.classList.add('cart-delete-button', 'custom-button-rounded')
    button.innerText = 'DELETE'
    deleteContainer.append(button)
    deleteContainerDiv.append(deleteContainer)

    parentDiv.append(headerDiv, imageDiv, dataContainer, deleteContainerDiv)
    return parentDiv
}