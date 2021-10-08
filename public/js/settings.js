$(document).ready(function() {
   $('#settingsForm').change(function () {
      let form_data = $(this).serialize();
      $.ajax({
         type: 'POST',
         url: '/user/preferences',
         data: form_data,
      });
   });

   $('#js-reset').click(function (event) {
      $.ajax({
         type: 'POST',
         url: '/user/preferences/reset',
         success: function(){
            $("#user_settings_form_preferLanguage").val('en');
            $("#user_settings_form_carType").val(null);
            $("#user_settings_form_tuning").val(null);
            $("#user_settings_form_fuelConsumption").val(null);
         }
      });

});
});


