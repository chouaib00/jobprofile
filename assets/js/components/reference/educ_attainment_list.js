$(document).ready(function(){


    let config = {
      url : global.site_name + 'reference/ref',
      order_col : 1,
      req_data : {type : 'educ-attainment'},
      column :[
        { "data": "ea_name"},
        { "data": "ea_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/add-educ-attainment',
      edit_url  : global.site_name + 'reference/edit-educ-attainment',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {
        type : 'country'
      }
    }
    helper.datatable_basic('.datatable-basic', config);

});
