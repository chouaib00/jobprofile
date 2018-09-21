<link href="<?php echo THEME; ?>css/bootstrap.min.css" rel="stylesheet">
<style>
#profile-img{
  width: 200px;
}
#main{
  width:100%
}

table, table tr{
  width:100%
}

</style>
<htmlpagefooter name="footer">
  <hr>
  <br>
  <div class="text-center">
    <i>"I hereby certify that the above information is true and correct to the best of my knowledge"</i>
  </div>
  <div class="text-right">
      <h5><?php echo $form_data['applicant_first_name'].' '.$form_data['applicant_middle_name'].' '.$form_data['applicant_last_name'].' '.$form_data['applicant_name_ext'] ?></h5>
  </div>
</htmlpagefooter>
<sethtmlpagefooter name="footer" value="on" />
<div id="main" class="container-fluid">
  <table>
    <tr>
      <td style="width:67%">
        <h1><?php echo $form_data['applicant_first_name'].' '.$form_data['applicant_middle_name'].' '.$form_data['applicant_last_name'].' '.$form_data['applicant_name_ext'] ?></h1>
        <p class="text-primary"><u><?php echo $form_data['applicant_email'] ?></u></p>
        <p class="text-success">
          <?php if(!empty($form_data['phone_number_1'])){ ?>
          <?php echo $form_data['phone_number_1'] ?>
          <?php }?>
          <?php if(!empty($form_data['phone_number_2'])){ ?>
          <?php echo ' / '.$form_data['phone_number_2'] ?>
          <?php }?>
          <?php if(!empty($form_data['phone_number_3'])){ ?>
          <?php echo ' / '.$form_data['phone_number_3'] ?>
          <?php }?>

        </p>
        <p><?php echo $form_data['present_add_desc']?><br><?php echo $form_data['present_add_city']['city_name'].' City, '.$form_data['present_add_province']['province_name']?><br><?php echo $form_data['present_add_region']['region_code'].'-'.$form_data['present_add_region']['region_desc'].', '.$form_data['present_add_country']['country_name']?></p>
        <br>
        <h4 class="text-primary">Skills</h4>
        <p>
          <?php foreach($form_data['skill_tag'] as $skill){ ?>
            <span class="label label-success" style="padding:1px"><strong><?php echo $skill['st_name'] ?></strong></span>
          <?php }?>
        </p>
      </td>
      <td class="text-right" style="width:33%">
        <img id="profile-img" src="<?php echo UPLOAD ?>profile/<?php echo $form_data['fm_file'] ?>">
      </td>
    </tr>
  </table>
  <br>
  <div style="padding:5px 10px">
    <p class="text-muted">
      <?php echo $form_data['applicant_summary'] ?>
    </p>
  </div>
  <hr>
  <table>
    <tr>
      <td class="text-right" style="width:35%">Civil Status</td>
      <td style="width:10%"></td>
      <td class="text-left" style="width:55%"><?php echo ucwords($form_data['applicant_civil_status']) ?></td>
    </tr>
    <tr>
      <td class="text-right" style="width:35%">Gender</td>
      <td style="width:10%"></td>
      <td class="text-left" style="width:55%"><?php echo ucwords($form_data['applicant_gender']) ?></td>
    </tr>
    <tr>
      <td class="text-right" style="width:35%">Birthdate</td>
      <td style="width:10%"></td>
      <td class="text-left" style="width:55%"><?php echo date('F j Y', strtotime($form_data['applicant_birthday'])) ?></td>
    </tr>
    <tr>
      <td class="text-right" style="width:35%">Age</td>
      <td style="width:10%"></td>
      <td class="text-left" style="width:55%"><?php echo date_diff(date_create($form_data['applicant_birthday']), date_create('now'))->y ?> years old</td>
    </tr>
    <tr>
      <td class="text-right" style="width:35%">Citizenship</td>
      <td style="width:10%"></td>
      <td class="text-left" style="width:55%"><?php echo ucwords($form_data['applicant_citizenship']) ?></td>
    </tr>
    <tr>
      <td class="text-right" style="width:35%">Highest Education Attainment</td>
      <td style="width:10%"></td>
      <td class="text-left" style="width:55%"><?php echo ucwords($form_data['applicant_educ_attainment']['ea_name']) ?></td>
    </tr>
  </table>
  <br>
  <hr>
  <?php if(!empty($form_data['education_table'])) { ?>
  <div class="educ">
    <h4 class="text-primary">Education</h4>
    <?php foreach($form_data['education_table'] as $educ){
      $duration = '';
      $diff = date_diff( date_create(empty($educ['end_date'])? 'now' : $educ['end_date']), date_create($educ['start_date']));
      $duration = (($diff->y>0)? $diff->y.' year/s / ' : '').' '.(($diff->m>0)? $diff->m.' month/s' : '');

      ?>
      <div class="">
        <h4><?php echo $educ['educ_type_desc'].' - '.$educ['school_desc'] ?></h4>
        <?php if(!empty($educ['course'])){ ?>
        <h5><?php echo $educ['course'] ?></h5>
        <?php }?>
        <h5 class="text-primary"><?php echo $educ['field_of_study_desc'] ?></h5>
        <h5 class="text-muted"><?php echo date('M Y',strtotime($educ['start_date'])).' - '.((!empty($educ['end_date']))?  date('M Y',strtotime($educ['end_date'])) : 'Present' )  ?> - (<?php echo $duration; ?>)</h5>
        <?php if($educ['add_info']){ ?>
          <small>* <u><?php echo $educ['add_info'] ?></u> </small>
        <?php } ?>
      </div>
    <?php }?>
  </div>
  <hr>
  <?php }?>
  <?php if(!empty($form_data['work_table'])) { ?>
  <div class="work">
    <h4 class="text-primary">Work Experience</h4>
    <?php foreach($form_data['work_table'] as $work){
      $duration = '';
      $diff = date_diff( date_create(empty($work['end_date'])? 'now' : $work['end_date']), date_create($work['start_date']));
      $duration = (($diff->y>0)? $diff->y.' year/s / ' : '').' '.(($diff->m>0)? $diff->m.' month/s' : '');
      ?>
      <div class="">
        <h4><?php echo $work['company_name'] ?></h4>
        <h5 class="text-primary"><?php echo $work['field_of_study_desc'] ?></h5>
        <h5 class="text-muted"><?php echo date('M Y',strtotime($work['start_date'])).' - '.((!empty($work['end_date']))?  date('M Y',strtotime($work['end_date'])) : 'Current' ) ?> - (<?php echo $duration; ?>)</h5>
        <?php if($work['add_info']){ ?>
          <small>* <u><?php echo $work['add_info'] ?></u> </small>
        <?php } ?>
      </div>
    <?php }?>
  </div>
  <?php }?>
  <br>

</div>
