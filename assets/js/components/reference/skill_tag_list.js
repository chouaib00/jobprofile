$(document).ready(function(){
  $("#main-form").validate({
        rules : {
            'st_name' : {
              required : true
            }
        }
   });

    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 0,
      req_data : {type : 'skill'},
      column :[
        { "data": "st_name"},
        { "data": "st_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/add-skill-tag',
      edit_url  : global.site_name + 'reference/edit-skill-tag',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'skill'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
