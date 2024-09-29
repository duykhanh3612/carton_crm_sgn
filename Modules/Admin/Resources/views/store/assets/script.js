function startEditCompanyInfo()
{
    $(".profile-users").find('.ng-hide').each(function(){
        $(this).removeClass('ng-hide').addClass("ng-hide-bingding");
        $(this).closest(".col-sm-8").find("div:nth-child(2)").addClass("ng-hide");
        $('.form-actions.update').hide();
        $('.form-actions.submit').show();
    });
}
function cancelEditCompanyInfo()
{
    $(".profile-users").find('.ng-hide').each(function(){
        $(this).removeClass('ng-hide');
        $(this).closest(".col-sm-8").find(".ng-hide-bingding").removeClass('ng-hide-bingding').addClass("ng-hide");
    });
    $('.form-actions.update').show();
    $('.form-actions.submit').hide();
}

function saveCompanyInfo()
{
    tag = $("form[name=companyInfoFrm]");
    tag.attr("action",base_url + "/admin/store/update");
    tag.submit();
    // username = tag.find("input[name=username]").val();
    // full_name = tag.find("input[name=fullname]").val();
    // password = tag.find("input[name=password]").val();
    // var role = [];
    // $(tag.find("input.ace")).each(function(){
    //     if($(this).prop("checked"))
    //     {

    //         role.push($(this).val());
    //     }
    // });
    // $.ajax({
    //     method: "POST",
    //     url: "{{ route('admin.user.create') }}",
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     data: {
    //         user_name: username, full_name : full_name,password:password, role: role
    //     }
    // }).done(function(res) {
    //     if(res.success)
    //     {
    //         location.reload();
    //     }

    // });
}

$(document).on("change","#industry",function(){
    $("#industry_name").val($("#industry > option:selected").text())
});
$(document).on("click",".item_edit",function(){

if($(this).hasClass("fa-save"))
{
    data = {};
    tr = $(this).closest("tr");
    tr.find("td").each(function(){
        if($(this).find('.ng-binding ').length > 0)
        {
            tag = $(this).find('.ng-binding');
            val = tag.val();
            name = tag.attr('data-name');
            link_edit =  tag.attr("data-edit");
            attr_class = tag.attr('class') + (link_edit?" item_edit":"");

            $(this).html(` <a class="${attr_class}"  data-name="${name}">${val}</a>`);
            data[name] = val;
        }
    });
    $(this).removeClass("fa-save");
    $(this).addClass("fa-edit");
    console.log(data);

}
else{
    tr = $(this).closest("tr");
    tr.find("td").each(function(){
        if($(this).find('.ng-binding ').length > 0)
        {
            tag = $(this).find('.ng-binding ');

            val = tag.text();
            name = tag.attr('data-name');
            link_edit =  tag.hasClass("item_edit");
            attr_class = tag.attr('class').replace("item_edit","");

            $(this).html(`<input name="${name}" data-name="${name}" data-edit="${link_edit}"  value="${val}" class="${attr_class}"  />`);
        }
    });
    $(this).removeClass("fa-edit");
    $(this).addClass("fa-save");
}
});
