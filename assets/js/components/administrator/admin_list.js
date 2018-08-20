$(document).ready(function(){


    let config = {
      url : global.site_name + 'administrator/admin_ref',
      order_col : 0,
      req_data : {type : 'city'},
      column :[
        { "data": "bc_first_name"},
        { "data": "user_name" },
        { "data": "user_name"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/add-admin',
      edit_url  : global.site_name + 'reference/edit-admin',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'city'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
