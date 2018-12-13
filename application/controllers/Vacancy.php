<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Vacancy extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function vacancy_list()
    {
        $this->is_secure = true;

        if ($_SESSION['current_user']['type'] == '3') {
            $employerMapper = new App\Mapper\EmployerMapper();
            $employer = $employerMapper->getByFilter("employer_user_id = '".$_SESSION['current_user']['id']."'", true);
            $this->_data['employer_id'] = $employer['employer_id'];
            $this->view('vacancy/posted_job_vacancy');
        } else {
            $this->view('vacancy/vacancy_list');
        }
    }

    public function view_vacancy_ref($jp_id)
    {
        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();
		$jobFairMapper = new App\Mapper\JobFairMapper();



        $jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);
        echo $jobPosting['jp_description'];
    }

    public function shift_status()
    {
        $applicantApplicationMapper = new App\Mapper\ApplicantApplicationMapper();
        $input = $_POST;
        if ($input['method'] == 'application') {
            $applicantApplicationMapper->update(array(
                    'aa_applicantion_status' => $input['new-status']
                ,	'aa_action_date' => ($input['new-status'] != '1')? date('Y-m-d H:i:s') : null
            ), "aa_id = '".$input['aa-id']."'");


            $this->notifyApplicationStatus($input['aa-id']);
        } elseif ($input['method'] == 'non-application') {
            //Check if already added
            $applicantApplication = $applicantApplicationMapper->getByFilter("aa_jp_id = '".$input['jd-id']."' AND aa_applicant_id = '".$input['applicant-id']."'", true);
            if (empty($applicantApplication)) {
                //insert
                $aa_id = $applicantApplicationMapper->insert(array(
                    'aa_jp_id' => $input['jd-id']
                ,	'aa_applicant_id' => $input['applicant-id']
                ,	'aa_applicantion_status' => $input['new-status']
                ,	'aa_application_date' => date('Y-m-d H:i:s')
                ,	'aa_action_date' => ($input['new-status'] != '1')? date('Y-m-d H:i:s') : null
                ,	'aa_cover_letter' => ""
                ));
                $this->notifyApplicationStatus($aa_id);
            } else {
                $applicantApplicationMapper->update(array(
                        'aa_applicantion_status' => $input['new-status']
                    ,	'aa_action_date' => ($input['new-status'] != '1')? date('Y-m-d H:i:s') : null
                ), "aa_id = '".$applicantApplication['aa_id']."'");
                $this->notifyApplicationStatus($input['aa-id']);
            }
        }

        echo json_encode(array('success' => true));
    }

    private function notifyApplicationStatus($aa_id)
    {
        $applicantApplicationMapper = new App\Mapper\ApplicantApplicationMapper();
        $applicantMapper = new App\Mapper\ApplicantMapper();
        $basicContactMapper = new App\Mapper\BasicContactMapper();
        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $employerMapper = new App\Mapper\EmployerMapper();
        $userMapper = new App\Mapper\UserMapper();
        $notificationMapper = new App\Mapper\NotificationMapper();

        $applicantApplication = $applicantApplicationMapper->getByFilter("aa_id = '".$aa_id."'", true);
        $applicant = $applicantMapper->getByFilter("applicant_id = '".$applicantApplication['aa_applicant_id']."'", true);
        $applicantUser = $userMapper->getByFilter("user_id = '".$applicant['applicant_user_id']."'", true);
        $basicContact = $basicContactMapper->getByFilter("bc_id = '".$applicant['applicant_bc_id']."'", true);
        $jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$applicantApplication['aa_jp_id']."'", true);
        $employer = $employerMapper->getByFilter("employer_id = '".$jobPosting['jp_employer_id']."'", true);
        $employerUser = $userMapper->getByFilter("user_id = '".$employer['employer_user_id']."'", true);
        //$notif_message = $employer['employer_name']. ' has posted a JOB "'.$jp['jp_title'].'"';
        //$link = DOMAIN.'vacancy/view-vacancy/'.$jp_id;
        $applicant_name = $basicContact['bc_first_name'].' '.$basicContact['bc_middle_name'].' '.$basicContact['bc_last_name'].' '.$basicContact['bc_name_ext'];
        $status = "";
        switch ($applicantApplication['aa_applicantion_status']) {
            case '1':
                //Applied
                $status = 'Applied';
            break;
            case '2':
                //Rejected
                $status = 'Rejected';
            break;
            case '3':
                //Reviewing
                $status = 'Reviewing';
            break;
            case '4':
                //Hired
                $status = 'Hired';
            break;
        }
        $link = DOMAIN.'vacancy/view-vacancy/'.$jobPosting['jp_id'];
        $notif_message = $employer['employer_name']. ' has marked '.$applicant_name.' "'.$status.'" from the posted job vacancy "'.$jobPosting['jp_title'].'"';
        $notificationMapper->insert(array(
            'notif_user_id' => $applicantUser['user_id'],
            'notif_message' => $notif_message,
            'notif_link' => $link
        ));

        $this->load->library('email', $this->config->item('email'));

        $message = '<p style="text-align: center;"><span style="font-size: 24px;">'.$applicant_name.'&nbsp;</span>
									<br><span style="font-size: 24px;">HAS BEEN MARKED "<b>'.strtoupper($status).'</b>"</span></p>
								<p style="text-align: center;"><a href="http://www.pesojobprofiling.com/'.$link.'"><span style="font-size: 30px;"><u>'.$jobPosting['jp_title'].'</u></span></a></p>
								<p style="text-align: center;">'.$jobPosting['jp_description'].'</p>
								<p style="text-align: center;"><a href="http://www.pesojobprofiling.com" rel="noopener noreferrer" target="_blank">www.pesojobprofiling.com</a></p><address style="text-align: center;">&nbsp;P. Dandan st. CCYA bldg.<br>Batangas City, Batangas&nbsp;</address><address style="text-align: center;">&nbsp;723-8802<br>&nbsp;<a href="mailto:#">pesobatangascity@yahoo.com.ph</a>&nbsp;</address>
								<p style="text-align: center;">Copyright &copy; Public Employment Service Office - Batangas City 2018</p>';

        $this->email->from($employerUser['user_email'], $employer['employer_name']);
        $this->email->to($applicantUser['user_email']);
        $this->email->bcc($this->config->item('email')['smtp_user']);
        $this->email->subject($notif_message);
        $this->email->message($message);
        $this->email->send();
    }

    public function job_feed()
    {
        $userMapper = new App\Mapper\UserMapper();
        $applicantMapper = new App\Mapper\ApplicantMapper();
        $user = $userMapper->getByFilter(array(
            array(
                'column' => 'user_id'
            ,	'value' => $_SESSION['current_user']['id']
            )
        ), true);

        $applicant = $applicantMapper->getByFilter("applicant_user_id = '". $user['user_id']."' ", true);
        $this->load->model('JobSearch/JobSearch_Model');
        $searchResult = $this->JobSearch_Model->getJobList($applicant['applicant_id']);
        krsort($searchResult);
        $this->_data['feed'] = $searchResult;
        $this->is_secure = true;
        $this->view('vacancy/job_feed');
    }

    public function my_application()
    {
        $userMapper = new App\Mapper\UserMapper();
        $applicantMapper = new App\Mapper\ApplicantMapper();
        $jobFairMapper = new App\Mapper\JobFairMapper();
        $applicantApplicationMapper = new App\Mapper\ApplicantApplicationMapper();
        $user = $userMapper->getByFilter(array(
            array(
                'column' => 'user_id'
            ,	'value' => $_SESSION['current_user']['id']
            )
        ), true);
        $jf_id = $jobFairMapper->getActive();
        $applicant = $applicantMapper->getByFilter("applicant_user_id = '". $user['user_id']."' ", true);
        $searchResult = $applicantApplicationMapper->getMyApplication($applicant['applicant_id'], $jf_id);
        $this->_data['application_list'] = $searchResult;
        ;
        $this->is_secure = true;
        $this->view('vacancy/my_application');
    }

    public function vacancy_ref()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $search = $_POST['search'];
        $columns = $_POST['columns'];
        $employer = (isset($_POST['employer']))? $_POST['employer'] : '';
		$jobFairMapper = new App\Mapper\JobFairMapper();
		$jf_id = $jobFairMapper->getActive();
        $orders = array();

        foreach ($_POST['order'] as $_order) {
            array_push($orders, array(
                'col' => $_POST['columns'][$_order['column']]['data']
            ,	'type' => $_order['dir']
            ));
        }
        $mapper = new App\Mapper\JobPostingMapper();
        $result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders, $employer, $jf_id);
        echo json_encode($result);
    }

    public function pjobv_ref()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $search = $_POST['search'];
        $columns = $_POST['columns'];
        $orders = array();

        foreach ($_POST['order'] as $_order) {
            array_push($orders, array(
                'col' => $_POST['columns'][$_order['column']]['data']
            ,	'type' => $_order['dir']
            ));
        }
        $mapper = new App\Mapper\JobPostingMapper();
        $result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);
        echo json_encode($result);
    }

    public function delete_vacancy()
    {
        $param = $_POST;
        $jp_id = $param['id'];

        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

        $jobPostingMapper->delete("jp_id = '".$jp_id."'");
        $jobPostingQualificationMapper->delete("jpq_jp_id = '".$jp_id."'");

        echo json_encode(array(
            "success" => 1
        ));
    }

    public function post_vacancy()
    {
        $input = $_POST;
        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();
        $employerMapper = new App\Mapper\EmployerMapper();
        $notificationMapper = new App\Mapper\NotificationMapper();
        $userMapper = new App\Mapper\UserMapper();
        $jobFairMapper = new App\Mapper\JobFairMapper();
        $employer = array();
        if ($_SESSION['current_user']['type'] == '3') {
            $employer = $employerMapper->getByFilter("employer_user_id = '". $_SESSION['current_user']['id']."' ", true);
        }
        $current_user = $userMapper->getByFilter("user_id = '".$_SESSION['current_user']['id']."'", true);

        $this->_data['employer'] = $employer;

        if (!empty($input)) {
            $jp = array(
                'jp_title' => $input['vacancy-title']
            ,	'jp_jf_id' => $jobFairMapper->getActive()
            ,	'jp_employer_id' => (isset($input['employer']))? $input['employer'] : $employer['employer_id']
            ,	'jp_date_posted' => date('Y-m-d H:i:s')
            ,	'jp_description' => $input['vacancy-description']
            ,	'jp_open' => true
        );
            $jp_id = $jobPostingMapper->insert($jp);

            $qualification = $this->format_qualification($input);
            foreach ($qualification as $entry) {
                $jobPostingQualificationMapper->insert(array(
                    'jpq_jp_id' => $jp_id
                ,	'jpq_key' => $entry['key']
                ,	'jpq_value' => $entry['value']
                ,	'jpq_is_strict' => true
                ));
            }


            if (!empty($employer)) {
                $notif_message = $employer['employer_name']. ' has posted a JOB "'.$jp['jp_title'].'"';
                $link = DOMAIN.'vacancy/view-vacancy/'.$jp_id;
                $notificationMapper->insert(array(
                    'notif_user_id' => '1',
                    'notif_message' => $notif_message,
                    'notif_link' => $link
                ));

                $this->load->library('email', $this->config->item('email'));

                $message = '<p style="text-align: center;"><span style="font-size: 24px;">'.$employer['employer_name'].'&nbsp;</span>
											<br><span style="font-size: 24px;">HAS POSTED A JOB</span></p>
										<p style="text-align: center;"><a href="http://www.pesojobprofiling.com/'.$link.'"><span style="font-size: 30px;"><u>'.$jp['jp_title'].'</u></span></a></p>
										<p style="text-align: center;">'.$jp['jp_description'].'</p>
										<p style="text-align: center;"><a href="http://www.pesojobprofiling.com" rel="noopener noreferrer" target="_blank">www.pesojobprofiling.com</a></p><address style="text-align: center;">&nbsp;P. Dandan st. CCYA bldg.<br>Batangas City, Batangas&nbsp;</address><address style="text-align: center;">&nbsp;723-8802<br>&nbsp;<a href="mailto:#">pesobatangascity@yahoo.com.ph</a>&nbsp;</address>
										<p style="text-align: center;">Copyright &copy; Public Employment Service Office - Batangas City 2018</p>';

                $this->email->from($current_user['user_email'], $employer['employer_name']);
                $this->email->to('admin@pesojobprofiling.com');
                $this->email->bcc($this->config->item('email')['smtp_user']);
                $this->email->subject($notif_message);
                $this->email->message($message);
                $this->email->send();
            }


            $this->set_alert(array(
                'message' => '<i class="fa fa-thumb-tack"></i> Successfully posted a job vacancy!'
            ,	'type' => 'success'
            ,	'href' => DOMAIN.'vacancy/vacancy-list'
            ,	'text' => 'All Job Vacancy List'
            ));
        }
        $form_data = array(
            'jp_title' => ''
        ,	'jp_description' => ''
        ,	'jp_open' => '1'
        ,	'employer' => array(
                'employer_id' => ''
            ,	'employer_name' => ''
            )
        ,	'gender_qualification' => array()
        ,	'educ_qualification' => array()
        ,	'agefrom_qualification' => array()
        ,	'ageto_qualification' => array()
        ,	'skill_qualification' => array()
        ,	'city_qualification' => array()
        ,	'province_qualification' => array()
        ,	'region_qualification' => array()
        );
        $this->_data['form_data'] = $form_data;
        $this->is_secure = true;
        $this->view('vacancy/post_vacancy');
    }

    public function edit_vacancy($jp_id)
    {
        $input = $_POST;
        $employerMapper = new App\Mapper\EmployerMapper();
        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();
        $employerMapper = new App\Mapper\EmployerMapper();
        $employer = array();
        if ($_SESSION['current_user']['type'] == '3') {
            $employer = $employerMapper->getByFilter("employer_user_id = '". $_SESSION['current_user']['id']."' ", true);
        }


        $jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);

        if (!empty($input)) {
            $jobPostingMapper->update(array(
                'jp_title' => $input['vacancy-title']
            ,	'jp_employer_id' => (isset($input['employer']))? $input['employer'] : $employer['employer_id']
            ,	'jp_description' => $input['vacancy-description']
            ,	'jp_open' => isset($input['is-open'])? 1 : 0
        ), "jp_id = '".$jp_id."'");
            $jobPostingQualificationMapper->delete("jpq_jp_id = '".$jp_id."'");
            $qualification = $this->format_qualification($input);
            foreach ($qualification as $entry) {
                $jobPostingQualificationMapper->insert(array(
                    'jpq_jp_id' => $jp_id
                ,	'jpq_key' => $entry['key']
                ,	'jpq_value' => $entry['value']
                ,	'jpq_is_strict' => true
                ));
            }
            $this->set_alert(array(
                'message' => '<i class="fa fa-thumb-tack"></i> Successfully updated a job vacancy!'
            ,	'type' => 'success'
            ,	'href' => DOMAIN.'vacancy/vacancy-list'
            ,	'text' => 'All Job Vacancy List'
            ));
        }
        $jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);

        $employer = $employerMapper->getByFilter("employer_id = '".$jobPosting['jp_employer_id']."'", true);

        $ageFromQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_FROM')[0];
        $ageToQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_TO')[0];
        $genderQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'GENDER');
        $educAttainment = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'EDUC_ATTAINMENT');
        $skillsQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'SKILLS');
        $cityQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'CITY');
        $provinceQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'PROVINCE');
        $regionQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'REGION');

        $form_data = array(
            'jp_title' => $jobPosting['jp_title']
        ,	'jp_description' => $jobPosting['jp_description']
        ,	'jp_open' => ($jobPosting['jp_open'])? '1':'0'
        ,	'employer' => array(
                'employer_id' => $employer['employer_id']
            ,	'employer_name' => $employer['employer_name']
            )
        ,	'gender_qualification' => $genderQualification
        ,	'educ_qualification' => $educAttainment
        ,	'agefrom_qualification' => $ageFromQualification
        ,	'ageto_qualification' => $ageToQualification
        ,	'skill_qualification' => $skillsQualification
        ,	'city_qualification' => $cityQualification
        ,	'province_qualification' => $provinceQualification
        ,	'region_qualification' => $regionQualification
        );

        $this->_data['form_data'] = $form_data;
        $this->_data['employer'] = $employer;
        $this->is_secure = true;
        $this->view('vacancy/post_vacancy');
    }

    public function view_vacancy($jp_id)
    {
        if ($_SESSION['current_user']['type'] == '2') {
            $this->redirect(DOMAIN.'vacancy/apply-vacancy/'.$jp_id);
        }


        $input = $_POST;
        $employerMapper = new App\Mapper\EmployerMapper();
        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $applicantMapper = new App\Mapper\ApplicantMapper();
        $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

        $applicantApplicationMapper = new App\Mapper\ApplicantApplicationMapper();
        $applicantApplication = $applicantApplicationMapper->getApplicantApplicationByJPID($jp_id);

        $jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);

        $employer = $employerMapper->getByFilter("employer_id = '".$jobPosting['jp_employer_id']."'", true);
        $ageFromQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_FROM')[0];
        $ageToQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_TO')[0];
        $genderQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'GENDER');
        $educAttainment = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'EDUC_ATTAINMENT');
        $skillsQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'SKILLS');
        $cityQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'CITY');
        $provinceQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'PROVINCE');
        $regionQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'REGION');

        $qualification = array(
            'ageFromQualification' => $ageFromQualification
        ,	'ageToQualification' => $ageToQualification
        ,	'genderQualification' => $genderQualification
        ,	'educAttainment' => $educAttainment
        ,	'skillsQualification' => $skillsQualification
        ,	'cityQualification' => $cityQualification
        ,	'provinceQualification' => $provinceQualification
        ,	'regionQualification' => $regionQualification
        );


        $this->load->model('JobSearch/JobSearch_Model');
        $filterApplicantList = $this->JobSearch_Model->getApplicantListFitted($qualification);
        $applicant_qualified = array();
        foreach ($filterApplicantList as $_applicant) {
            array_push($applicant_qualified, $_applicant['applicant_id']);
        }
        $applicant_id_application = array();
        foreach ($applicantApplication as $_applicant) {
            array_push($applicant_id_application, $_applicant['applicant_id']);
        }
        $applicant_other_qualify = $applicantMapper->getApplicantByIDWithExclusion(
            implode($applicant_qualified, ", "),
                                                            implode($applicant_id_application, ", ")
        );

        $form_data = array(
            'jp_title' => $jobPosting['jp_title']
        ,	'jp_id' => $jp_id
        ,	'jp_description' => $jobPosting['jp_description']
        ,	'jp_open' => ($jobPosting['jp_open'])? '1':'0'
        ,	'employer' => array(
                'employer_id' => $employer['employer_id']
            ,	'employer_name' => $employer['employer_name']
            )
        ,	'gender_qualification' => $genderQualification
        ,	'educ_qualification' => $educAttainment
        ,	'agefrom_qualification' => $ageFromQualification
        ,	'ageto_qualification' => $ageToQualification
        ,	'skill_qualification' => $skillsQualification
        ,	'city_qualification' => $cityQualification
        ,	'province_qualification' => $provinceQualification
        ,	'region_qualification' => $regionQualification
        ,	'applicant_application' => $applicantApplication
        ,	'applicant_other_qualify' => $applicant_other_qualify
        );

        $this->_data['form_data'] = $form_data;
        $this->is_secure = true;
        $this->view('vacancy/view_vacancy');
    }

    public function apply_vacancy($jp_id)
    {
        $input = $_POST;
        $employerMapper = new App\Mapper\EmployerMapper();
        $userMapper = new App\Mapper\UserMapper();
        $jobPostingMapper = new App\Mapper\JobPostingMapper();
        $applicantMapper = new App\Mapper\ApplicantMapper();
        $basicContactMapper = new App\Mapper\BasicContactMapper();
        $applicantApplicationMapper = new App\Mapper\ApplicantApplicationMapper();
        $jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();
        $notificationMapper = new App\Mapper\NotificationMapper();
        $jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);

        $applicant = $applicantMapper->getByFilter("applicant_user_id = '".$_SESSION['current_user']['id']."'", true);
        $applicantUser = $userMapper->getByFilter("user_id = '".$applicant['applicant_user_id']."'", true);
        $basicContact = $basicContactMapper->getByFilter("bc_id = '".$applicant['applicant_bc_id']."'", true);
        $employer = $employerMapper->getByFilter("employer_id = '".$jobPosting['jp_employer_id']."'", true);
        $employerUser = $userMapper->getByFilter("user_id = '".$employer['employer_user_id']."'", true);
        $ageFromQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_FROM')[0];
        $ageToQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_TO')[0];
        $genderQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'GENDER');
        $educAttainment = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'EDUC_ATTAINMENT');
        $skillsQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'SKILLS');
        $cityQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'CITY');
        $provinceQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'PROVINCE');
        $regionQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'REGION');
        if (!empty($input)) {
            $applicantApplicationMapper->insert(array(
                'aa_jp_id' => $jp_id
            ,	'aa_applicant_id' => $applicant['applicant_id']
            ,	'aa_applicantion_status' => '1'
            ,	'aa_application_date' => date('Y-m-d H:i:s')
            ,	'aa_cover_letter' => $input['cover-letter']
            ));
            $applicant_name = $basicContact['bc_first_name'].' '.$basicContact['bc_middle_name'].' '.$basicContact['bc_last_name'].' '.$basicContact['bc_name_ext'];
            $notif_message = $applicant_name.' applied in the job "'.$jobPosting['jp_title'].'"';
            $link = DOMAIN.'vacancy/view-vacancy/'.$jp_id;
            $notificationMapper->insert(array(
                'notif_user_id' => $employer['employer_user_id'],
                'notif_message' => $notif_message,
                'notif_link' => $link
            ));

            $this->load->library('email', $this->config->item('email'));
            $message = '<p style="text-align: center;"><span style="font-size: 24px;">'.$applicant_name.'&nbsp;</span>
										<br><span style="font-size: 24px;">Applied in the job </span></p>
									<p style="text-align: center;"><a href="http://www.pesojobprofiling.com'.$link.'"><span style="font-size: 30px;"><u>'.$jobPosting['jp_title'].'</u></span></a><br><span style="font-size: 18;">'.$employer['employer_name'].'</span></p>
									<p style="text-align: center;">"'.$input['cover-letter'].'"</p>
									<p style="text-align: center;"><a href="http://www.pesojobprofiling.com" rel="noopener noreferrer" target="_blank">www.pesojobprofiling.com</a></p><address style="text-align: center;">&nbsp;P. Dandan st. CCYA bldg.<br>Batangas City, Batangas&nbsp;</address><address style="text-align: center;">&nbsp;723-8802<br>&nbsp;<a href="mailto:#">pesobatangascity@yahoo.com.ph</a>&nbsp;</address>
									<p style="text-align: center;">Copyright &copy; Public Employment Service Office - Batangas City 2018</p>';

            $this->email->from($applicantUser['user_email'], $employer['employer_name']);
            $this->email->to($employerUser['user_email']);
            $this->email->bcc($this->config->item('email')['smtp_user']);
            $this->email->subject($notif_message);
            $this->email->message($message);
            $this->email->send();

            $this->set_alert(array(
                'message' => '<i class="fa fa-thumb-tack"></i> You have successfully Applied to this Job!'
            ,	'type' => 'success'
            ));
        }
        $applicantApplication = $applicantApplicationMapper->getByFilter("aa_applicant_id = '".$applicant['applicant_id']."' AND aa_jp_id = '".$jp_id."'", true);

        $form_data = array(
            'jp_title' => $jobPosting['jp_title']
        ,	'jp_description' => $jobPosting['jp_description']
        ,	'jp_open' => ($jobPosting['jp_open'])? '1':'0'
        ,	'employer' => array(
                'employer_id' => $employer['employer_id']
            ,	'employer_name' => $employer['employer_name']
            )
        ,	'gender_qualification' => $genderQualification
        ,	'educ_qualification' => $educAttainment
        ,	'agefrom_qualification' => $ageFromQualification
        ,	'ageto_qualification' => $ageToQualification
        ,	'skill_qualification' => $skillsQualification
        ,	'city_qualification' => $cityQualification
        ,	'province_qualification' => $provinceQualification
        ,	'region_qualification' => $regionQualification
        ,	'applicant_application' => $applicantApplication
        );

        $this->_data['form_data'] = $form_data;
        $this->is_secure = true;
        $this->view('vacancy/apply_vacancy');
    }

    private function format_qualification($input)
    {
        $row_format = array(
            'key' => ''
        ,	'value' => ''
        );
        $output = array();

        if (!empty($input['applicant-gender'])) {
            $gender = $row_format;
            $gender['key'] = 'GENDER';
            $gender['value'] = $input['applicant-gender'];
            array_push($output, $gender);
        }

        if (!empty($input['applicant-educ-attainment'])) {
            foreach ($input['applicant-educ-attainment'] as $educ_attainment) {
                $gender = $row_format;
                $gender['key'] = 'EDUC_ATTAINMENT';
                $gender['value'] = $educ_attainment;
                array_push($output, $gender);
            }
        }

        if (!empty($input['age-range'])) {
            $age_range = json_decode($input['age-range'], true);
            $age_from = $row_format;
            $age_from['key'] = 'AGE_FROM';
            $age_from['value'] = explode(";", $age_range[0]['value'])[0];
            array_push($output, $age_from);
            $age_to = $row_format;
            $age_to['key'] = 'AGE_TO';
            $age_to['value'] = explode(";", $age_range[0]['value'])[1];
            array_push($output, $age_to);
        }

        if (!empty($input['applicant-skills'])) {
            foreach ($input['applicant-skills'] as $applicant_skills) {
                $skills = $row_format;
                $skills['key'] = 'SKILLS';
                $skills['value'] = $applicant_skills;
                array_push($output, $skills);
            }
        }

        if (!empty($input['add-region'])) {
            $region = $row_format;
            $region['key'] = 'REGION';
            $region['value'] = $input['add-region'];
            array_push($output, $region);
        }

        if (!empty($input['add-province'])) {
            $province = $row_format;
            $province['key'] = 'PROVINCE';
            $province['value'] = $input['add-province'];
            array_push($output, $province);
        }

        if (!empty($input['add-city'])) {
            $city = $row_format;
            $city['key'] = 'CITY';
            $city['value'] = $input['add-city'];
            array_push($output, $city);
        }

        return $output;
    }
}
