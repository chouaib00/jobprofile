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
      add_url : global.site_name + 'reference/ref'
    }
    helper.datatable_basic('.datatable-basic', config);

});
