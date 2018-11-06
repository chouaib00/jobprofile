$(document).ready(function(){
  $('[name=current-status]').change(function(){
    let new_status = $(this).val();
    let aa_id = $(this).closest('.applicant-info').data('aa-id');
    $.ajax({
      url : global.site_name + 'vacancy/shift-status/',
      type : 'POST',
      dataType : 'json',
      data : {
        'new-status' : new_status
      , 'aa-id' : aa_id
      },
      success : function(response){
        
      },
      error: function (xhr, ajaxOptions, thrownError) {
          bootbox.alert("Something went wrong!");
          //alert(xhr.status);
          //alert(thrownError);
      }
    })
    // console.log($('[name=current-status]').val())
  });

});
