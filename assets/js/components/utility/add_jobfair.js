$(document).ready(function(){
  $("form").validate({
        rules : {
            'job-fair-title' : {
              required : true
            },
            'job-fair-start-date' : {
              required : true,
              date: true
            },
            'job-fair-end-date' : {
              required : true,
              date : true
            },
            'job-fair-status' : {
              required : true
            }
        }
   });
});
