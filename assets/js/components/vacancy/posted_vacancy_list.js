$(document).ready(function(){

  $('#vacancy-list').DataTable( {
      responsive: true,
      processing: true,
      serverSide: true,
      bSort: true,
      ajax: {
        url : global.site_name + 'vacancy/vacancy_ref',
        type : 'POST',
        dataType : 'json',
        data : function(params){
          params['employer']  = $('#employer-id').val();
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
            let html =  '<div class="text-center"><a class="btn btn-info btn-sm has-tooltip" title="Edit" href="' + global.site_name + 'vacancy/edit-vacancy/' + id  + '"><i class="fa fa-pencil"></i></a> ' +
                        '<button class="btn btn-danger btn-sm has-tooltip delete-row" title="Delete" value="' + id + '"><i class="fa fa-trash"></i></button> ' +
                        '<a class="btn btn-primary btn-sm has-tooltip" title="View Vacancy" href="' + global.site_name + 'vacancy/view-vacancy/' + id  + '"><i class="fa fa-eye"></i></a> ' +
                        '</div>'
            return html;
          }
      }],
      initComplete: function(){
        let toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + global.site_name + 'vacancy/post-vacancy' + '"><i class="fa fa-file">&nbsp</i> ADD</a></div>';;
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
                    url : global.site_name + 'vacancy/delete-vacancy/',
                    type : 'POST',
                    dataType : 'json',
                    data : params,
                    success : function(){
                      bootbox.alert("Delete Successful");
                      $('#vacancy-list').DataTable().ajax.reload();
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
        {   "data": "jp_date_posted" },
        { "data": "jp_title"},
        { "data": "jp_open",
          "render" : function(data, type, full, meta) {
            return '<span class="text-capitalize">' + full.jp_open + '</span>';
          }
        },
        { "data": "jp_id"
        , "searchable": false}
      ]
  });
});
