$(document).ready(function(){
  $("#main-form").validate({
    rules :{
      'cover-letter':{
        required : true,
        maxlength: 2048
      }

    }

  });

});
