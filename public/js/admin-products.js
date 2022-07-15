var spinner = 
`<tr>
    <td colspan = "7">
        <div class="d-flex justify-content-center">
            <div class="spinner-grow text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </td>
</tr>`;


var atBody = $('#product-table tbody')

atBody.addEventListener("load", loadProducts())

function htmlProductRow(productID, productName, category, sellingPrice, stockLeft, stockSold, profit)
{
    var row = `<tr>
    <td>${productName}</td>
    <td>${category}</td>
    <td>${sellingPrice}</td>
    <td>${stockLeft}</td>
    <td>${stockSold}</td>
    <td>${profit}</td>
    <td>
        <div class = "d-flex">
            <a href="/edit-product?productID=${productID}" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="Edit User">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
            <button type="button" onclick="deleteProduct(${productID})" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Delete User">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
            </a>
        </div>
    </td>`;

    return row;
}
function getSellingPrice(producingCost, profitCost){
    return producingCost + profitCost;
}

function getProfitCost(producingCost, profit){
    return (producingCost/100)*profit;
}

function getTotalProfit(quantity, profitCost)
{
    return quantity*profitCost;
}

function deleteProduct(productID){
    let url = '/delete-product';
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax({
        url: url,
        type:"POST",
        dataType: 'json',
        data:{
            productID: productID
        },
        success:function(response){
            loadProducts();
        },
        error: function (data) {
           alert('Unable to Delete Product, An Error Occur');
           console.log(data);
        }
    });
}

function loadProducts(){
    const xhr = new XMLHttpRequest();

    xhr.open('GET', '/get-products', true);

    xhr.onprogress = function(){
        atBody.append(spinner);
    }

    xhr.onload = function(){
        var productList = JSON.parse(this.responseText);
        tbodyInnerHTML = "";
        for(key in productList)
        {
            var product = productList[key];
            var name = product.name;
            var category = product.category + ", " + product.subcategory;
            var profitCost = getProfitCost(product.producingCost, product.profitPercentage);
            var sellingPrice = "Rs. " + getSellingPrice(product.producingCost, profitCost);
            var stockLeft = product.stockleft;
            var stocksold = parseInt(product.stocksold);
            var totalProfit = "Rs. " + getTotalProfit(stocksold, profitCost)

            productRow = htmlProductRow(product.id, name, category, sellingPrice, stockLeft, stocksold, totalProfit);
            tbodyInnerHTML += productRow;
        }
        atBody.html(tbodyInnerHTML);
    }

    xhr.send();
}
