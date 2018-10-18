$(document).ready(function(){
  update();
});





let update = function(){
  $.ajax({
      type: 'POST',
      dataType: 'json',
      url: global.site_name + 'home/dashboard-catch',
      data : {
        today :  moment().format('M/D/YYYY'),
        user :  $('#user-id').val()
      },
      success : function(result){
        $('#job-fit .content-value').text(result.job_qualify_count);
        $('#applied-job .content-value').text(result.application_count);


        console.log(result)
        // let sched_police_clearance = result.sched_police_clearance;

        // $('#sched-pc .content-percent').text(sched_police_clearance.percentage);

      },
      error: function (request, status, error) {

      }
  });
}
