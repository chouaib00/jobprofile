var helper = {
  datatable_basic : function(table, config){
    $(table).DataTable( {
        responsive: true,
        processing: true,
        serverSide: true,
        bSort: true,
        ajax: {
          url : config.url,
          type : 'POST',
          dataType : 'json',
          data : function(params){
            params['option'] = config.req_data
            return params;
          },
          dataSrc: function(result){
            // let format = {
            //   data : result.data
            // , recordsTotal:result.count
            // };
            result.recordsTotal = result.total_count;
            result.recordsFiltered = result.count;

            return result.data;
          },
          cache: true
        },
        columnDefs: [ {
            targets: -1,
            data: "country_id",
            render: function ( data, type, row, meta ) {
              let html = '<div class="text-center"><a class="btn btn-info has-tooltip" title="Edit"><i class="fa fa-pencil"></i></a> ' +
              '<button class="btn btn-danger has-tooltip" title="Delete"><i class="fa fa-trash"></i></button></div>'
              return html;
            }
        } ],
        dom: 'l<"dt-toolbar">frtip',
        buttons: [
            {
                text: 'ADD',
                action: function ( e, dt, node, config ) {

                }
            }
        ],
        order:[[config.order_col,'asc']],
        columns: config.column
    });

    var toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + global.site_name + 'reference/add_country"><i class="fa fa-file">&nbsp</i> ADD</a></a></div>';;
    $("div.dt-toolbar").html(toolbar);
  }
}
