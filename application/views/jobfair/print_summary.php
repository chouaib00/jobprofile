<link href="<?php echo THEME; ?>css/bootstrap.min.css" rel="stylesheet">
<style>
#profile-img{
  width: 200px;
}
#main{
  width:100%
}

.table-font{
    font-size: 11px;
}

table, table tr{
  width:100%
}

</style>
<htmlpagefooter name="footer">
  <div>
      <table>
          <tbody>
              <tr style="width:100%">
                  <td style="width:70%">
                      <p><i>Note:</i></p>
                      <p><i>1. To be accomplished by Participating Private Companies, Local and Overseas Placement Agencies and submitted daily before the closing of the Job Fair acitivity to the Host Peso</i></p>
                      <p><i>2. PESO to consolidate this form  and attached to the Post Job Fair Report to be submitted to the DOLE Field Office after five (5) working days after the Job Fair activity.</i></p>
                  </td>
                  <td class="text-right" style="width:10%">
                      Prepared By:<br>&nbsp;
                  </td>
                  <td style="width:20%">
                      <div style="border: 1px solid black;"><?php for($i=0;$i<100;$i++){ ?>&nbsp;<?php }?></div>
                      Authorized Representative(Name/Signature/Date)
                  </td>

              </tr>
          </tbody>
      </table>
  </div>
</htmlpagefooter>
<sethtmlpagefooter name="footer" value="on" />
<?php foreach($output as $key=>$employer){ ?>
    <div id="main" class="container-fluid">
        <div class="text-center">
            <p>Republic of the Philippines<br>Department of Labor and Employment</p>
            <br><p>Province of Batangas</p>
            <h4>JOB FAIR INTERVIEW RESULT FORM</h4>
        </div>
        <table>
            <tbody>
                <tr>
                    <td style="width:25%">SPONSOR / ORGANIZER</td>
                    <td style="width:50%"></td>
                    <td style="width:25%">DATE:</td>
                </tr>
                <tr>
                    <td style="width:25%; border:1px solid black">&nbsp;</td>
                    <td style="width:50%"></td>
                    <td style="width:25%; border:1px solid black">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:25%">NAME OF COMPANY:</td>
                    <td style="width:50%"></td>
                    <td style="width:25%">VENUE:</td>
                </tr>
                <tr>
                    <td style="width:25%; border:1px solid black;padding:1px"><?php echo $employer['employer_name']?></td>
                    <td style="width:50%"></td>
                    <td style="width:25%; border:1px solid black">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table table-font" border="1">
            <thead>
                <tr>
                    <th class="text-center" style="width:20%" rowspan="2" colspan="2">NAME OF APPLICANT</th>
                    <th class="text-center" style="width:15%" rowspan="2">JOB POSTED</th>
                    <th class="text-center" style="width:3%" rowspan="2">GENDER</th>
                    <th class="text-center" style="width:5%" rowspan="2">AGE</th>
                    <th class="text-center" style="width:15%" rowspan="2">ADDRESS</th>
                    <th class="text-center" style="width:10%" rowspan="2">CONTACT INFO</th>
                    <th class="text-center" style="width:27%" colspan="3">STATUS</th>
                </tr>
                <tr>
                    <th class="text-center" style="width:9%">QUALIFIED</th>
                    <th class="text-center" style="width:9%">NOT QUALIFIED</th>
                    <th class="text-center" style="width:9%">HIRED ON THE SPOT</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($employer['applicant_list'] as $applicant){ ?>
                    <tr>
                        <td style="width:2%">&nbsp;</td>
                        <td style="width:18%"><?php echo $applicant['bc_first_name'].' '.$applicant['bc_middle_name'].' '.$applicant['bc_last_name'].' '.$applicant['bc_name_ext']?></td>
                        <td><?php echo $applicant['jp_title'] ?></td>
                        <td class="text-center"><?php echo $applicant['bc_gender'] ?></td>
                        <td class="text-center"><?php echo date_diff(date_create($applicant['applicant_birthday']), date_create('now'))->y ?></td>
                        <td><?php echo $applicant['address_desc'].', '.$applicant['city_name'].', '.$applicant['province_name'] ?></td>
                        <td class="text-center"><?php echo $applicant['bc_phone_num1'] ?></td>
                        <td class="text-center"><?php echo ($applicant['aa_applicantion_status'] == '3')? 'YES' : '' ?></td>
                        <td class="text-center"><?php echo ($applicant['aa_applicantion_status'] == '1' || $applicant['aa_applicantion_status'] == '2')? 'YES' : '' ?></td>
                        <td class="text-center"><?php echo ($applicant['aa_applicantion_status'] == '4')? 'YES' : '' ?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <?php
    if ($key+1 !== count($output)){ ?>
        <pagebreak />
    <?php }?>
<?php }?>
