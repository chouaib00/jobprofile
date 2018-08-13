$(document).ready(function(){


    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 1,
      req_data : {type : 'country'},
      column :[
        { "data": "country_code"},
        { "data": "country_name" },
        { "data": "country_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/ref'
    }
    helper.datatable_basic('.datatable-basic', config);

});
