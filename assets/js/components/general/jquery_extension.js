$(document).ready(function(){

  comm_events.select2_init();
  comm_events.tooltip_init();

});


var comm_events = {
  select2_init : function(){
    $('.select2-basic').select2({
        placeholder: $(this).data('placeholder'),
        allowClear: true
    });
  },
  tooltip_init : function(){
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
  }
}
