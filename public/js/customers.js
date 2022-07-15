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


var atBody = $('#customer-table tbody')

atBody.addEventListener("load", loadCustomers())

function htmlCustomerRow(userID, userName, userEmail, noOrders, purchases, noReviews)
{
    var row = 
    `<tr>
    <td>${userName}</td>
    <td>${userEmail}</td>
    <td>${noOrders}</td>
    <td>Rs. ${parseFloat(purchases).toFixed(2)}</td>
    <td>${noReviews}</td>
    </tr>`;

    return row;
}
function loadCustomers(){
    const xhr = new XMLHttpRequest();

    xhr.open('GET', '/get-customers', true);

    xhr.onprogress = function(){
        atBody.append(spinner);
    }

    xhr.onload = function(){
        var customersList = JSON.parse(this.responseText);
        tbodyInnerHTML = "";
        for(key in customersList)
        {
            var customer = customersList[key];
            customerRow = htmlCustomerRow(customer.idUser, customer.name, customer.email, customer.noOrders, customer.purchases, customer.noReviews);
            tbodyInnerHTML  += customerRow;
        }
        atBody.html(tbodyInnerHTML);
    }

    xhr.send();
}