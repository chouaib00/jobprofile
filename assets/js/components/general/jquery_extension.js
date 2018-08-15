$(document).ready(function(){

  comm_events.select2_init();
  comm_events.tooltip_init();
  comm_events.submit_init();
});


var comm_events = {
  select2_init : function(){
    $('.select2-basic').select2({
        placeholder: $(this).data('placeholder'),
        allowClear: true
    });
  },
  tooltip_init : function(){
    $("body").tooltip({ selector: '.has-tooltip', placement: 'bottom' });
  },
  submit_init : function(){
    $('.form-submit').click(function(){
      $("#"+$(this).data('form')).submit();
    })
  }
}
