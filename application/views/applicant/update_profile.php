<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12">
      <form method="POST" action="?" enctype="multipart/form-data">
          <div class="ibox">
              <div class="ibox-title">
                  <h5>Personal Information</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                          <i class="fa fa-chevron-up"></i>
                      </a>
                      <a class="fullscreen-link">
                          <i class="fa fa-expand"></i>
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
                <div class="form-horizontal">

                    <input type="hidden" name="applicant-username" value="<?php echo $form_data['applicant_username'] ?>">
                    <h5>First Name, Middle Name, Last Name, Name Extension</h5>
                    <div class="form-group">
                        <div class="col-sm-3"><input name="applicant-first-name" type="text" class="form-control" placeholder="First Name" value="<?php echo $form_data['applicant_first_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-middle-name" type="text" class="form-control" placeholder="Middle Name" value="<?php echo $form_data['applicant_middle_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-last-name" type="text" class="form-control" placeholder="Last Name" value="<?php echo $form_data['applicant_last_name'] ?>"></div>
                        <div class="col-sm-3"><input name="applicant-name-ext" type="text" class="form-control" placeholder="Name Extension" value="<?php echo $form_data['applicant_name_ext'] ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h5>Present Address</h5>
                    <div class="form-group">
                        <div class="col-sm-12"><input type="text" name="present-add-desc" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)" value="<?php echo $form_data['present_add_desc'] ?>"></div>
                        <div class="col-sm-3 m-t-sm" style="display:none">
                          <select class="form-control select2-country" name="present-add-country" data-placeholder="Select Country">
                              <option></option>
                              <option value="178" selected>Philippines</option>
                              <?php /*if($form_data['present_add_country']['country_id']){ ?>
                              <option value="<?php echo $form_data['present_add_country']['country_id'] ?>" selected><?php echo $form_data['present_add_country']['country_name'] ?></option>
                            <?php } */ ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-region" name="present-add-region" data-placeholder="Select Region" >
                              <option></option>
                              <?php if($form_data['present_add_region']['region_id']){ ?>
                              <option value="<?php echo $form_data['present_add_region']['region_id'] ?>" selected><?php echo $form_data['present_add_region']['region_code'].' - '.$form_data['present_add_region']['region_desc'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-province" name="present-add-province" data-placeholder="Select Province" <?php echo ($form_data['present_add_province']['province_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['present_add_province']['province_id']){ ?>
                              <option value="<?php echo $form_data['present_add_province']['province_id'] ?>" selected><?php echo $form_data['present_add_province']['province_name'] ?></option>
                              <?php } ?>

                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-city" name="present-add-city" data-placeholder="Select City" <?php echo ($form_data['present_add_city']['city_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['present_add_city']['city_id']){ ?>
                              <option value="<?php echo $form_data['present_add_city']['city_id'] ?>" selected><?php echo $form_data['present_add_city']['city_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                    </div>
                    <h5>Permanent Address</h5>

                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" name="permanent-add-desc" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)" value="<?php echo $form_data['permanent_add_desc'] ?>">
                      </div>
                        <div class="col-sm-3 m-t-sm" style="display:none">
                        <select class="form-control select2-country" name="permanent-add-country" data-placeholder="Select Country">
                            <option></option>
                            <option value="178" selected>Philippines</option>
                            <?php /* if($form_data['permanent_add_country']['country_id']){ ?>
                            <option value="<?php echo $form_data['permanent_add_country']['country_id'] ?>" selected><?php echo $form_data['permanent_add_country']['country_name'] ?></option>
                            <?php } */ ?>
                        </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-region" name="permanent-add-region"  data-placeholder="Select Region">
                              <option></option>
                              <?php if($form_data['permanent_add_region']['region_id']){ ?>
                              <option value="<?php echo $form_data['permanent_add_region']['region_id'] ?>" selected><?php echo $form_data['permanent_add_region']['region_code'].' - '.$form_data['permanent_add_region']['region_desc'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-province" name="permanent-add-province" data-placeholder="Select Province" <?php echo ($form_data['permanent_add_province']['province_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['permanent_add_province']['province_id']){ ?>
                              <option value="<?php echo $form_data['permanent_add_province']['province_id'] ?>" selected><?php echo $form_data['permanent_add_province']['province_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-4 m-t-sm">
                          <select class="form-control select2-city" name="permanent-add-city" data-placeholder="Select City" <?php echo ($form_data['permanent_add_city']['city_id'])? '': 'disabled' ?>>
                              <option></option>
                              <?php if($form_data['permanent_add_city']['city_id']){ ?>
                              <option value="<?php echo $form_data['permanent_add_city']['city_id'] ?>" selected><?php echo $form_data['permanent_add_city']['city_name'] ?></option>
                              <?php } ?>
                          </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <h5>Gender</h5>
                        <label class="checkbox-inline i-checks"> <input type="radio" value="male" name="applicant-gender" checked> <i></i> Male </label>
                        <label class="checkbox-inline i-checks"> <input type="radio" value="female" name="applicant-gender" <?php echo $form_data['applicant_gender'] == 'female'? 'checked': '' ?>> <i></i> Female</label>
                      </div>
                      <div class="col-sm-3">
                        <h5>Birthday</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="applicant-birthday" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php echo $form_data['applicant_birthday'] ?>">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <h5>Weight (kg)</h5>
                        <input type="number" min="0" max="200" class="form-control" name="applicant-weight" value="<?php echo $form_data['applicant_weight']  ?>"/>
                      </div>
                      <div class="col-sm-3">
                        <h5>Height (cm)</h5>
                        <input type="number" min="0" max="220" class="form-control" name="applicant-height" value="<?php echo $form_data['applicant_height']  ?>"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Civil Status</h5>
                        <select class="form-control select2-basic" name="applicant-civil-status" data-placeholder="Select Civil Status">
                            <option></option>
                            <option value="single" <?php echo $form_data['applicant_civil_status'] == 'single'? 'selected' : '' ?>>Single</option>
                            <option value="married" <?php echo $form_data['applicant_civil_status'] == 'married'? 'selected' : '' ?>>Married</option>
                            <option value="divorced" <?php echo $form_data['applicant_civil_status'] == 'divorced'? 'selected' : '' ?>>Divorced</option>
                            <option value="separated" <?php echo $form_data['applicant_civil_status'] == 'separated'? 'selected' : '' ?>>Separated</option>
                            <option value="widowed" <?php echo $form_data['applicant_civil_status'] == 'widowed'? 'selected' : '' ?>>Widowed</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <h5>Nationality</h5>
                        <select class="form-control select2-basic" name="applicant-nationality" data-placeholder="Select Nationality">
                            <option></option>
                            <option value="Afghan" <?php echo $form_data['applicant_nationality'] == 'Afghan'? 'selected' : '' ?>>Afghan</option>
                            <option value="Albanian" <?php echo $form_data['applicant_nationality'] == 'Albanian'? 'selected' : '' ?>>Albanian</option>
                            <option value="Algerian" <?php echo $form_data['applicant_nationality'] == 'Algerian'? 'selected' : '' ?>>Algerian</option>
                            <option value="Argentine Argentinian" <?php echo $form_data['applicant_nationality'] == 'Argentine Argentinian'? 'selected' : '' ?>>Argentine Argentinian</option>
                            <option value="Australian" <?php echo $form_data['applicant_nationality'] == 'Australian'? 'selected' : '' ?>>Australian</option>
                            <option value="Austrian" <?php echo $form_data['applicant_nationality'] == 'Austrian'? 'selected' : '' ?>>Austrian</option>
                            <option value="Bangladeshi" <?php echo $form_data['applicant_nationality'] == 'Bangladeshi'? 'selected' : '' ?>>Bangladeshi</option>
                            <option value="Belgian" <?php echo $form_data['applicant_nationality'] == 'Belgian'? 'selected' : '' ?>>Belgian</option>
                            <option value="Bolivian" <?php echo $form_data['applicant_nationality'] == 'Bolivian'? 'selected' : '' ?>>Bolivian</option>
                            <option value="Batswana" <?php echo $form_data['applicant_nationality'] == 'Batswana'? 'selected' : '' ?>>Batswana</option>
                            <option value="Brazilian" <?php echo $form_data['applicant_nationality'] == 'Brazilian'? 'selected' : '' ?>>Brazilian</option>
                            <option value="Bulgarian" <?php echo $form_data['applicant_nationality'] == 'Bulgarian'? 'selected' : '' ?>>Bulgarian</option>
                            <option value="Cambodian" <?php echo $form_data['applicant_nationality'] == 'Cambodian'? 'selected' : '' ?>>Cambodian</option>
                            <option value="Cameroonian" <?php echo $form_data['applicant_nationality'] == 'Cameroonian'? 'selected' : '' ?>>Cameroonian</option>
                            <option value="Canadian" <?php echo $form_data['applicant_nationality'] == 'Canadian'? 'selected' : '' ?>>Canadian</option>
                            <option value="Chilean" <?php echo $form_data['applicant_nationality'] == 'Chilean'? 'selected' : '' ?>>Chilean</option>
                            <option value="Chinese" <?php echo $form_data['applicant_nationality'] == 'Chinese'? 'selected' : '' ?>>Chinese</option>
                            <option value="Colombian" <?php echo $form_data['applicant_nationality'] == 'Colombian'? 'selected' : '' ?>>Colombian</option>
                            <option value="Costa Rican" <?php echo $form_data['applicant_nationality'] == 'Costa Rican'? 'selected' : '' ?>>Costa Rican</option>
                            <option value="Croatian" <?php echo $form_data['applicant_nationality'] == 'Croatian'? 'selected' : '' ?>>Croatian</option>
                            <option value="Cuban" <?php echo $form_data['applicant_nationality'] == 'Cuban'? 'selected' : '' ?>>Cuban</option>
                            <option value="Czech" <?php echo $form_data['applicant_nationality'] == 'Czech'? 'selected' : '' ?>>Czech</option>
                            <option value="Danish" <?php echo $form_data['applicant_nationality'] == 'Danish'? 'selected' : '' ?>>Danish</option>
                            <option value="Dominican" <?php echo $form_data['applicant_nationality'] == 'Dominican'? 'selected' : '' ?>>Dominican</option>
                            <option value="Ecuadorian" <?php echo $form_data['applicant_nationality'] == 'Ecuadorian'? 'selected' : '' ?>>Ecuadorian</option>
                            <option value="Egyptian" <?php echo $form_data['applicant_nationality'] == 'Egyptian'? 'selected' : '' ?>>Egyptian</option>
                            <option value="Salvadorian" <?php echo $form_data['applicant_nationality'] == 'Salvadorian'? 'selected' : '' ?>>Salvadorian</option>
                            <option value="English" <?php echo $form_data['applicant_nationality'] == 'English'? 'selected' : '' ?>>English</option>
                            <option value="Estonian" <?php echo $form_data['applicant_nationality'] == 'Estonian'? 'selected' : '' ?>>Estonian</option>
                            <option value="Ethiopian" <?php echo $form_data['applicant_nationality'] == 'Ethiopian'? 'selected' : '' ?>>Ethiopian</option>
                            <option value="Fijian" <?php echo $form_data['applicant_nationality'] == 'Fijian'? 'selected' : '' ?>>Fijian</option>
                            <option value="Filipino" <?php echo ucwords($form_data['applicant_nationality']) == 'Filipino'? 'selected' : '' ?>>Filipino</option>
                            <option value="Finnish" <?php echo $form_data['applicant_nationality'] == 'Finnish'? 'selected' : '' ?>>Finnish</option>
                            <option value="French" <?php echo $form_data['applicant_nationality'] == 'French'? 'selected' : '' ?>>French</option>
                            <option value="German" <?php echo $form_data['applicant_nationality'] == 'German'? 'selected' : '' ?>>German</option>
                            <option value="Ghanaian" <?php echo $form_data['applicant_nationality'] == 'Ghanaian'? 'selected' : '' ?>>Ghanaian</option>
                            <option value="Greek" <?php echo $form_data['applicant_nationality'] == 'Greek'? 'selected' : '' ?>>Greek</option>
                            <option value="Guatemalan" <?php echo $form_data['applicant_nationality'] == 'Guatemalan'? 'selected' : '' ?>>Guatemalan</option>
                            <option value="Haitian" <?php echo $form_data['applicant_nationality'] == 'Haitian'? 'selected' : '' ?>>Haitian</option>
                            <option value="Honduran" <?php echo $form_data['applicant_nationality'] == 'Honduran'? 'selected' : '' ?>>Honduran</option>
                            <option value="Hungarian" <?php echo $form_data['applicant_nationality'] == 'Hungarian'? 'selected' : '' ?>>Hungarian</option>
                            <option value="Icelandic" <?php echo $form_data['applicant_nationality'] == 'Icelandic'? 'selected' : '' ?>>Icelandic</option>
                            <option value="Indian" <?php echo $form_data['applicant_nationality'] == 'Indian'? 'selected' : '' ?>>Indian</option>
                            <option value="Indonesian" <?php echo $form_data['applicant_nationality'] == 'Indonesian'? 'selected' : '' ?>>Indonesian</option>
                            <option value="Iranian" <?php echo $form_data['applicant_nationality'] == 'Iranian'? 'selected' : '' ?>>Iranian</option>
                            <option value="Iraqi" <?php echo $form_data['applicant_nationality'] == 'Iraqi'? 'selected' : '' ?>>Iraqi</option>
                            <option value="Irish" <?php echo $form_data['applicant_nationality'] == 'Irish'? 'selected' : '' ?>>Irish</option>
                            <option value="Israeli" <?php echo $form_data['applicant_nationality'] == 'Israeli'? 'selected' : '' ?>>Israeli</option>
                            <option value="Italian" <?php echo $form_data['applicant_nationality'] == 'Italian'? 'selected' : '' ?>>Italian</option>
                            <option value="Jamaican" <?php echo $form_data['applicant_nationality'] == 'Jamaican'? 'selected' : '' ?>>Jamaican</option>
                            <option value="Japanese" <?php echo $form_data['applicant_nationality'] == 'Japanese'? 'selected' : '' ?>>Japanese</option>
                            <option value="Jordanian" <?php echo $form_data['applicant_nationality'] == 'Jordanian'? 'selected' : '' ?>>Jordanian</option>
                            <option value="Kenyan" <?php echo $form_data['applicant_nationality'] == 'Kenyan'? 'selected' : '' ?>>Kenyan</option>
                            <option value="Kuwaiti" <?php echo $form_data['applicant_nationality'] == 'Kuwaiti'? 'selected' : '' ?>>Kuwaiti</option>
                            <option value="Lao" <?php echo $form_data['applicant_nationality'] == 'Lao'? 'selected' : '' ?>>Lao</option>
                            <option value="Latvian" <?php echo $form_data['applicant_nationality'] == 'Latvian'? 'selected' : '' ?>>Latvian</option>
                            <option value="Lebanese" <?php echo $form_data['applicant_nationality'] == 'Lebanese'? 'selected' : '' ?>>Lebanese</option>
                            <option value="Libyan" <?php echo $form_data['applicant_nationality'] == 'Libyan'? 'selected' : '' ?>>Libyan</option>
                            <option value="Lithuanian" <?php echo $form_data['applicant_nationality'] == 'Lithuanian'? 'selected' : '' ?>>Lithuanian</option>
                            <option value="Malaysian" <?php echo $form_data['applicant_nationality'] == 'Malaysian'? 'selected' : '' ?>>Malaysian</option>
                            <option value="Malian" <?php echo $form_data['applicant_nationality'] == 'Malian'? 'selected' : '' ?>>Malian</option>
                            <option value="Maltese" <?php echo $form_data['applicant_nationality'] == 'Maltese'? 'selected' : '' ?>>Maltese</option>
                            <option value="Mexican" <?php echo $form_data['applicant_nationality'] == 'Mexican'? 'selected' : '' ?>>Mexican</option>
                            <option value="Mongolian" <?php echo $form_data['applicant_nationality'] == 'Mongolian'? 'selected' : '' ?>>Mongolian</option>
                            <option value="Moroccan" <?php echo $form_data['applicant_nationality'] == 'Moroccan'? 'selected' : '' ?>>Moroccan</option>
                            <option value="Mozambican" <?php echo $form_data['applicant_nationality'] == 'Mozambican'? 'selected' : '' ?>>Mozambican</option>
                            <option value="Namibian" <?php echo $form_data['applicant_nationality'] == 'Namibian'? 'selected' : '' ?>>Namibian</option>
                            <option value="Nepalese" <?php echo $form_data['applicant_nationality'] == 'Nepalese'? 'selected' : '' ?>>Nepalese</option>
                            <option value="Dutch" <?php echo $form_data['applicant_nationality'] == 'Dutch'? 'selected' : '' ?>>Dutch</option>
                            <option value="New Zealand" <?php echo $form_data['applicant_nationality'] == 'New Zealand'? 'selected' : '' ?>>New Zealand</option>
                            <option value="Nicaraguan" <?php echo $form_data['applicant_nationality'] == 'Nicaraguan'? 'selected' : '' ?>>Nicaraguan</option>
                            <option value="Nigerian" <?php echo $form_data['applicant_nationality'] == 'Nigerian'? 'selected' : '' ?>>Nigerian</option>
                            <option value="Norwegian" <?php echo $form_data['applicant_nationality'] == 'Norwegian'? 'selected' : '' ?>>Norwegian</option>
                            <option value="Pakistani" <?php echo $form_data['applicant_nationality'] == 'Pakistani'? 'selected' : '' ?>>Pakistani</option>
                            <option value="Panamanian" <?php echo $form_data['applicant_nationality'] == 'Panamanian'? 'selected' : '' ?>>Panamanian</option>
                            <option value="Paraguayan" <?php echo $form_data['applicant_nationality'] == 'Paraguayan'? 'selected' : '' ?>>Paraguayan</option>
                            <option value="Peruvian" <?php echo $form_data['applicant_nationality'] == 'Peruvian'? 'selected' : '' ?>>Peruvian</option>
                            <option value="Polish" <?php echo $form_data['applicant_nationality'] == 'Polish'? 'selected' : '' ?>>Polish</option>
                            <option value="Portuguese" <?php echo $form_data['applicant_nationality'] == 'Portuguese'? 'selected' : '' ?>>Portuguese</option>
                            <option value="Romanian" <?php echo $form_data['applicant_nationality'] == 'Romanian'? 'selected' : '' ?>>Romanian</option>
                            <option value="Russian" <?php echo $form_data['applicant_nationality'] == 'Russian'? 'selected' : '' ?>>Russian</option>
                            <option value="Saudi" <?php echo $form_data['applicant_nationality'] == 'Saudi'? 'selected' : '' ?>>Saudi</option>
                            <option value="Scottish" <?php echo $form_data['applicant_nationality'] == 'Scottish'? 'selected' : '' ?>>Scottish</option>
                            <option value="Senegalese" <?php echo $form_data['applicant_nationality'] == 'Senegalese'? 'selected' : '' ?>>Senegalese</option>
                            <option value="Serbian" <?php echo $form_data['applicant_nationality'] == 'Serbian'? 'selected' : '' ?>>Serbian</option>
                            <option value="Singaporean" <?php echo $form_data['applicant_nationality'] == 'Singaporean'? 'selected' : '' ?>>Singaporean</option>
                            <option value="Slovak" <?php echo $form_data['applicant_nationality'] == 'Slovak'? 'selected' : '' ?>>Slovak</option>
                            <option value="South African" <?php echo $form_data['applicant_nationality'] == 'South African'? 'selected' : '' ?>>South African</option>
                            <option value="Korean" <?php echo $form_data['applicant_nationality'] == 'Korean'? 'selected' : '' ?>>Korean</option>
                            <option value="Spanish" <?php echo $form_data['applicant_nationality'] == 'Spanish'? 'selected' : '' ?>>Spanish</option>
                            <option value="Sri Lankan" <?php echo $form_data['applicant_nationality'] == 'Sri Lankan'? 'selected' : '' ?>>Sri Lankan</option>
                            <option value="Sudanese" <?php echo $form_data['applicant_nationality'] == 'Sudanese'? 'selected' : '' ?>>Sudanese</option>
                            <option value="Swedish" <?php echo $form_data['applicant_nationality'] == 'Swedish'? 'selected' : '' ?>>Swedish</option>
                            <option value="Swiss" <?php echo $form_data['applicant_nationality'] == 'Swiss'? 'selected' : '' ?>>Swiss</option>
                            <option value="Syrian" <?php echo $form_data['applicant_nationality'] == 'Syrian'? 'selected' : '' ?>>Syrian</option>
                            <option value="Taiwanese" <?php echo $form_data['applicant_nationality'] == 'Taiwanese'? 'selected' : '' ?>>Taiwanese</option>
                            <option value="Tajikistani" <?php echo $form_data['applicant_nationality'] == 'Tajikistani'? 'selected' : '' ?>>Tajikistani</option>
                            <option value="Thai" <?php echo $form_data['applicant_nationality'] == 'Thai'? 'selected' : '' ?>>Thai</option>
                            <option value="Tongan" <?php echo $form_data['applicant_nationality'] == 'Tongan'? 'selected' : '' ?>>Tongan</option>
                            <option value="Tunisian" <?php echo $form_data['applicant_nationality'] == 'Tunisian'? 'selected' : '' ?>>Tunisian</option>
                            <option value="Turkish" <?php echo $form_data['applicant_nationality'] == 'Turkish'? 'selected' : '' ?>>Turkish</option>
                            <option value="Ukrainian" <?php echo $form_data['applicant_nationality'] == 'Ukrainian'? 'selected' : '' ?>>Ukrainian</option>
                            <option value="Emirati" <?php echo $form_data['applicant_nationality'] == 'Emirati'? 'selected' : '' ?>>Emirati</option>
                            <option value="British" <?php echo $form_data['applicant_nationality'] == 'British'? 'selected' : '' ?>>British</option>
                            <option value="American **" <?php echo $form_data['applicant_nationality'] == 'American **'? 'selected' : '' ?>>American **</option>
                            <option value="Uruguayan" <?php echo $form_data['applicant_nationality'] == 'Uruguayan'? 'selected' : '' ?>>Uruguayan</option>
                            <option value="Venezuelan" <?php echo $form_data['applicant_nationality'] == 'Venezuelan'? 'selected' : '' ?>>Venezuelan</option>
                            <option value="Vietnamese" <?php echo $form_data['applicant_nationality'] == 'Vietnamese'? 'selected' : '' ?>>Vietnamese</option>
                            <option value="Welsh" <?php echo $form_data['applicant_nationality'] == 'Welsh'? 'selected' : '' ?>>Welsh</option>
                            <option value="Zambian" <?php echo $form_data['applicant_nationality'] == 'Zambian'? 'selected' : '' ?>>Zambian</option>
                            <option value="Zimbabwean" <?php echo $form_data['applicant_nationality'] == 'Zimbabwean'? 'selected' : '' ?>>Zimbabwean</option>

                        </select>
                      </div>
                      <div class="col-sm-4">
                        <h5>Citizenship</h5>
                        <select class="form-control select2-basic" name="applicant-citizenship" data-placeholder="Select Citizenship">
                            <option></option>
                            <option value="Natural Born" <?php echo $form_data['applicant_citizenship'] == 'Natural Born'? 'selected' : '' ?>>Natural Born</option>
                            <option value="Dual Citizenship" <?php echo $form_data['applicant_citizenship'] == 'Dual Citizenship'? 'selected' : '' ?>>Dual Citizenship</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Religion</h5>
                        <select class="form-control select2-basic" name="applicant-religion" data-placeholder="Select Religion">
                            <option></option>
                            <option value="Roman Catholic" <?php echo $form_data['applicant_religion'] == 'Roman Catholic'? 'selected' : '' ?>>Roman Catholic</option>
                            <option value="Protestant" <?php echo $form_data['applicant_religion'] == 'Protestant'? 'selected' : '' ?>>Protestant</option>
                            <option value="Muslim" <?php echo $form_data['applicant_religion'] == 'Muslim'? 'selected' : '' ?>>Muslim</option>
                            <option value="Iglesia ni Cristo" <?php echo $form_data['applicant_religion'] == 'Iglesia ni Cristo'? 'selected' : '' ?>>Iglesia ni Cristo</option>
                            <option value="Muslim" <?php echo $form_data['applicant_religion'] == 'Aglipayan'? 'selected' : '' ?>>Aglipayan</option>
                            <option value="Buddist" <?php echo $form_data['applicant_religion'] == 'Buddist'? 'selected' : '' ?>>Buddist</option>
                            <option value="Born Again" <?php echo $form_data['applicant_religion'] == 'Born Again'? 'selected' : '' ?>>Born Again</option>
                            <option value="Seventh Day Adventist" <?php echo $form_data['applicant_religion'] == 'Seventh Day Adventist'? 'selected' : '' ?>>Seventh Day Adventist</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <h5>Employment Status</h5>
                        <select class="form-control select2-basic" name="applicant-emp-status" data-placeholder="Select Employment Status">
                            <option></option>
                            <option value="employed" <?php echo $form_data['applicant_emp_status'] == 'employed'? 'selected' : '' ?>>Employed</option>
                            <option value="unemployed" <?php echo $form_data['applicant_emp_status'] == 'unemployed'? 'selected' : '' ?>>Unemployed</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <h5>Preferred Occupation</h5>
                        <input name="applicant-preferred-occupation" type="text" class="form-control" placeholder="Enter Preferred Occupation" value="<?php echo $form_data['applicant_preferred_occupation'] ?>">
                      </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h4>Contact Details</h4>
                    <div class="form-group">
                      <div class="col-sm-4">
                        <h5>Main Contact Number</h5>
                        <input name="phone-number-1" type="text" class="form-control" placeholder="Enter Main Contact Number" value="<?php echo $form_data['phone_number_1'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Mobile Number</h5>
                        <input name="phone-number-2" type="text" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $form_data['phone_number_2'] ?>">
                      </div>
                      <div class="col-sm-4">
                        <h5>Home Number</h5>
                        <input name="phone-number-3" type="text" class="form-control" placeholder="Enter Home Number" value="<?php echo $form_data['phone_number_3'] ?>">
                      </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <h5>Highest Educational Attainment</h5>
                        <select name="applicant-educ-attainment" class="form-control select2-educ-attainment" data-placeholder="Select Highest Educational Attainment">
                            <option></option>
                            <option value="<?php echo $form_data['applicant_educ_attainment']['ea_id'] ?>" selected><?php echo $form_data['applicant_educ_attainment']['ea_name'] ?></option>
                        </select>
                      </div>
                    </div>
                    <h4>Education</h4>
                    <div class="form-group">
                      <div class="table-responsive col-md-12">
                        <table id="education-list" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th class="col-md-1 text-center no-sort">Action</th>
                              <th class="col-md-3 text-center">Type</th>
                              <th class="col-md-2 text-center">Field of Study</th>
                              <th class="col-md-6 text-center">School</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($form_data['education_table'] as $education){ ?>
                              <tr class="educ-row" data-no="<?php echo $education['no'] ?>" data-summary="<?php echo $education['data'] ?>">
                                  <td>
                                      <div class="text-center"><button type="button" disabled class="btn btn-info has-tooltip edit-row" title="Edit"><i class="fa fa-pencil"></i></button>
                                      <button type="button" disabled class="btn btn-danger has-tooltip delete-row" title="Delete" value=""><i class="fa fa-trash"></i></button></div>
                                  </td>
                                  <td><?php echo $education['educ_type_desc'] ?></td>
                                  <td><?php echo $education['field_of_study_desc'] ?></td>
                                  <td><?php echo $education['school_desc'] ?></td>
                              </tr>
                              <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <hr class="hr-line-solid"></hr>
                    <h4>Work Experience</h4>
                    <div class="form-group">
                      <div class="table-responsive col-md-12">
                        <table id="work-experience-list" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th class="col-md-1 text-center no-sort">Action</th>
                              <th class="col-md-3 text-center">Work Period</th>
                              <th class="col-md-2 text-center">Field of Work</th>
                              <th class="col-md-6 text-center">Company</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($form_data['work_table'] as $work){ ?>
                              <tr class="work-row" data-no="<?php echo $work['no'] ?>" data-summary="<?php echo $work['data'] ?>">
                                <td>
                                  <div class="text-center"><button type="button" disabled class="btn btn-info has-tooltip edit-row" title="Edit"><i class="fa fa-pencil"></i></button>
                                  <button type="button" disabled class="btn btn-danger has-tooltip delete-row" title="Delete" value=""><i class="fa fa-trash"></i></button></div>
                                </td>
                                <td><?php echo date('F-Y', strtotime($work['start_date'])).' - '.($work['end_date_current']? date('F-Y', strtotime($work['end_date'])) : 'Present') ?></td>
                                <td><?php echo $work['field_of_study_desc'] ?></td>
                                <td><?php echo $work['company_name'] ?></td>
                              </tr>
                              <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>


                  </div>
              </div>
          </div>
          <div class="ibox">
            <div class="ibox-title">
              <h5>Skill Tag</h5>
              <div class="ibox-tools">
                  <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="fullscreen-link">
                      <i class="fa fa-expand"></i>
                  </a>
              </div>
            </div>
            <div class="ibox-content form-horizontal">
              <div class="form-group">
                  <div class="col-sm-12">
                      <h4>Skills</h4>
                      <select class="select2-skill form-control" name="applicant-skills[]" data-placeholder="Select Skills" multiple="multiple">
                      <option></option>
                      <?php foreach($form_data['skill_tag'] as $skill){ ?>
                        <option value="<?php echo $skill['st_id'] ?>" selected><?php echo $skill['st_name'] ?></option>
                      <?php }?>
                    </select>
                  </div>
              </div>
            </div>
          </div>
          <div class="ibox">
            <div class="ibox-title">
              <h5>Applicant Summary</h5>
              <div class="ibox-tools">
                  <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="fullscreen-link">
                      <i class="fa fa-expand"></i>
                  </a>
              </div>
            </div>
            <div class="ibox-content form-horizontal">
              <div class="form-group">
                  <div class="col-sm-12">
                    <textarea class="form-control" name="applicant-summary" maxlength="255"><?php echo $form_data['applicant_summary'] ?></textarea>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <button id="update-profile" class="btn btn-primary col-sm-12 btn-outline" type="button">
                  <h3 class="font-bold"><i class="fa fa-id-card"></i> Update Profile</h3>
                </button>
              </div>
          </div>

        </form>
    </div>
  </div>
</div>
<?php $this->load->view('applicant/education_modal_view') ?>
<?php $this->load->view('applicant/work_modal_view') ?>

<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
