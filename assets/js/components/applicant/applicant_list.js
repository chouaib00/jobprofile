$(document).ready(function(){

  $('#generate-excel').click(function(){
    var filter = [
      {
        name : 'applicant-educ-attainment'
      , value : ''
      },
      {
        name : 'add-region'
      , value : ''
      },
      {
        name : 'add-province'
      , value : ''
      },
      {
        name : 'add-city'
      , value : ''
      },
      {
        name : 'applicant-skills'
      , value : ''
      },
      {
        name : 'applicant-gender'
      , value : ''
      },
      {
        name : 'age-range'
      , value : '10;90'
      },
      {
        name : 'filter-type'
      , value : 'most-relevant'
      },
    ];

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: global.site_name + 'applicant/generate-excel',
      data : filter,
      complete : function(){
      },
      success : function(result){
        var win = window.open(global.site_name + 'upload/spreadsheet/' + result.file_name, '_blank');
        win.focus();
      }
    });
  })
  $('#employer-list').DataTable( {
      responsive: true,
      processing: true,
      serverSide: true,
      bSort: true,
      ajax: {
        url : global.site_name + 'applicant/applicant_ref',
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
            let html =  '<div class="text-center"><a class="btn btn-info btn-sm has-tooltip" title="Edit" href="' + global.site_name + 'applicant/update-profile/' + row['user_name']  + '"><i class="fa fa-pencil"></i></a> ' +
                        '<button class="btn btn-danger btn-sm has-tooltip delete-row" title="Delete" value="' + row['user_name'] + '"><i class="fa fa-trash"></i></button> ' +
                        '<a class="btn btn-primary btn-sm has-tooltip" title="" href="'+ global.site_name + "applicant/view-profile/" + row['user_name'] + '" data-original-title="See Profile"><i class="fa fa-eye"></i></a>' +
                        '</div>'
            return html;
          }
      }],
      initComplete: function(){
        let toolbar = '<div class="pull-right"><a class="btn btn-default" role="button" href="' + global.site_name + 'applicant/add-applicant' + '"><i class="fa fa-file">&nbsp</i> ADD</a></div>';;
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
                    url : global.site_name + 'applicant/delete-applicant/',
                    type : 'POST',
                    dataType : 'json',
                    data : params,
                    success : function(){
                      bootbox.alert("Delete Successful");
                      $('#employer-list').DataTable().ajax.reload();
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
        { "data": "applicant",
          "render":function(data, type, full, meta) {
            return '<a href="'+ global.site_name + "applicant/view-profile/" + full.user_name + '"><span class="text-capitalize">' + full.applicant + '</span></a>';
          }
        },
        { "data": "bc_gender",
          "render" : function(data, type, full, meta) {
            return '<span class="text-capitalize">' + full.bc_gender + '</span> / ' + full.age;
          }
        },
        { "data": "bc_email_address"},
        { "data": "bc_gender",
          "render" : function(data, type, full, meta) {
            return '';
          }
        },
        { "data": "bc_phone_num1",
          "render" : function(data, type, full, meta) {
            return '<span class="text-capitalize">' + full.bc_phone_num1 + '/' + full.bc_phone_num2 + '/'+ full.bc_phone_num3 + '/' + '</span>';
          }
        },
        { "data": "address"
        },
        { "data": "employer_id"
        , "searchable": false}
      ]
  });
});
