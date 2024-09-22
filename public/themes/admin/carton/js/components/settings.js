jQuery(document).ready(function ($) {
  $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  setTimeout(function(){
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab && $('#SettingsTabs a[href="' + activeTab + '"]').length) {
      $('#SettingsTabs a[href="' + activeTab + '"]').click();
    } else {
      if($('#SettingsTabs li>a.active:first').length) {
        $('#SettingsTabs li>a.active:first').click();
      }
      else {
        $('#SettingsTabs li>a:first').click();
      }
    }
  } , 100);

  $('.pageReloadRequired').click(function () {
    window.location.reload();
  })
  $('.hsMultiselect').multiselect('clearSelection');
  $('.settingTabs a.btnBody ').click(function () {
    $('.hsMultiselect').multiselect('clearSelection');
  });
});
