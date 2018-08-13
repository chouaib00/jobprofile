$(document).ready(function(){


    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 3,
      req_data : {type : 'province'},
      column :[
        { "data": "country_name" },
        { "data": "region_desc" },
        { "data": "province_code" },
        { "data": "province_name" },
        { "data": "province_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/ref'
    }
    helper.datatable_basic('.datatable-basic', config);

});
