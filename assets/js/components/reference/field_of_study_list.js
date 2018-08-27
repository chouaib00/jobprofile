$(document).ready(function(){

    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 0,
      req_data : {type : 'field-of-study'},
      key : 'fos_id',
      column :[
        {   "name" : 'cat'
          , "data": "child.fos_name"
          ,  "render": function(data, type, full, meta) {
            return full['cat'];
          }
        },
        {   "name" : 'fos'
          , "data": "parent.fos_name"
          ,  "render": function(data, type, full, meta) {
              return full['fos'];
          }
        },
        {   "data"  : "child.fos_id"
          , "searchable": false
        }
      ],
      add_url : global.site_name + 'reference/add-field-of-study',
      edit_url  : global.site_name + 'reference/edit-field-of-study',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'field-of-study'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
