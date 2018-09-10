$(document).ready(function(){


    let config = {
      url : global.site_name + 'utility/announcement-table',
      order_col : 0,
      req_data : {},
      column :[
        { "data": "announcement_date" },
        { "data": "announcement_title" },
        { "data": "bc_first_name"
        , "render" : function(data, type, full, meta) {
            return full['bc_first_name'] + ' ' + full['bc_middle_name'] + ' ' + full['bc_last_name'] + ' ' + full['bc_name_ext'];
          }
        },
        { "data": "bc_middle_name" },
        { "data": "bc_last_name" },
        { "data": "bc_name_ext" },
        { "data": "annoucement_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'utility/add-announcement',
      edit_url  : global.site_name + 'utility/edit-announcement',
      delete_url : global.site_name + 'utility/delete-announcement',
      page_var : {},
      columnDefs : { targets: [3,4,5], visible: false}
    }
    helper.datatable_basic('.datatable-basic', config);

});
