$(document).ready(function(){


    let config = {
      url : global.site_name + 'utility/announcement-table',
      order_col : 1,
      req_data : {},
      column :[
        { "data": "announcement_date" },
        { "data": "announcement_title" },
        { "data": "annoucement_id"
        , "searchable": false}
      ],
      add_url : global.site_name + 'reference/add-city',
      edit_url  : global.site_name + 'reference/edit-city',
      delete_url : global.site_name + 'reference/delete-ref',
      page_var : {}
    }
    helper.datatable_basic('.datatable-basic', config);

});
