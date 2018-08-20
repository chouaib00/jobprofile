var helper = {
  datatable_basic : function(table, config){
    config.on_load = (typeof config.on_load === "undefined")? function(){ return} : config.on_load;
    config.add_url = (typeof config.add_url === "undefined")? '' : config.add_url;
    config.edit_url = (typeof config.edit_url === "undefined")? '' : config.edit_url;
    config.delete_url = (typeof config.delete_url === "undefined")? '' : config.delete_url;
    config.page_var = (typeof config.page_var === "undefined")? '' : config.page_var;
    config.key = (typeof config.key === "undefined")? '' : config.key;



    let datatable = $(table).DataTable( {
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
            data: "id",
            render: function ( data, type, row, meta ) {
              // return '';
              let id = (config.key === '')? data : row[config.key];
              let html = '<div class="text-center"><a class="btn btn-info has-tooltip" title="Edit" href="' + config.edit_url + '/' + id  + '"><i class="fa fa-pencil"></i></a> ' +
              '<button class="btn btn-danger has-tooltip delete-row" title="Delete" value="' + id + '"><i class="fa fa-trash"></i></button></div>'
              return html;
            }
        } ],
        processing : function( e, settings, processing ) {
          //Loading animation here
          //$('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
        },
        // fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        //   console.log("Event Added")
        // },
        fnDrawCallback: function (oSettings) {
          $('.delete-row').click(function(){
            let params = config.page_var;
            params['id'] = $(this).val();
            bootbox.confirm({
                title: "Delete row",
                message: "Are you sure you want to delete this?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                callback: function (result) {
                  if(result){
                    $.ajax({
                      url : config.delete_url,
                      type : 'POST',
                      dataType : 'json',
                      data : params,
                      success : function(){
                        bootbox.alert("Delete Successful");
                        datatable.ajax.reload();
                      },
                      error: function (xhr, ajaxOptions, thrownError) {
                          bootbox.alert("Something went wrong!");
                          //alert(xhr.status);
                          //alert(thrownError);
                      }
                    })
                  }
                }
            });

          });

          config.on_load();

        },
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

    var toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + config.add_url + '"><i class="fa fa-file">&nbsp</i> ADD</a></a></div>';;
    $("div.dt-toolbar").html(toolbar);
  }
}
