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


var atBody = $('#admin-table tbody')

atBody.addEventListener("load", loadAdmins())

function htmlAdminRow(userID, firstName, lastName, username, userRole, emailAddress, expiry)
{
    var row = `<tr>
    <td>${firstName}</td>
    <td>${lastName}</td>
    <td>${username}</td>`;

    if(userRole == "superadmin")
    {
        row += '<td><span class="badge bg-primary px-2">Super Admin</span></td>';
    }
    else if (userRole == "admin")
    {
        row += '<td><span class="badge bg-danger px-2">Admin</span></td>';
    }
    else{
        row+='<td><span class="badge bg-success px-2">'+userRole+'</span></td>';
    }
    row += '<td>'+emailAddress+'</td>';
    
    if(expiry == "9999-12-31"){
        row+='<td>X</td>';
    }
    else
    {
        row+='<td>'+expiry+'</td>';
    }

    row+=
    `<td>
        <div class = "d-flex">
            <a type="button" href="/edit-admin?adminID=${userID}" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="Edit User">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
            <button type="button" onclick= "deleteAdmin(${userID})" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Delete User">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
        </td>
    </tr>`;

    return row;
}

function deleteAdmin(adminID){
    let url = '/delete-admin';
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax({
        url: url,
        type:"POST",
        dataType: 'json',
        data:{
            adminID: adminID
        },
        success:function(response){
            loadAdmins();
        },
        error: function (data) {
           alert('Unable to Delete Admin, An Error Occur');
           console.log(data);
        }
    });
}

function loadAdmins(){
    const xhr = new XMLHttpRequest();

    xhr.open('GET', '/get-admins', true);

    xhr.onprogress = function(){
        atBody.append(spinner);
    }

    xhr.onload = function(){
        var adminList = JSON.parse(this.responseText);
        tbodyInnerHTML = "";
        for(key in adminList)
        {
            admin = adminList[key];
            adminRow = htmlAdminRow(admin.adminID, admin.firstname, admin.lastname, admin.username, admin.userrole, admin.email, admin.expiryDate);
            tbodyInnerHTML  += adminRow;
        }
        atBody.html(tbodyInnerHTML);
    }

    xhr.send();
}
