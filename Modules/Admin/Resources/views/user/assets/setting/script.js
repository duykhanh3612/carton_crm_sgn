$(document).on("click",".createUser",function(){
    $("#modal-create-user").modal('show');
});
$(document).on("click","#createNewUser",function(){
    tag = $("form[name=frmCreateUser]");
    full_name = tag.find("input[name=fullname]").val();
    username = tag.find("input[name=username]").val();
    password = tag.find("input[name=password]").val();

    hasError = false;
    if(full_name == "")
    {
        tag.find("input[name=fullname]").parent().find('.red').removeClass("ng-hide");
        hasError = true;
    }
    else{
        tag.find("input[name=fullname]").parent().find('.red').addClass("ng-hide");
    }
    if(username == "")
    {
        tag.find("input[name=username]").parent().parent().find('.red').removeClass("ng-hide");
        hasError = true;
    }
    else{
        tag.find("input[name=username]").parent().parent().find('.red').addClass("ng-hide");
    }
    if(password == "")
    {
        tag.find("input[name=password]").parent().find('.red').removeClass("ng-hide");
        hasError = true;
    }
    else{
        tag.find("input[name=password]").parent().find('.red').addClass("ng-hide");
    }

    var role = [];
    $(tag.find("input.ace")).each(function(){
        if($(this).prop("checked"))
        {

            role.push($(this).val());
        }
    });
    if(!hasError)
    {
        $.ajax({
            method: "POST",
            url: base_url + "/admin/user/create",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_name: username, full_name : full_name,password:password, role: role
            }
        }).done(function(res) {
            if(res.success)
            {
                location.reload();
            }
    
        });
    }
    

});

$(document).on("click",".openCreatePassword",function(){
    tag = $(this).closest("tr");
    username = tag.find("td:nth-child(1)").find("a").attr("data-value");
    full_name = tag.find("td:nth-child(2)").find("span").attr("data-value");
    $("#modal-change-pass").modal('show');
    $("#modal-change-pass").find('input').attr('data-user',username);
    $("#modal-change-pass").find('.full_name').html(full_name);
});
$(document).on("click","#updatePassword",function(){
    $.LoadingOverlay("show");
    username =  $(this).closest("form").find("input[name=newpassword]").data('user');
    newpassword = $(this).closest("form").find("input[name=newpassword]").val();
    if(newpassword != "")
    {
        $.ajax({
            method: "POST",
            url: base_url + "/admin/user/update-role",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                username: username, newpassword: newpassword
            }
        }).done(function(res) {
            $.LoadingOverlay("hide");
            $("#modal-change-pass").modal('hide');
        });
    }

});

$(document).on("click",".showEdit",function(){
    tag = $(this).closest('tr');
    $("#item-show").html(tag.html());
    username = tag.find("td:nth-child(1)").find("a").attr("data-value");
    full_name = tag.find("td:nth-child(2)").find("span").attr("data-value");
    role = JSON.parse( tag.find("td:nth-child(3)").attr("data-value"));
    active = tag.find("td:nth-child(4)").find("span").attr("data-activated");

    html = $("#item-edit").html();
    tag.html(html);

    tag.find("input[name=username]").val(username);
    tag.find("input[name=full_name]").val(full_name);
    tag.find("input[name=actived]").prop("checked",active==1?true:false);
    $.each(role,function(index, value){
        console.log(value)
        tag.find("input[name=cbUserRole120434][value="+value+"]").prop("checked",true);
    });
});

$(document).on("click",".updateUser",function(){
    tag = $(this).closest('tr');
    $.LoadingOverlay("show");
    username = tag.find("td:nth-child(1)").find("input").val();
    full_name = tag.find("td:nth-child(2)").find("input").val();
    var role = [];
    $(tag.find("td:nth-child(3)").find("input[name=cbUserRole120434]")).each(function(){
        if($(this).prop("checked"))
        {
            role.push($(this).val());
        }
    });
    active = tag.find("td:nth-child(4)").find("input").prop("checked");
    $.ajax({
        method: "POST",
        url: base_url + "/admin/user/update-role",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            username: username, full_name : full_name, role: role, active:active
        }
    }).done(function(res) {
        // $("#reportViewer").html(res);
        window.location.href = res;
        $.LoadingOverlay("hide");
    });
    html = $("#item-show").html();
    tag.html(html);
});

$(document).on("click",".cancelEdit",function(){
    tag = $(this).closest('tr');
    // role = JSON.parse( tag.find("td:nth-child(3)").attr("data-value"));
    html = $("#item-show").html();
    tag.html(html);
});
