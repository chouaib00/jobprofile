$(document).ready(function(){

  $('[name=applicant-birthday]').datepicker({
      keyboardNavigation: false,
      forceParse: false,
      autoclose: true,
      format:'mm/dd/yyyy'
  });

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
