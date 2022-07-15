let loadMoreButton = document.getElementById('loadMore')

loadMoreButton.onclick = () => {
    let items = document.getElementsByClassName('product-container')
    let startPosition = items.length + 1
    let endPosition = startPosition + 3
    loadProduct(startPosition, endPosition)
}

function loadProduct(start, end){
    let category = document.getElementsByClassName('product-category')
    if (category == null)
        return
    let errorPara = document.getElementById('moreproductserror')
    errorPara.innerText = ''
    category = category[0].innerText.trim()
    let url = 'loadProducts?category='+category+'&start='+start+'&end='+end
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response){
            if (response.length == 0){
                errorPara.innerText = 'No more products to load!'
                return
            }
            for (let i = 0; i < response.length; i++){
                let r = response[i]
                addProductToContainer(r.idProducts, r.image, r.title, r.categoryName, r.name, r.producingCost, r.profit, r.totalReviews, r.averageStars, i + start - 1)
            }
        }
    });
}
function addProductToContainer(idProducts, image, title, categoryName, name, producingCost, profit, totalReviews, averageStars, start){
    let container = document.getElementsByClassName('product-row')[0]
    container.innerHTML += `
    <div class="product-container product-main col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2" id="${idProducts}">
					<div class="product">
						<div class="product-image-container">
							<img class="product-image" src="${image}">
						</div>
						<div class="product-body">
							<div class="product-category-container">
								<a href="${'category?category=' + title}" class="product-category">${title}</a>
								<span class="product-mainCategory" style="display: none;" hidden>${categoryName}</span>
							</div>
							<div class="product-name-container">
								<span class="product-name">${name}</span>
							</div>
							<div class="product-price-container">
								<span class="product-price-label">Rs.</span>
								<span class="product-price">${producingCost + (producingCost * (profit / 100))}</span>
							</div>
							<div class="product-rating-container">
								<span>(</span><span class="product-rating-count">${totalReviews}</span><span>)</span> 
							</div>
							<div class="product-footer-container">
								<div class="cart-container">
									<svg class="mu-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"></path></svg>
									<span>CART</span>
								</div>
								<div class="wishlist-container">
									<svg class="mu-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path></svg>
									<span>WISHLIST</span>
								</div>
							</div>
						</div>
					</div>
				</div>
    `
    //adding rating stars dynamically
    let stars = []
    let starContainer = document.getElementsByClassName('product-rating-container')[start]     //selecting current rating container
    for (let i = 0; i < 5; i++){
        stars[i] = document.createElement('i')
        stars[i].classList.add('fa', 'fa-star')
    }
    for (let i = 0; i < averageStars;i++){
        stars[i].classList.add('fa-fill')
    }
    stars.reverse()
    for (let i = 0; i < 5; i++){
        starContainer.prepend(stars[i])
    }
}