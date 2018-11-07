$(document).ready(function(){
  $("#main-form").validate({
    rules :{
      'cover-letter':{
        maxlength: 2048
      }

    }

  });

});
