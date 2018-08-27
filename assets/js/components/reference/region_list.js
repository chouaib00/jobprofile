$(document).ready(function(){


    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 3,
      req_data : {type : 'region'},
      column :[
        { "data": "country_name" },
        { "data": "region_code" },
        { "data": "region_desc" },
        { "data": "region_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/add-region',
      edit_url  : global.site_name + 'reference/edit-region',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'region'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
