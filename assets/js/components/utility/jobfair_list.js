$(document).ready(function(){
  $('#applicant-list').DataTable( {
      responsive: true,
      processing: true,
      serverSide: true,
      bSort: true,
      ajax: {
        url : global.site_name + 'jobfair/applicant-table',
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
            let html =  '<div class="text-center"><label class="applicant-attendance-log checkbox-inline has-tooltip" title="Attendance"> <input type="checkbox" value="' + row['applicant_id'] + '" ' + (row['jfa_time_in'] && !row['jfa_time_out']? 'checked': '' ) + ' ></label> ' +
                        '</div>'
            return html;

          }
      }],
      initComplete: function(){
        let toolbar = '<div class="pull-right"></div>';
        $("div.dt-toolbar").html(toolbar);
      },
      processing : function( e, settings, processing ) {
      },
      // fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      //   console.log("Event Added")
      // },
      fnDrawCallback: function (oSettings) {
        //comm_events.icheck_init();

        $('.applicant-attendance-log').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $(".applicant-attendance-log input").on('ifChanged', function (e) {
          let applicant_id = $(this).val();
          let isChecked = (this.checked)? '1' : '0';
          $.ajax({
            url : global.site_name + 'jobfair/attendance-log/',
            type : 'POST',
            data : {
              'attendee_id' : applicant_id
            , 'type': '2'
            , 'checked': isChecked
            },
            success : function(){
              //bootbox.alert("Delete Successful");
              $('#applicant-list').DataTable().ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
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


  $('#employer-list').DataTable( {
      responsive: true,
      processing: true,
      serverSide: true,
      bSort: true,
      ajax: {
        url : global.site_name + 'jobfair/employer-table',
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
            let html =  '<div class="text-center"><label class="employer-attendance-log checkbox-inline has-tooltip" title="Attendance"> <input type="checkbox" value="' + row['employer_id'] + '" ' + (row['jfa_time_in'] && !row['jfa_time_out']? 'checked': '' ) + ' ></label> ' +
                        '</div>'
            return html;
          }
      },
      {targets: [4,5], visible: false}],
      initComplete: function(){
        let toolbar = '<div class="pull-right"></div>';;
        $("div.dt-toolbar").html(toolbar);
      },
      processing : function( e, settings, processing ) {
      },
      // fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      //   console.log("Event Added")
      // },
      fnDrawCallback: function (oSettings) {

        $('.employer-attendance-log').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $(".employer-attendance-log input").on('ifChanged', function (e) {
          let employer_id = $(this).val();
          let isChecked = (this.checked)? '1' : '0';
          $.ajax({
            url : global.site_name + 'jobfair/attendance-log/',
            type : 'POST',
            data : {
              'attendee_id' : employer_id
            , 'type': '3'
            , 'checked': isChecked
            },
            success : function(){
              //bootbox.alert("Delete Successful");
              $('#employer-list').DataTable().ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.status);
                //alert(thrownError);
            }
          })
        });


        comm_events.icheck_init();
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
        {   "data": "employer_name",
          "render":function(data, type, full, meta) {
            return '<a href="'+ global.site_name + "employer/view-profile/" + full.user_name + '"><span class="text-capitalize">' + full.employer_name + '</span></a>';
          }
        },
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


    // let config = {
    //   url : global.site_name + 'utility/announcement-table',
    //   order_col : 0,
    //   req_data : {},
    //   column :[
    //     { "data": "announcement_date" },
    //     { "data": "announcement_title" },
    //     { "data": "bc_first_name"
    //     , "render" : function(data, type, full, meta) {
    //         return full['bc_first_name'] + ' ' + full['bc_middle_name'] + ' ' + full['bc_last_name'] + ' ' + full['bc_name_ext'];
    //       }
    //     },
    //     { "data": "bc_middle_name" },
    //     { "data": "bc_last_name" },
    //     { "data": "bc_name_ext" },
    //     { "data": "annoucement_id"
    //     , "searchable": false}
    //   ],
    //   add_url : global.site_name + 'utility/add-announcement',
    //   edit_url  : global.site_name + 'utility/edit-announcement',
    //   delete_url : global.site_name + 'utility/delete-announcement',
    //   page_var : {},
    //   columnDefs : { targets: [3,4,5], visible: false}
    // }
    // helper.datatable_basic('.datatable-basic', config);

});
