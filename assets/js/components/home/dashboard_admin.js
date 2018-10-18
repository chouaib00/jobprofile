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
        $('#reg-app .content-value').text(result.registered_applicant_count);
        $('#reg-emp .content-value').text(result.registered_employer_count);
        $('#jobposted .content-value').text(result.job_posted_count);



        console.log(result)
        // let sched_police_clearance = result.sched_police_clearance;

        // $('#sched-pc .content-percent').text(sched_police_clearance.percentage);

      },
      error: function (request, status, error) {

      }
  });
}
