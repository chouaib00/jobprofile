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

        var lineData = {
            labels: result.applicant_registration_linegraph.month,
            datasets: [

                {
                    label: "Applicant Registration",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: result.applicant_registration_linegraph.data
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };

        var ctx = document.getElementById("applicant-registration-linegraph").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});


        var lineDataApplicationFrequency = {
            labels: result.applicant_frequency_application.month,
            datasets: [
                {
                    label: "Hired",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: result.applicant_frequency_application.data.hired
                },
                {
                    label: "Rejected",
                    backgroundColor: 'rgba(186, 26, 26,0.5)',
                    borderColor: "rgba(186, 26, 26,0.7)",
                    pointBackgroundColor: "rgba(186, 26, 26,1)",
                    pointBorderColor: "#fff",
                    data: result.applicant_frequency_application.data.rejected
                },
                {
                    label: "Reviewing",
                    backgroundColor: 'rgba(73, 115, 188,0.5)',
                    borderColor: "rgba(73, 115, 188,0.7)",
                    pointBackgroundColor: "rgba(73, 115, 188,1)",
                    pointBorderColor: "#fff",
                    data: result.applicant_frequency_application.data.reviewing
                },
            ]
        };

        var ctx = document.getElementById("applicant-frequency-linegraph").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineDataApplicationFrequency, options:lineOptions});


        let top_skill = '';
        result.top_skill.forEach(function(skill){
          top_skill += '<tr>' +
              '<td class="no-borders">' +
                  '<span class="badge badge-primary">' + skill.num + '</span>' +
              '</td>' +
              '<td  class="no-borders">' + skill.st_name + '</td>' +
          '</tr>'
        });
        $('#top-skill tbody').append(top_skill);


        console.log(result)
        // let sched_police_clearance = result.sched_police_clearance;

        // $('#sched-pc .content-percent').text(sched_police_clearance.percentage);

      },
      error: function (request, status, error) {

      }
  });
}
