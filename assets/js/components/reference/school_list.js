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
        {   "data": "address_desc"
          ,  "render": function(data, type, full, meta) {
              console.log(full)
              return full['address_desc'] + ', ' + full['city_name'] + ' City, ' + full['province_name'] + ', ' + full['country_name'];
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
      },
      columnDefs : { targets: [1,2,3], visible: false}

    }
    helper.datatable_basic('.datatable-basic', config);

});
