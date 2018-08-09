$(document).ready(function(){
    $('.datatable-basic').DataTable( {
        processing: true,
        serverSide: true,
        ajax: {
          url : global.site_name + 'reference/ref',
          type : 'GET',
          dataType : 'json',
          data : function(params){
            delete params['columns'];
            console.log(params)
            return params;
          },
          dataSrc:'',
          cache: true
        },
        dom: 'lfrBtip',
        buttons: [
            {
                text: 'ADD',
                action: function ( e, dt, node, config ) {

                }
            }
        ],
        columns:[
            { "data": "country_code" },
            { "data": "country_name" }
        ]
    } );
});
