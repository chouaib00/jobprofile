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
      , 'method':'application'
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

  $('[name=add-applicant-status]').change(function(){
    let new_status = $(this).val();
    let applicant_id = $(this).closest('.applicant-info').data('applicant-id');
    let jd_id = $(this).closest('.applicant-info').data('jd-id');
    $.ajax({
      url : global.site_name + 'vacancy/shift-status/',
      type : 'POST',
      dataType : 'json',
      data : {
        'new-status' : new_status
      , 'jd-id' : jd_id
      , 'applicant-id' : applicant_id
      , 'method':'non-application'
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
