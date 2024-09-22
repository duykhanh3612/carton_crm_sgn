
$(document).ready(function(){
     $(document).on("click",".menu-items>.item,.subitem",function(e){
        e.preventDefault();
        let menu = $(this).data('submenu');
        let tag = $('#'+menu);
        if(menu!=undefined){
            if(tag.hasClass("menu-expland")){
                tag.removeClass("menu-expland");
            }
            else{
                tag.addClass("menu-expland");
            }
        }
        else{
            let uri = $(this).data('href');
            window.open(uri, '_blank');
        }

    });
    // $(document).on("click","#nav-components",function(){
    //     let uri = $(this).data('href');
    //     window.open(uri, '_blank');
    // });



});
