$(document).ready(function(){

  $('#generate-excel').click(function(){
    $.ajax({
			type: 'POST',
			dataType: 'json',
			url: global.site_name + 'employer/generate-employer-excel',
			data : {},
      complete : function(){
      },
			success : function(result){
        var win = window.open(global.site_name + 'upload/spreadsheet/' + result.file_name, '_blank');
        win.focus();
			}
		});
  });

  $('#employer-list').DataTable( {
      responsive: true,
      processing: true,
      serverSide: true,
      bSort: true,
      ajax: {
        url : global.site_name + 'employer/employer_ref',
        type : 'POST',
        dataType : 'json',
        data : function(params){
          return params;
        },
        dataSrc: function(result){
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
            let html =  '<div class="text-center"><a class="btn btn-info has-tooltip" title="Edit" href="' + global.site_name + 'employer/edit-profile/' + row['user_name']  + '"><i class="fa fa-pencil"></i></a> ' +
                        '<button class="btn btn-danger has-tooltip delete-row" title="Delete" value="' + id + '"><i class="fa fa-trash"></i></button></div>'
            return html;
          }
      },
      {targets: [4,5], visible: false}],
      initComplete: function(){
        let toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + global.site_name + 'employer/add-employer' + '"><i class="fa fa-file">&nbsp</i> ADD</a></div>';;
        $("div.dt-toolbar").html(toolbar);
      },
      processing : function( e, settings, processing ) {
      },
      // fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      //   console.log("Event Added")
      // },
      fnDrawCallback: function (oSettings) {
        $('.delete-row').click(function(){
          let params = {
            'id'  : $(this).val()
          };
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
                    url : global.site_name + 'employer/delete-employer/',
                    type : 'POST',
                    dataType : 'json',
                    data : params,
                    success : function(){
                      bootbox.alert("Delete Successful");
                      $('#employer-list').ajax.reload();
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
        {   "data": "employer_name" },
        { "data": "employer_address" },
        { "data": "bc_email_address"},
        { "data": "bc_phone_num1",
          "render" : function(data, type, full, meta) {
            return '<span class="text-capitalize">' + full.bc_phone_num1 + '/' + full.bc_phone_num2 + '/'+ full.bc_phone_num3 + '/' + '</span>';
          }
        },
        { "data": "bc_phone_num2"},
        { "data": "bc_phone_num3"},
        { "data": "employer_id"
        , "searchable": false}
      ]
  });
});
