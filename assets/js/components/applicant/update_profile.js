$(document).ready(function(){

  $('#update-profile').click(function(){
    if($("form").valid()){
      helper.button_state('#update-profile', 'loading');
      let post_data = $('form').serializeArray();

      let educ_table_data = [];
      $('#education-list tbody .educ-row').each(function(){
        educ_table_data.push(JSON.parse(decodeURIComponent($(this).data('summary'))));
      });

      let work_table_data = [];
      $('#work-experience-list tbody .work-row').each(function(){
        work_table_data.push(JSON.parse(decodeURIComponent($(this).data('summary'))));
      });

      post_data.push({
        name :  'educ-table'
      , value:  JSON.stringify(educ_table_data)
      });
      post_data.push({
        name :  'work-table'
      , value:  JSON.stringify(work_table_data)
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
    }

  });

  $("form").validate({
        rules : {
            'applicant-first-name' : {
              required : true
            },
            'applicant-last-name' : {
              required : true
            },
            'applicant-birthday' : {
              required : true,
              date : true
            },
            'present-add-desc' : {
              required : true
            },
            'present-add-region' : {
              required : true
            },
            'present-add-province' : {
              required : true
            },
            'present-add-city' : {
              required : true
            },
            'permanent-add-desc' : {
              required : true
            },
            'permanent-add-country' : {
              required : true
            },
            'permanent-add-region' : {
              required : true
            },
            'permanent-add-province' : {
              required : true
            },
            'permanent-add-city' : {
              required : true
            },
            'applicant-gender' : {
              required : true
            },
            'applicant-civil-status' : {
              required : true
            },
            'applicant-nationality' : {
              required : true
            },
            'applicant-citizenship' : {
              required : true
            },
            'applicant-educ-attainment' : {
              required : true
            },
            'phone-number-1' : {
              required : true
            },
            'applicant-skills':{
              required : true
            }
        },
        messages : {
          'phone-number-1' : "At least 1 phone number is required"
        }
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

  $('.select2-skill').select2({
    maximumSelectionLength: 5,
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
      let toolbar = '<div><button type="button" id="add-education" class="btn btn-default" role="button" ><i class="fa fa-graduation-cap">&nbsp</i> ADD</button></div>';;
      $('#education-list').siblings("div.dt-toolbar").html(toolbar);
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

  $('#work-experience-list').DataTable({
    dom: '<"dt-toolbar">rt',
    initComplete: function(){
      let toolbar = '<div><button type="button" id="add-work-exp" class="btn btn-default" role="button" ><i class="fa fa-briefcase">&nbsp</i> ADD</button></div>';;
      $('#work-experience-list').siblings("div.dt-toolbar").html(toolbar);
      $('#add-work-exp').click(function(){
        work_modal_controller.clear();
        let row_no = 0;
        $('#education-list tbody tr').each(function(){
          if(row_no<=$(this).data('no')){
            row_no = $(this).data('no');
          }
        });
        row_no++;
        $("#modal-educ").data('no', row_no)

        work_modal_controller.show();
      });
    },
    fnDrawCallback: function (oSettings) {
      $('#work-experience-list .edit-row').unbind();
      $('#work-experience-list .edit-row').click(function(){
        work_modal_controller.clear();
        work_modal_controller.show();

        let row_data = JSON.parse(decodeURIComponent($(this).closest('tr').data('summary')));
        work_modal_controller.set_data(row_data);
      });
    }
  });

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
            length : 25,
            condition: []

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

  $('#modal-educ-end-date-current').change(function(e){
    if($(this).is(':checked')){
      $('#modal-educ-end-date').val('');
      $('#modal-educ-end-date').attr('disabled', true);
    }
    else{
      $('#modal-educ-end-date').attr('disabled', false);
    }
  });


  $('#modal-work-end-date-current').change(function(e){
    if($(this).is(':checked')){
      $('#modal-work-end-date').val('');
      $('#modal-work-end-date').attr('disabled', true);
    }
    else{
      $('#modal-work-end-date').attr('disabled', false);
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

      if(educ_modal_controller.validate()){
        let educ = educ_modal_controller.get_data();
        educ.data = encodeURIComponent(JSON.stringify(educ));

        let el = $('#education-list').DataTable();
        let newRow = educ_table.generate_row(educ);
        if($(this).val() == 'add'){
          el.row.add($(newRow)).draw();
        }
        if($(this).val() == 'edit'){
          let inde = $('#education-list tbody tr[data-no="' + educ.no + '"]').index()
          el.row(':eq(' + inde + ')').edit().draw();
        }
        $("#modal-educ").modal('toggle');
      }
      else{
        bootbox.alert({
            message: "Some fields are empty!",
            size: 'small'
        });
      }


    });
  },
  validate : function(){
    let isValid = true;
    if(!$('#modal-educ-school').select2("val")){
      isValid = false;
    }
    if(!$('#modal-educ-fos').select2("val")){
      isValid = false;
    }
    if(!$('#modal-educ-type').select2("val")){
      isValid = false;
    }
    if(!$('#modal-educ-start-date').val()){
      isValid = false;
    }
    if(!$('#modal-educ-end-date').val() && !$('#modal-educ-end-date-current').is(':checked')){
      isValid = false;
    }
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
    let isCurrent = $('#modal-educ-end-date-current').is(':checked');
    let endDate = (isCurrent)? null : moment().month(tempEndDate[0]).year(tempEndDate[1]).date(tempEndDate[2]).format('YYYY-MM-DD');

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

var work_table = {
  generate_row : function(params){
    console.log(params)
    return '<tr class="work-row" data-no="' + params.no + '" data-summary="' + params.data + '">' +
              '<td>' +
                '<div class="text-center"><button type="button" disabled class="btn btn-info has-tooltip edit-row" title="Edit"><i class="fa fa-pencil"></i></button> ' +
                '<button type="button" disabled class="btn btn-danger has-tooltip delete-row" title="Delete" value=""><i class="fa fa-trash"></i></button></div>'+
              '</td>' +
              '<td>' + moment(params.start_date).format('MMM-YYYY') + ' - ' + ((params.end_date)? moment(params.end_date).format('MMM-YYYY') : 'Present') + '</td>' +
              '<td>' + params.field_of_study_desc + '</td>' +
              '<td>' + params.company_name + '</td>' +
            '</tr>';
    }
}


var work_modal_controller = {
  show: function(){

    $("#modal-work").modal();
    $("#modal-work-add").unbind();
    $('#modal-work-add').click(function(){

      let work = work_modal_controller.get_data();
      work.data = encodeURIComponent(JSON.stringify(work));
      let wel = $('#work-experience-list').DataTable();
      let newRow = work_table.generate_row(work);
      if($(this).val() == 'add'){
        wel.row.add($(newRow)).draw();
      }
      if($(this).val() == 'edit'){
        let inde = $('#work-experience-list tbody tr[data-no="' + work.no + '"]').index()
        console.log(inde)
        el.row(':eq(' + inde + ')').edit().draw();
      }


      $("#modal-work").modal('toggle');
    })
  },
  validate : function(){

    let isValid = true;
    if(!$('#modal-work-fos').select2("val")){
      isValid = false;
    }
    if(!$('#modal-educ-course').val()){
      isValid = false;
    }
    if(!$('#modal-work-start-date').val()){
      isValid = false;
    }
    if(!$('#modal-work-end-date').val() && !$('#modal-work-end-date-current').is(':checked')){
      isValid = false;
    }
    if(!$('#modal-work-company-name').val()){
      isValid = false;
    }
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
    let tempStartDate = ($('#modal-work-start-date').val() + ' 01').split(' ');
    let startDate = moment().month(tempStartDate[0]).year(tempStartDate[1]).date(tempStartDate[2]).format('YYYY-MM-DD');
    let tempEndDate = ($('#modal-work-end-date').val() + ' 01').split(' ');
    let isCurrent = $('#modal-work-end-date-current').is(':checked');
    let endDate = (isCurrent)? null : moment().month(tempEndDate[0]).year(tempEndDate[1]).date(tempEndDate[2]).format('YYYY-MM-DD');
    // let duration = moment.duration(moment(endDate).diff(moment(startDate)));


    let content = {
      company_name : $('#modal-work-company-name').val()
    , field_of_study : $('#modal-work-fos').val()
    , field_of_study_desc: $('#modal-work-fos option:selected').text()
    , start_date : startDate
    , end_date : endDate
    , end_date_current : $('#modal-work-end-date-current').is(':checked')
    , add_info : $('#modal-work-add-info').val()
    , action : $('#modal-work-add').val()
    , no     : $("#modal-work").data('no')
    };
    return content;
  }
};
