<script>
$(document).ready(function(){
  let notif = {
    format_row : function(data){
      return `<li>
          <a id="notif-read" data-notif-id="` + data.notif_id + `" href="` + data.notif_link + `" >
              <div>
                  ` + data.notif_message + `
                  <span class="pull-right text-muted small">` + data.notif_date + `</span>
              </div>
          </a>
      </li>
      <li class="divider"></li>`;
    },
    update: function(){
      if(!$('#notification').hasClass('open')){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: global.site_name + 'home/get-notification',
            data : {
              today :  moment().format('M/D/YYYY')
            },
            success : function(result){

              let notif_str = '';
              if(result.notification.length > 0){
                result.notification.forEach(function(row){
                  notif_str += notif.format_row(row);
                });
                $('#notification ul.dropdown-menu').html('');
                $('#notification ul.dropdown-menu').append(notif_str)
                $('#notification #no-notif').text(result.notification.length);


                $('#notification #notif-read').mousedown(function(){
                  let notif_id = $(this).data('notif-id');
                  $.ajax({
                      type: 'POST',
                      url: global.site_name + 'home/mark-read-notif',
                      data : {
                        notif_id : notif_id
                      },
                      success : function(result){

                      },
                      error: function (request, status, error) {

                      }
                  });
                });
                $(this).parent().html('');
              }
              else{
                $('#notification ul.dropdown-menu').html('<li class="text-center">You have no notification</li>')
              }

            },
            error: function (request, status, error) {

            }
        });
      }
    }
  }
  notif.update();
  let puller = setInterval(function(){ notif.update() }, 1500);
});

</script>
