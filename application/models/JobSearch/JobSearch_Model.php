<?php

class JobSearch_Model extends CI_Model{

  public function getJobList($applicant_id){
    $final_list = array();

    $applicantMapper = new App\Mapper\ApplicantMapper();
    $basicContactMapper = new App\Mapper\BasicContactMapper();
    $educAttainmentMapper = new App\Mapper\EducAttainmentMapper();
    $addressMapper = new App\Mapper\AddressMapper();
    $educationMapper = new App\Mapper\EducationMapper();
    $workExperienceMapper = new App\Mapper\WorkExperienceMapper();
    $employerMapper = new App\Mapper\EmployerMapper();
    $applicantSkillMapper = new App\Mapper\ApplicantSkillMapper();
    $jobPostingMapper = new App\Mapper\JobPostingMapper();
    $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

    $applicant = $applicantMapper->getByFilter("applicant_id = '". $applicant_id ."' ", true);
    $basicContact = $basicContactMapper->getByFilter("bc_id = '".$applicant['applicant_bc_id']."'", true);
    $educAttainment = $educAttainmentMapper->getByFilter("ea_id = '".$applicant['applicant_ea_id']."'", true);
    $presentAddress = $addressMapper->getCompleteAddressByID($applicant['applicant_present_id']);
    $education = $educationMapper->getEducationTable($applicant['applicant_id']);
    $work = $workExperienceMapper->getWorkTable($applicant['applicant_id']);
    $applicantSkill = $applicantSkillMapper->getSkill($applicant['applicant_id']);


    foreach($jobPostingMapper->getAll() as $jobPosting){
      $is_qualified = true;

      if($is_qualified){
        $ageFromQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'AGE_FROM')[0];
        $ageToQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'AGE_TO')[0];
        $age = (new DateTime())->diff(new DateTime($applicant['applicant_birthday']))->y;
        if(!($ageFromQualification['jpq_value'] <= $age && $ageToQualification['jpq_value'] >= $age)){
          $is_qualified = false;
        }
      }

      if($is_qualified){
        $genderQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'GENDER');
        if(!empty($genderQualification)){
          if($basicContact['bc_gender'] != $genderQualification[0]['jpq_value']){
            $is_qualified = false;
          }
        }
      }

      if($is_qualified){
        $educAttainmentQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'EDUC_ATTAINMENT');
        if(!empty($educAttainmentQualification)){
          $isScope = false;
          foreach($educAttainmentQualification as $educAttainment){
            if($applicant['applicant_ea_id'] == $educAttainment['jpq_value']){
              $isScope = true;
            }
          }
          if(!$isScope){
            $is_qualified = false;
          }
        }
      }

      if($is_qualified){
        $skillsQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'SKILLS');
        $isScope = false;
        foreach($skillsQualification as $skillsQ){
          foreach($applicantSkill as $as){
            if($skillsQ['jpq_value'] == $as['st_id']){
              $isScope = true;
            }
          }
        }
        if(!$isScope){
          $is_qualified = false;
        }
      }

      if($is_qualified){
        $cityQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'CITY');
        if(!empty($cityQualification)){
          if($presentAddress['address_city_id'] != $cityQualification[0]['jpq_value']){
            $is_qualified = false;
          }
        }
      }

      if($is_qualified){
        $provinceQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'PROVINCE');
        if(!empty($provinceQualification)){
          if($presentAddress['city_province_id'] != $provinceQualification[0]['jpq_value']){
            $is_qualified = false;
          }
        }
      }

      if($is_qualified){
        $regionQualification = $jobPostingQualificationMapper->getQualificationOfJob($jobPosting['jp_id'], 'REGION');
        if(!empty($regionQualification)){
          if($presentAddress['region_id'] != $regionQualification[0]['jpq_value']){
            $is_qualified = false;
          }
        }
      }
      $jobPosting['employer_name'] = $employerMapper->getByFilter("employer_id = '". $jobPosting['jp_employer_id'] ."' ", true)['employer_name'];
      $jobPosting['qualified'] = $is_qualified;
      array_push($final_list, $jobPosting);

    }


    return $final_list;
  }


  public function getApplicantListFitted($qualification){
    $format = array(
      'applicant-educ-attainment' =>""// 7,6,4,5
    , 'add-region' =>"" //6
    , 'add-province' =>"" //24
    , 'add-city' =>"" //447
    , 'applicant-skills' =>""// 3,2,1
    , 'applicant-gender' =>""
    , 'age-range' =>""// 10;90
    , 'filter-type' =>"strict-match"// most-relevant
    );

    $format['age-range'] = $qualification['ageFromQualification']['jpq_value'].";".$qualification['ageToQualification']['jpq_value'];

    if(!empty($qualification['genderQualification'])){
      foreach($qualification['genderQualification'] as $gender){
        $format['applicant-gender'] = $gender['jpq_value'];
      }
    }

    if(!empty($qualification['educAttainment'])){
      $temp = array();
      foreach($qualification['educAttainment'] as $educ_attain){
        $temp[] = $educ_attain['jpq_value'];
      }
      $format['applicant-educ-attainment'] = implode (", ", $temp);
    }

    if(!empty($qualification['skillsQualification'])){
      $temp = array();
      foreach($qualification['skillsQualification'] as $skills){
        $temp[] = $skills['jpq_value'];
      }
      $format['applicant-skills'] = implode (", ", $temp);
    }

    if(!empty($qualification['cityQualification'])){
      $temp = array();
      foreach($qualification['cityQualification'] as $city){
        $temp[] = $city['jpq_value'];
      }
      $format['add-city'] = implode (", ", $temp);
    }

    if(!empty($qualification['provinceQualification'])){
      $temp = array();
      foreach($qualification['provinceQualification'] as $province){
        $temp[] = $province['jpq_value'];
      }
      $format['add-province'] = implode (", ", $temp);
    }

    if(!empty($qualification['regionQualification'])){
      $temp = array();
      foreach($qualification['regionQualification'] as $region){
        $temp[] = $region['jpq_value'];
      }
      $format['add-region'] = implode (", ", $temp);
    }

    $applicantMapper = new App\Mapper\ApplicantMapper();
    $applicant_qualified = $applicantMapper->selectByFilter($format);



    return $applicant_qualified;
  }

  public function checkIfQualified($applicant_id, $jp_id){
    $applicantMapper = new App\Mapper\ApplicantMapper();
    $basicContactMapper = new App\Mapper\BasicContactMapper();
    $educAttainmentMapper = new App\Mapper\EducAttainmentMapper();
    $addressMapper = new App\Mapper\AddressMapper();
    $educationMapper = new App\Mapper\EducationMapper();
    $workExperienceMapper = new App\Mapper\WorkExperienceMapper();
    $applicantSkillMapper = new App\Mapper\ApplicantSkillMapper();
    $jobPostingMapper = new App\Mapper\JobPostingMapper();
    $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

    $applicant = $applicantMapper->getByFilter("applicant_id = '". $applicant_id ."' ", true);
    $basicContact = $basicContactMapper->getByFilter("bc_id = '".$applicant['applicant_bc_id']."'", true);
    $educAttainment = $educAttainmentMapper->getByFilter("ea_id = '".$applicant['applicant_ea_id']."'", true);
    $presentAddress = $addressMapper->getCompleteAddressByID($applicant['applicant_present_id']);
    $education = $educationMapper->getEducationTable($applicant['applicant_id']);
    $work = $workExperienceMapper->getWorkTable($applicant['applicant_id']);
    $applicantSkill = $applicantSkillMapper->getSkill($applicant['applicant_id']);



  }

}
