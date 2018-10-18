$(document).ready(function(){

  // $('.form-submit-add-new').click(function(){
  //   $('[name=add-again]').val('1');
  //   $("#"+$(this).data('form')).submit();
  // });
  $('#post-job-vacancy').click(function(){
    var filter = [];
    filter.push({
      name : 'age-range'
    , value: $("#age-range").attr("value")
    });

    $('[name=age-range]').val(JSON.stringify(filter))
    $('#main-form').submit();
  });

  $("#main-form").validate({
    rules :{
      'vacancy-title':{
        required : true,
        maxlength:64
      },
      'employer':{
        required : true
      }

    }

  });

  $("#age-range").ionRangeSlider({
      min: 10,
      max: 90,
      from: $("#age-range").data('default').split(';')[0],
      to: $("#age-range").data('default').split(';')[1],
      type: 'double',
      postfix: " years",
      maxPostfix: "+",
      prettify: true,
      hasGrid: true
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
              {   "data": "ea_name"
                , "searchable": true
              },
              {   "data"  : "ea_id"
                , "searchable": false
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

  $('[name=employer]').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'employer/employer-ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {   "data": "employer_name"
                , "searchable": true
              },
              {   "data"  : "employer_id"
                , "searchable": false
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
            },
            order : [
              {
                'column':'0'
              , 'dir' : 'asc'
              }
            ],
            start : 0,
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.employer_id
          , text: d.employer_name
          });
        });
        return {
          results: result
        }
      }
    }
  });

  $('.select2-skill').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {   "data": "st_name"
                , "searchable": true
              },
              {   "data"  : "st_id"
                , "searchable": false
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'skill'
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
            id  : d.st_id
          , text: d.st_name
          });
        });
        return {
          results: result
        }
      }
    }
  });



  $('[name=add-region]').select2({
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
              , "searchable": false },
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
            length : 25,
            condition:[]

          };
          option.condition.push({
              column  : 'country_id'
            , value   : '178'
          });
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
  }).change(function(){
    if($(this).val()){
      $('[name=add-province]').select2("enable",true)
    }
    else{
      $('[name=add-province]').select2("enable",false)
    }
    $('[name=add-province]').select2("val", '');
  });

  $('[name=add-province]').select2({
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
            length : 25,
            condition:[]
          };
          option.condition.push({
              column  : 'region_id'
            , value   : $('[name=add-region]').val()
          });
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
  }).change(function(){
    if($(this).val()){
      $('[name=add-city]').select2("enable",true)
    }
    else{
      $('[name=add-city]').select2("enable",false)
    }
    $('[name=add-city]').select2("val", '');
  });

  $('[name=add-city]').select2({
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
            length : 25,
            condition:[]
          };
          option.condition.push({
              column  : 'province_id'
            , value   : $('[name=add-province]').val()
          });
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

});
