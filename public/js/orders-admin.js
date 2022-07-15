var spinner = 
'<tr>'+
    '<td colspan = "7">'+
        '<div class="d-flex justify-content-center">'+
            '<div class="spinner-grow text-danger" role="status">'+
                '<span class="sr-only">Loading...</span>'+
            '</div>'+
        '</div>'+
    '</td>'+
'</tr>';


var atBody = $('#order-table tbody')

atBody.addEventListener("load", loadOrders())

function htmlOrderRow(orderID, productList, status, orderOn, recievedOn, sellingPrice, customerName)
{
    var row = `
    <tr>
    <td>${orderID}</td>
    <td>${productList}</td>`;

    if(status == "processing")
    {
        row += '<td><span class="badge bg-danger px-2">Processing</span></td>';
    }
    else if (status == "shipping")
    {
        row += '<td><span class="badge bg-primary px-2">Shipping</span></td>';
    }
    else{
        row+='<td><span class="badge bg-success px-2">Recieved</span></td>';
    }

    row += `<td>${orderOn}</td>
    <td>${recievedOn}</td>
    <td>Rs. ${parseFloat(sellingPrice).toFixed(2)}</td>
    <td>${customerName}</td>
    </tr>`;

    return row;
}
function getStatus(orderOn, recievedOn){
    var status;
    var _1DayinMili = 86400000;
    if(Date.now() < _1DayinMili + Date.parse(orderOn)){
        status = "processing";
    }
    else if(Date.now() > Date.parse(recievedOn)){
        status = "recieved";
    }
    else{
        status = "shipping";
    }

    return status
}
function loadOrders(){
    const xhr = new XMLHttpRequest();

    xhr.open('GET', '/get-orders', true);

    xhr.onprogress = function(){
        atBody.append(spinner);
    }

    xhr.onload = function(){
        var ordersList = JSON.parse(this.responseText);
        tbodyInnerHTML = "";
        for(key in ordersList)
        {
            var order = ordersList[key];
            order.status = getStatus(order.orderOn, order.recieveOn);
            adminRow = htmlOrderRow(order.id, order.productList, order.status, order.orderOn, order.recieveOn, order.sellingPrice, order.customerName);
            tbodyInnerHTML  += adminRow;
        }
        atBody.html(tbodyInnerHTML);
    }

    xhr.send();
}
