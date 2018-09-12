$(document).ready(function(){

  $('#file-attachment-table').DataTable( {
      responsive: true,
      processing: true,
      serverSide: true,
      bSort: true,
      ajax: {
        url : global.site_name + 'applicant/fa-ref',
        type : 'POST',
        dataType : 'json',
        data : function(params){
          //params['option'] = config.req_data
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
        //This is for the custom button
          targets: -1,
          data: "id",
          render: function ( data, type, row, meta ) {
            // return '';
            let id = data;
            let html =  '<div class="text-center"><button class="btn btn-danger has-tooltip delete-row" title="Delete" value="' + id + '"><i class="fa fa-trash"></i></button> ' +
                        '<button class="btn blue-bg has-tooltip save-file" title="Download" value="' + id  + '"><i class="fa fa-download"></i></button></div>'
            return html;
          }
      }, "aattachment_id"],
      initComplete: function(){
        let toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + global.site_name + 'applicant/add-file' + '"><i class="fa fa-file">&nbsp</i> ADD</a></div>';;
        $("div.dt-toolbar").html(toolbar);
        // let toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + config.add_url + '"><i class="fa fa-file">&nbsp</i> ADD</a></div>';;
        // $("div.dt-toolbar").html(toolbar);
      },
      processing : function( e, settings, processing ) {
        //Loading animation here
        //$('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
      },
      // fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      //   console.log("Event Added")
      // },
      fnDrawCallback: function (oSettings) {
        $('.delete-row').click(function(){
          let params = {};
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
                    url :  global.site_name + 'applicant/delete-file' ,
                    type : 'POST',
                    dataType : 'json',
                    data : params,
                    success : function(){
                      bootbox.alert("Delete Successful");
                      $('#file-attachment-table').ajax.reload();
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

        $('.save-file').click(function(){
          let params = {};
          params['id'] = $(this).val();

          $.ajax({
            url :  global.site_name + 'applicant/save-file' ,
            type : 'POST',
            dataType : 'json',
            data : params,
            success : function(result){
              window.open(
                global.site_name + 'upload/temp/' + result.file_name,
                '_blank');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                bootbox.alert("Something went wrong!");
                //alert(xhr.status);
                //alert(thrownError);
            }
          })


        });


      },
      dom: 'l<"dt-toolbar">frtip',
      buttons: [
          {
              text: 'ADD',
              action: function ( e, dt, node, config ) {

              }
          }
      ],
      order:[[0,'asc']],
      columns: [
        {   "data": "aattachment_date" },
        { "data": "aattachment_name" },
        { "data": "aattachment_id"
        , "searchable": false}
      ]
  });

  // $('#file-attachment-table').DataTable({
  //   dom: '<"dt-toolbar">rt',
  //   initComplete: function(){
  //     let toolbar = '<div><button type="button" id="add-file-attachment" class="btn btn-default" role="button" ><i class="fa fa-file">&nbsp</i> ADD</button></div>';;
  //     $("div.dt-toolbar").html(toolbar);
  //     $('#add-file-attachment').click(function(){
  //
  //
  //     });
  //   },
  //   fnDrawCallback: function (oSettings) {
  //     $('#education-list .edit-row').unbind();
  //     $('#education-list .edit-row').click(function(){
  //
  //     });
  //   }
  // });
  //
  //
  //
  // let config = {
  //   url : global.site_name + 'administrator/admin_ref',
  //   order_col : 0,
  //   req_data : {type : 'city'},
  //   column :[
  //     {   "data": "full_name" },
  //     { "data": "user_name" },
  //     { "data": "bc_gender",
  //       "render" : function(data, type, full, meta) {
  //         return '<span class="text-capitalize">' + data + '</span>';
  //       }
  //     },
  //     { "data": "admin_id"
  //     , "searchable": false}
  //   ],
  //   add_url : global.site_name + 'administrator/add-admin',
  //   edit_url  : global.site_name + 'administrator/edit-admin',
  //   delete_url : global.site_name + 'administrator/delete-ref',
  //   page_var : {
  //     type : 'city'
  //   }
  // }
  // helper.datatable_basic('.datatable-basic', config);



});
