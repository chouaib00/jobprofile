
$(document).ready(function(){


    let config = {
      url : global.site_name + 'administrator/admin_ref',
      order_col : 0,
      req_data : {type : 'city'},
      column :[
        {   "data": "full_name" },
        { "data": "user_name" },
        { "data": "bc_gender",
          "render" : function(data, type, full, meta) {
            return '<span class="text-capitalize">' + data + '</span>';
          }
        },
        { "data": "admin_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'administrator/add-admin',
      edit_url  : global.site_name + 'administrator/edit-admin',
      delete_url : global.site_name + 'administrator/delete-ref',
      page_var : {
        type : 'city'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
