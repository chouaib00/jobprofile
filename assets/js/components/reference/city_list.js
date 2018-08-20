$(document).ready(function(){


    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 3,
      req_data : {type : 'city'},
      column :[
        { "data": "country_name" },
        { "data": "region_desc" },
        { "data": "province_name" },
        { "data": "city_name" },
        { "data": "city_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/add-city',
      edit_url  : global.site_name + 'reference/edit-city',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'city'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
