jQuery(document).ready(function ($) {
    function getValueCheckboxSeleted(element){
        let arrayValue = [];
        $(element+':checked').each(function(){
            const id = $(this).val();
            arrayValue.push(id);
        });
        return arrayValue;
    }
    $('.js-approve-user').click(function(){
        const userId = $(this).data('userId');
        const userIds = [userId];
        approvedUsers(userIds);
    });
	$('.js-approve-users').click(function(){
        let userIds = getValueCheckboxSeleted('.jsListUserId');
        if(userIds.length){
            approvedUsers(userIds);
        }
    });
    $('.js-remove-user').click(function(){
        const userId = $(this).data('userId');
        const userIds = [userId];
        removeUsers(userIds);
    });
    $('.js-remove-users').click(function(){
        let userIds = getValueCheckboxSeleted('.jsListUserId');
        if(userIds.length){
            removeUsers(userIds);
        }
    });
    $('.js-assign-add-ons').click(function(){
        let userIds = getValueCheckboxSeleted('.jsListUserId');
        if(userIds.length == 1){
            location.href = routeAssignAddons + '/' + userIds[0];
        }else{
            alert('Please select a user to assign add-ons.');
        }
    });
    $('.force-login').click(function(){
        const userId = $(this).data('userId');
        forceLogin(userId);
    });
    function approvedUsers(userIds){
        $(this).submitDataAjax({
            'url': routeApprovedUsers,
            'method': 'POST',
            'data': { 'userIds': userIds},
            'success': function success(res) {
                if(res.status === 200){
                    window.location.reload();
                }
            }
        });
    }
    function removeUsers(userIds){
        if(confirm('Are you sure you want to delete?')){
            $(this).submitDataAjax({
                'url': routeRemoveUsers,
                'method': 'POST',
                'data': { 'userIds': userIds},
                'success': function success(res) {
                    // if(res.status == 200){
                        window.location.reload();
                    // }
                }
            });
        }
    }

  $('.js-remove-item').click(function () {
      const id = $(this).data('itemId');
      const ids = [id];
      removeItems(ids);
  });

  $('.js-remove-items').click(function(){
    let ids = getValueCheckboxSeleted('.jsListItemId');
    if(ids.length){
      removeItems(ids);
    }
  });

  function removeItems(ids){
    if(confirm('Are you sure you want to delete?')){
      $(this).submitDataAjax({
        'url': routeRemoveItems,
        'method': 'POST',
        'data': { 'ids': ids},
        'success': function success(res) {
          if(res.status === 200){
            window.location.reload();
          }
        }
      });
    }
  }
});
