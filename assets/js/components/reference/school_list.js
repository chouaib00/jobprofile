$(document).ready(function(){

    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 0,
      req_data : {type : 'school'},
      column :[
        {   "data": "school_name"
        },
        {   "data": "city_name"
        },
        {   "data": "province_name"
        },
        {   "data": "country_name"
        },
        {   "name" : 'address'
          , "data": "address_desc"
          ,  "render": function(data, type, full, meta) {
              return full['address_desc'];
          }
        },
        {   "data"  : "school_id"
          , "searchable": false
        }
      ],
      add_url : global.site_name + 'reference/add-school',
      edit_url  : global.site_name + 'reference/edit-school',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'school'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
