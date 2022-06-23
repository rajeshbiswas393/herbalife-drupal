function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePhoneNo(phone)
{
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    return filter.test(String(phone));
}
function activatePage(pageNo)
{
    $('.pageItem').each(function(){
        var pageItemNo = $(this).data('page');

        if($(this).hasClass('active'))
        {
            $(this).removeClass('active')
        }
        if(parseInt(pageItemNo) == pageNo)
        {
            $(this).addClass('active');
        }
    });
}

$(document).ready(function(){
    $(document).on('click','#addNewUser',function(){
        $("#addNewUserModal").modal('show');
        $("#currentUserId").val(0);
        $("#userFullName").val('');
        $("#userEmail").val('');
        $("#userPhone").val('');
        $("#userProfilePictureImage").hide();
    });
    $(document).on('click','#btnSaveUser',function(e){
        e.preventDefault();
        var isValid = true;
        var currentUserId = $("#currentUserId").val();
        var userFullName = $("#userFullName").val();
        if(userFullName =='')
        {
            $("#userFullName").next().html('Please user name');
            isValid = false;
        }
        else
        {
            $("#userFullName").next().html('');
        }
        var userEmail = $("#userEmail").val();
        if(userEmail =='')
        {
            $("#userEmail").next().html('Please user email');
            isValid = false;
        }
        else
        {
            $("#userEmail").next().html('');
            if(!validateEmail(userEmail))
            {
                $("#userEmail").next().html('Please enter a valid email');
                isValid = false;
            }
            else
            {
                $("#userEmail").next().html('');
            }

        }

        var userPhone = $("#userPhone").val();
        if(userPhone =='')
        {
            $("#userPhone").next().html('Please user phone');
            isValid = false;
        }
        else
        {
            $("#userPhone").next().html('');
            if(!validatePhoneNo(userPhone))
            {
                $("#userPhone").next().html('Please enter a valid phone no');
                isValid = false;
            }
            else
            {
                $("#userPhone").next().html('');
            }
        }

        if(!parseInt(currentUserId))
        {
            if ($('#userProfilePicture').get(0).files.length === 0) {
                $("#userProfilePicture").next().html('Please upload a picture');
                isValid = false;
            }
            else
            {
                $("#userProfilePicture").next().html('');
            }
        }
       

        if(!isValid) return false;
        $("#btnSaveUser").prop('disabled',true);
        var formData = new FormData($("#newUserForm")[0]);
        $.ajax({
            url: '/test/save-user',
            type: 'POST',
            data: formData,
            dataType: 'json',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) 
                    {
                       if(parseInt(data.status)==1)
                       {
                           alert('User created successfully! ');
                           window.location.reload();
                       }
                       else
                       {
                           alert('Something went wrong!');
                           $("#btnSaveUser").prop('disabled',false);
                       }
                    },
            error:function()
                    {
                        alert('Something went wrong!');
                        $("#btnSaveUser").prop('disabled',false);
                    }
        
        });
    });

    //Delete user delete_user
    $(document).on('click','.delete_user',function(){
        var id = $(this).data('id');
        var currentItem = $(this);
        var datString ='id='+id;
        if(confirm('Are you sure to delete this user?'))
        {
            currentItem.prop('disabled',true);
            $.ajax({
                url: '/test/delete-user',
                type: 'POST',
                data: datString,
                dataType: 'json',
                success:function(data)
                {
                    if(parseInt(data.status) == 1)
                    {
                        alert('User deleted successfully!');
                        window.location.reload();
                    }
                    else
                    {
                        alert('Something went wrong!');
                        currentItem.prop('disabled',false);
                    }
                },
                error:function()
                {
                    alert('Something went wrong!');
                    currentItem.prop('disabled',false);
                }
        });
    }
    });

    //Edit User
    $(document).on('click','.edit_user',function(){
        var id = $(this).data('id');
        var currentItem = $(this);
        var datString ='id='+id;
        
            currentItem.prop('disabled',true);
            $.ajax({
                url: '/test/get-user-details',
                type: 'POST',
                data: datString,
                dataType: 'json',
                success:function(data)
                {
                    if(parseInt(data.status) == 1)
                    {
                        var userBaseUrl = $("#userBaseUrl").val();
                        $("#currentUserId").val(data.user.id);
                        $("#userFullName").val(data.user.full_name);
                        $("#userEmail").val(data.user.email);
                        $("#userPhone").val(data.user.phone_no);
                        var profilePicturePath = userBaseUrl+'/uploads/'+data.user.picture_path;
                        $("#userProfilePictureImage").attr('src',profilePicturePath);
                        $("#userProfilePictureImage").show();
                        $("#addNewUserModal").modal('show');
                        currentItem.prop('disabled',false);
                    }
                    else
                    {
                        alert('Something went wrong!');
                        currentItem.prop('disabled',false);
                    }
                },
                error:function()
                {
                    alert('Something went wrong!');
                    currentItem.prop('disabled',false);
                }
        });
    });

    //Pagination
    $(document).on('click','.pageItem',function(e){
        e.preventDefault();
        var pageNo = $(this).data('page');
        $("#currentPageNo").val(pageNo);
        var currentItem = $(this);
        var datString ='page='+pageNo;
        currentItem.prop('disabled',true);
        $.ajax({
            url: '/test/load-page-data',
            type: 'POST',
            data: datString,
            dataType: 'json',
            success:function(data)
            {
                var tableDataHtml = '';
                $.each(data.users,function(i,user){
                    tableDataHtml+='<tr>';
                    $.each(user,function(key,val){
                        if(key =='id')
                        {
                            user_id = val;
                        }
                        if(key =='full_name')
                        {
                            full_name = val;
                        }
                        if(key =='email')
                        {
                            email = val;
                        }
                        if(key =='phone_no')
                        {
                            phone_no = val;
                        }
                    });
                    tableDataHtml+='<td>#'+user_id+'</td>';
                    tableDataHtml+='<td>'+full_name+'</td>';
                    tableDataHtml+='<td>'+email+'</td>';
                    tableDataHtml+='<td>'+phone_no+'</td>';
                    tableDataHtml+='<td>';
                        tableDataHtml+='<button class="view_user btn" data-id="'+user_id+'" title="View"><i class="far fa-eye" aria-hidden="true"></i></button>'
                        tableDataHtml+='<button class="edit_user btn" data-id="'+user_id+'" title="Edit"><i class="far fa-edit" aria-hidden="true"></i></button>';
                        tableDataHtml+='<button class="delete_user btn" data-id="'+user_id+'" title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button>';
                    tableDataHtml+='</td>';
                    tableDataHtml+='</tr>';
                });
                $("#userTableContent").html(tableDataHtml);
                activatePage(pageNo);
                currentItem.prop('disabled',false);
            },
            error:function()
                {
                    alert('Something went wrong!');
                    currentItem.prop('disabled',false);
                }

        });
    });

    $(document).on('click','.btnNext',function(e){
        e.preventDefault();
        var currentPageNo =  parseInt($("#currentPageNo").val());
        var maxPageNo = parseInt($("#maxPageNo").val());
        if(maxPageNo > currentPageNo)
        {
            currentPageNo++;
            $("#currentPageNo").val(currentPageNo);
            pageNo = currentPageNo;
        }
        else
        {
            return false;
        }
        var currentItem = $(this);
        var datString ='page='+pageNo;
        currentItem.prop('disabled',true);
        $.ajax({
            url: '/test/load-page-data',
            type: 'POST',
            data: datString,
            dataType: 'json',
            success:function(data)
            {
                var tableDataHtml = '';
                $.each(data.users,function(i,user){
                    tableDataHtml+='<tr>';
                    $.each(user,function(key,val){
                        if(key =='id')
                        {
                            user_id = val;
                        }
                        if(key =='full_name')
                        {
                            full_name = val;
                        }
                        if(key =='email')
                        {
                            email = val;
                        }
                        if(key =='phone_no')
                        {
                            phone_no = val;
                        }
                    });
                    tableDataHtml+='<td>#'+user_id+'</td>';
                    tableDataHtml+='<td>'+full_name+'</td>';
                    tableDataHtml+='<td>'+email+'</td>';
                    tableDataHtml+='<td>'+phone_no+'</td>';
                    tableDataHtml+='<td>';
                        tableDataHtml+='<button class="view_user btn" data-id="'+user_id+'" title="View"><i class="far fa-eye" aria-hidden="true"></i></button>'
                        tableDataHtml+='<button class="edit_user btn" data-id="'+user_id+'" title="Edit"><i class="far fa-edit" aria-hidden="true"></i></button>';
                        tableDataHtml+='<button class="delete_user btn" data-id="'+user_id+'" title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button>';
                    tableDataHtml+='</td>';
                    tableDataHtml+='</tr>';
                });
                $("#userTableContent").html(tableDataHtml);
                currentItem.prop('disabled',false);
                activatePage(currentPageNo);
            },
            error:function()
                {
                    alert('Something went wrong!');
                    currentItem.prop('disabled',false);
                }

        });
    });

    $(document).on('click','.btnPrev',function(e){
        e.preventDefault();
        var currentPageNo =  parseInt($("#currentPageNo").val());
        var maxPageNo = parseInt($("#maxPageNo").val());
        if(currentPageNo >1)
        {
            currentPageNo--;
            $("#currentPageNo").val(currentPageNo);
            pageNo = currentPageNo;
        }
        else
        {
            return false;
        }
        var currentItem = $(this);
        var datString ='page='+pageNo;
        currentItem.prop('disabled',true);
        $.ajax({
            url: '/test/load-page-data',
            type: 'POST',
            data: datString,
            dataType: 'json',
            success:function(data)
            {
                var tableDataHtml = '';
                $.each(data.users,function(i,user){
                    tableDataHtml+='<tr>';
                    $.each(user,function(key,val){
                        if(key =='id')
                        {
                            user_id = val;
                        }
                        if(key =='full_name')
                        {
                            full_name = val;
                        }
                        if(key =='email')
                        {
                            email = val;
                        }
                        if(key =='phone_no')
                        {
                            phone_no = val;
                        }
                    });
                    tableDataHtml+='<td>#'+user_id+'</td>';
                    tableDataHtml+='<td>'+full_name+'</td>';
                    tableDataHtml+='<td>'+email+'</td>';
                    tableDataHtml+='<td>'+phone_no+'</td>';
                    tableDataHtml+='<td>';
                        tableDataHtml+='<button class="view_user btn" data-id="'+user_id+'" title="View"><i class="far fa-eye" aria-hidden="true"></i></button>'
                        tableDataHtml+='<button class="edit_user btn" data-id="'+user_id+'" title="Edit"><i class="far fa-edit" aria-hidden="true"></i></button>';
                        tableDataHtml+='<button class="delete_user btn" data-id="'+user_id+'" title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button>';
                    tableDataHtml+='</td>';
                    tableDataHtml+='</tr>';
                });
                $("#userTableContent").html(tableDataHtml);
                activatePage(currentPageNo);
                currentItem.prop('disabled',false);
            },
            error:function()
                {
                    alert('Something went wrong!');
                    currentItem.prop('disabled',false);
                }

        });
    });
});