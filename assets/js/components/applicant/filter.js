$(document).ready(function(){


  $('.form-submit').click(function(){
    $("#filter-fields").submit();
  });

  $('#filter-applicants').click(function(){
    var filter = [];
    $('#filter .filter-field').each(function(){
      let entry = {
        name : $(this).attr("name")
      , value: $(this).val()
      };

      filter.push(entry);
    });
    console.log(filter)
  });

  $('#update-profile').click(function(){
    helper.button_state('#update-profile', 'loading');
    let post_data = $('form').serializeArray();

    let educ_table = [];
    $('#education-list tbody .educ-row').each(function(){
      educ_table.push(JSON.parse(decodeURIComponent($(this).data('summary'))));
    });

    post_data.push({
      name :  'educ-table'
    , value:  JSON.stringify(educ_table)
    });
    console.log(post_data)
    $.ajax({
			type: 'POST',
			dataType: 'json',
			url: global.site_name + 'applicant/save_profile',
			data : post_data,
      complete : function(){
        helper.button_state('#update-profile', 'loading');
      },
			success : function(result){
				if(result.success){
					window.location.reload();
				}
			}
		});


  });

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
                , "searchable": true
              },
              {   "data": "city_name"
                , "searchable": true
              },
              {   "data": "province_name"
                , "searchable": true
              },
              {   "data": "country_name"
                , "searchable": true
              },
              {   "data": "address_desc"
                , "searchable": true
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


  $('#education-list').DataTable({
    dom: '<"dt-toolbar">rt',
    initComplete: function(){
      let toolbar = '<div><button type="button" id="add-education" class="btn btn-default" role="button" ><i class="fa fa-file">&nbsp</i> ADD</button></div>';;
      $("div.dt-toolbar").html(toolbar);
      $('#add-education').click(function(){
        educ_modal_controller.clear();
        let row_no = 0;
        $('#education-list tbody tr').each(function(){
          if(row_no<=$(this).data('no')){
            row_no = $(this).data('no');
          }
        });
        row_no++;
        $("#modal-educ").data('no', row_no)

        educ_modal_controller.show();
      });
    },
    fnDrawCallback: function (oSettings) {
      $('#education-list .edit-row').unbind();
      $('#education-list .edit-row').click(function(){
        educ_modal_controller.clear();
        educ_modal_controller.show();

        let row_data = JSON.parse(decodeURIComponent($(this).closest('tr').data('summary')));
        educ_modal_controller.set_data(row_data);
      });
    }
  });

  // $('.select2-educ-type').select2({
  //   dropdownParent: $("#modal-educ-type")
  // })

  $('[name=present-add-country]').select2({
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
              , "searchable": true},
              { "data": "country_id"
              , "searchable": false
              }
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
  }).change(function(){
    if($(this).val()){
      $('[name=present-add-region]').select2("enable",true)
    }
    else{
      $('[name=present-add-region]').select2("enable",false)
    }

    $('[name=present-add-region]').select2("val", '');
  });

  $('[name=present-add-region]').select2({
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
            , value   : $('[name=present-add-country]').val()
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
      $('[name=present-add-province]').select2("enable",true)
    }
    else{
      $('[name=present-add-province]').select2("enable",false)
    }
    $('[name=present-add-province]').select2("val", '');
  });

  $('[name=present-add-province]').select2({
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
            , value   : $('[name=present-add-region]').val()
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
      $('[name=present-add-city]').select2("enable",true)
    }
    else{
      $('[name=present-add-city]').select2("enable",false)
    }
    $('[name=present-add-city]').select2("val", '');
  });

  $('[name=present-add-city]').select2({
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
            , value   : $('[name=present-add-province]').val()
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


  $('[name=permanent-add-country]').select2({
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
              , "searchable": true},
              { "data": "country_id"
              , "searchable": false
              }
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
  }).change(function(){
    if($(this).val()){
      $('[name=permanent-add-region]').select2("enable",true)
    }
    else{
      $('[name=permanent-add-region]').select2("enable",false)
    }

    $('[name=permanent-add-region]').select2("val", '');
  });

  $('[name=permanent-add-region]').select2({
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
            , value   : $('[name=permanent-add-country]').val()
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
      $('[name=permanent-add-province]').select2("enable",true)
    }
    else{
      $('[name=permanent-add-province]').select2("enable",false)
    }
    $('[name=permanent-add-province]').select2("val", '');
  });

  $('[name=permanent-add-province]').select2({
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
            , value   : $('[name=permanent-add-region]').val()
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
      $('[name=permanent-add-city]').select2("enable",true)
    }
    else{
      $('[name=permanent-add-city]').select2("enable",false)
    }
    $('[name=permanent-add-city]').select2("val", '');
  });

  $('[name=permanent-add-city]').select2({
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
            , value   : $('[name=permanent-add-province]').val()
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



}).on("keypress", "form", function(event) {
  return event.keyCode != 13;
});


var educ_table = {
  generate_row : function(params){
    console.log(params)
    return '<tr class="educ-row" data-no="' + params.no + '" data-summary="' + params.data + '">' +
              '<td>' +
                '<div class="text-center"><button type="button" disabled class="btn btn-info has-tooltip edit-row" title="Edit"><i class="fa fa-pencil"></i></button> ' +
                '<button type="button" disabled class="btn btn-danger has-tooltip delete-row" title="Delete" value=""><i class="fa fa-trash"></i></button></div>'+
              '</td>' +
              '<td>' + params.educ_type_desc + '</td>' +
              '<td>' + params.field_of_study_desc + '</td>' +
              '<td>' + params.school_desc + '</td>' +
            '</tr>';
    }
}

var educ_modal_controller = {
  show: function(){



    $("#modal-educ").modal();
    $("#modal-educ-add").unbind();
    $('#modal-educ-add').click(function(){



      let educ = educ_modal_controller.get_data();
      educ.data = encodeURIComponent(JSON.stringify(educ));
      console.log(educ)
      let el = $('#education-list').DataTable();
      let newRow = educ_table.generate_row(educ);
      if($(this).val() == 'add'){
        el.row.add($(newRow)).draw();
      }
      if($(this).val() == 'edit'){
        let inde = $('#education-list tbody tr[data-no="' + educ.no + '"]').index()
        console.log(inde)
        el.row(':eq(' + inde + ')').edit().draw();
      }


      $("#modal-educ").modal('toggle');
    })
  },
  validate : function(){
    let isValid = true;

    $('#modal-educ-school').select2("val", "");
    $('#modal-educ-fos').select2("val", "");
    $('#modal-educ-type').select2("val", "");
    $('#modal-educ-start-date').val('')
    $('#modal-educ-add-info').val('')
    $('#modal-educ-end-date-current').val('')
    $('#modal-educ-course').val('')
    $('#modal-educ-add-info').val('')
    return isValid;
  },
  clear : function(){
    $('#modal-educ-school').select2("val", "");
    $('#modal-educ-fos').select2("val", "");
    $('#modal-educ-type').select2("val", "");
    $('#modal-educ-start-date').val('')
    $('#modal-educ-end-date-date').val('')
    $('#modal-educ-add-info').val('')
    $('#modal-educ-end-date-current').val('')
    $('#modal-educ-course').val('')
    $('#modal-educ-add-info').val('')
  },
  set_data : function(content){
    console.log(content);
    $('#modal-educ-type').select2('val', content.educ_type); //Without Ajax

    //With Ajax
    $("#modal-educ-school").append('<option selected val="' + content.school + '"' + content.school_desc + '></option>');
    $("#modal-educ-school").select2('val', content.school);

    $("#modal-educ-fos").append('<option selected val="' + content.field_of_study + '"' + content.field_of_study_desc + '></option>');
    $("#modal-educ-fos").select2('val', content.field_of_study);

    $('#modal-educ-start-date').val(moment(content.start_date).format('MMMM YYYY'));
    $('#modal-educ-end-date').val(moment(content.end_date).format('MMMM YYYY'));

    $('#modal-educ-end-date-current').prop('checked', content.end_date_current);
    $('#modal-educ-course').val(content.course)
    $('#modal-educ-add-info').val(content.add_info)

    $('#modal-educ-add').val('edit')
    // let content = {
    //   school : $('#modal-educ-school').val()
    // , school_desc : $('#modal-educ-school option:selected').text()
    // , field_of_study : $('#modal-educ-fos').val()
    // , field_of_study_desc: $('#modal-educ-fos option:selected').text()
    // , educ_type : $('#modal-educ-type').val()
    // , educ_type_desc : $('#modal-educ-type option:selected').text()
    // , start_date : $('#modal-educ-start-date').val()
    // , end_date : $('#modal-educ-end-date').val()
    // , end_date_current : $('#modal-educ-end-date-current').val()
    // , course : $('#modal-educ-course').val()
    // , add_info : $('#modal-educ-add-info').val()
    // , action : $('#modal-educ-add').val()
    // };
  },
  get_data : function(){
    let tempStartDate = ($('#modal-educ-start-date').val() + ' 01').split(' ');
    let startDate = moment().month(tempStartDate[0]).year(tempStartDate[1]).date(tempStartDate[2]).format('YYYY-MM-DD');
    let tempEndDate = ($('#modal-educ-end-date').val() + ' 01').split(' ');
    let endDate = moment().month(tempEndDate[0]).year(tempEndDate[1]).date(tempEndDate[2]).format('YYYY-MM-DD');

    let content = {
      school : $('#modal-educ-school').val()
    , school_desc : $('#modal-educ-school option:selected').text()
    , field_of_study : $('#modal-educ-fos').val()
    , field_of_study_desc: $('#modal-educ-fos option:selected').text()
    , educ_type : $('#modal-educ-type').val()
    , educ_type_desc : $('#modal-educ-type option:selected').text()
    , start_date : startDate
    , end_date : endDate
    , end_date_current : $('#modal-educ-end-date-current').is(':checked')
    , course : $('#modal-educ-course').val()
    , add_info : $('#modal-educ-add-info').val()
    , action : $('#modal-educ-add').val()
    , no     : $("#modal-educ").data('no')
    };
    return content;
  }
};
