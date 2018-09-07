$(document).ready(function(){

  comm_events.select2_init();
  comm_events.datepicker_month_year();
  comm_events.datepicker();
  comm_events.tooltip_init();
  comm_events.icheck_init();
  comm_events.submit_init();
});


var comm_events = {
  select2_init : function(){
    $('.select2-basic').select2({
        placeholder: $(this).data('placeholder'),
        allowClear: true
    });
  },
  datepicker : function(){
    $('.datepicker').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format:'mm/dd/yyyy'
    });
  },
  datepicker_month_year : function(){
    $('.datepicker-month-year').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true,
        format:'MM yyyy'
    });
  },
  tooltip_init : function(){
    $("body").tooltip({ selector: '.has-tooltip', placement: 'bottom' });
  },
  icheck_init : function(){
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
  },
  submit_init : function(){
    $('.form-submit').click(function(){
      $("#"+$(this).data('form')).submit();
    })
  }
}
