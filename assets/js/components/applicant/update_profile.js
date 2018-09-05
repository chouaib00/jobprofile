$(document).ready(function(){
  $('[name=applicant-birthday]').datepicker({
      keyboardNavigation: false,
      forceParse: false,
      autoclose: true,
      format:'mm/dd/yyyy'
  });

  //$('.chosen-modal-fos').chosen({width: "100%"});
  $('.select2-educ-fos').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "name" : 'fos_name'
              , "data": "child.fos_name"
              , "searchable": true },
              { "name" : 'fos_id'
              , "data": "child.fos_id"
              , "searchable": false}
            ],
            order : [
              {
                'column' : 1,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'field-of-study'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.fos_id
          , text: d.fos_name
          });
        });
        return {
          results: result
        }
      }
    }
  });


  $('.select2-school').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {   "data": "school_name"
              },
              {   "data": "city_name"
              },
              {   "data": "province_name"
              },
              {   "data": "country_name"
              },
              {   "data": "address_desc"
              },
              {   "data"  : "school_id"
                , "searchable": false
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'school'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.school_id
          , text: d.school_name + ' - ' + d.province_name
          });
        });
        return {
          results: result
        }
      }
    }
  });


  $('.datatable-basic').DataTable({
    dom: '<"dt-toolbar">rt',
    initComplete: function(){
      let toolbar = '<div><button type="button" id="add-education" class="btn btn-default" role="button" ><i class="fa fa-file">&nbsp</i> ADD</button></div>';;
      $("div.dt-toolbar").html(toolbar);
      $('#add-education').click(function(){

        $("#modal-educ-type").modal();
        // $.ajax({
        //   url : global.site_name + 'reference/education-form',
        //   type : 'GET',
        //   data : {},
        //   success : function(result){
        //     bootbox.confirm({
        //         title: "Add Education",
        //         message: result,
        //         buttons: {
        //             cancel: {
        //                 label: '<i class="fa fa-ban"></i> Cancel'
        //             },
        //             confirm: {
        //                 label: '<i class="fa fa-plus"></i> Add'
        //             }
        //         },
        //
        //         callback: function (result) {
        //           // if(result){
        //           //
        //           // }
        //         }
        //     }).init(function(){
        //       alert("YEH")
        //       $('.select2-educ-type').select2();
        //     });
        //   },
        //   error: function (xhr, ajaxOptions, thrownError) {
        //       bootbox.alert("Something went wrong!");
        //       //alert(xhr.status);
        //       //alert(thrownError);
        //   }
        // });

      });
    },
    fnDrawCallback: function (oSettings) {


    }
  });

  // $('.select2-educ-type').select2({
  //   dropdownParent: $("#modal-educ-type")
  // })

  $('.select2-country').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "country_name"
              , "searchable": true },
              { "data": "country_id"
              , "searchable": false}
            ],
            order : [
              {
                'column' : 0,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'country'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.country_id
          , text: d.country_name
          });
        });
        return {
          results: result
        }
      }
    }
  });

  $('.select2-region').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "region_code"
              , "searchable": true },
              {
                "data": "region_desc"
              , "searchable": true },
              { "data": "region_id"
              , "searchable": false}
            ],
            order : [
              {
                'column' : 2,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'region'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.region_id
          , text: d.region_code + ' - ' + d.region_desc
          });
        });
        return {
          results: result
        }
      }
    }
  });

  $('.select2-province').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "province_name"
              , "searchable": true },
              {
                "data": "province_id"
              , "searchable": false }
            ],
            order : [
              {
                'column' : 1,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'province'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.province_id
          , text: d.province_name
          });
        });
        return {
          results: result
        }
      }
    }
  });

  $('.select2-city').select2({
    allowClear: true,
    minimumInputLength: 3,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "city_name"
              , "searchable": true },
              {
                "data": "city_id"
              , "searchable": false }
            ],
            order : [
              {
                'column' : 0,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'city'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.city_id
          , text: d.city_name
          });
        });
        return {
          results: result
        }
      }
    }
  });

  $('.select2-educ-attainment').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "ea_name"
              , "searchable": true },
              {
                "data": "ea_id"
              , "searchable": false }
            ],
            order : [
              {
                'column' : 1,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'educ-attainment'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.ea_id
          , text: d.ea_name
          });
        });
        return {
          results: result
        }
      }
    }
  });

});
