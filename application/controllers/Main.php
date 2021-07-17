<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* main controller to handle main general tasks
*/
class Main extends CI_Controller
{         
    function __construct()
    {        
        parent::__construct();                  
        $this->load->model('Util_model','util_model');
        $this->load->model('Main_model','main_model');
        $this->lang->load('global',shortlang());
         
    }
    /**
    * th first function to load
    * 
    */
    function index()
    {           
        $this->home();                      
    }
    function home()
    {        

        //print_r(md5(12345));exit;
          $this->session->set_userdata('active','1');
          $data['record']=$this->main_model->getAllNews(0,config_item('per_page'));
          $data['latest']=$this->main_model->getLatestNews();
          //print_r($data['record']);exit; 
          $this->load->view('lib/header'); 
          $this->load->view('lib/slider'); 
          $content = $this->load->view('frontend/home',$data,true);   
          frame($content);  
          $this->load->view('lib/footer'); 
    }
    function changeLang($lang = "")
    {
        if($lang != "")
        {
            $this->session->set_userdata('lang',$lang);
            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        }
    }
    function home1()
    {
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->main_model->getAllNews($start,config_item('per_page'));
            $total=$this->main_model->countAllNews();
            $data['latest']=$this->main_model->getLatestNews(); 
           // ex($data['record']);
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('main/home'),
            '.nlist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword; 
            $data['start']  = $start; 
            $ajax = $this->load->view('frontend/home',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return; 
            }                                           
            $data['list']=$ajax;                        
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/news_list',$data,true);   
            frame($content); 
            $this->load->view('lib/footer');
    }

  
    function gallary()
    {   
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            }                           
            $keyword    = post('search');
            $data['record']=$this->util_model->getRecord('*','gallary',$data=array(),$start,config_item('per_page'));
            $total=$this->util_model->countTable('*','gallary');
            $data['latest']=$this->main_model->getLatestNews();
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('backend/gallaryList'),
            '.nlist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('frontend/gallary_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return; 
            }
            $data['list']=$ajax;
            $this->session->set_userdata('active','1');
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/gallary_list',$data,true);
            frame($content);
            $this->load->view('lib/footer');  
    }
    function contactUs() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('email',lang('email'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('message',lang('message'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {     
            $this->load->view('lib/header'); 
            $data['latest']=$this->main_model->getLatestNews();
            $content = $this->load->view('frontend/contact_us',$data,true); 

            frame($content);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
               $data = array(        
                    'name'=>post('name'),
                    'email'=>post('email'), 
                    'message'=>post('message'),
                    'status'=>0,
                    'message_date'=>strtotime(Date('Y-m-d'))
                    );   
                $result = $this->util_model->insertRecords($data,'contact');
                if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('main/contactUs'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('main/contactUs'));    
                }   
        }
    }
    function register() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('fname',lang('fname'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_rules('tazkira_number',lang('tazkira_number'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_rules('date_of_birth',lang('date_of_birth'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_rules('marital_status',lang('marital_status'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $data['province']=$this->main_model->getAllProvinces(); 
            $data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/register',$data,true);
            frame($content);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
            $photo=$this->util->addImage('photo','./uploads/img/member/'); 
            $dob='';
            if(shortlang()!='en')
            {
                    $post_date='';
                    $post_date = explode('-',(post('date_of_birth')));
                    $date_conv = $this->dateconverter->JalaliToGregorian($post_date[0], $post_date[1], $post_date[2]);
                    $dob=$date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
            }
            else
            {
                    $dob=post('date_of_birth');
            }  
            $data = array(        
                    'name'=>post('name'),
                    'lastname'=>post('lastname'),
                    'fname'=>post('fname'), 
                    'type'=>3,               
                    'photo'=>$photo,   
                    'regDate'=>strtotime(Date('Y-m-d')),  
                    'tazkira_number'=>post('tazkira_number'),
                    'phone_number'=>post('phone_number'),
                    'job'=>post('job'),
                    'date_of_birth'=>strtotime($dob), 
                    'marital_status'=>post('marital_status'),
                    'field_of_education'=>post('field_of_education'),
                    'level_of_education'=>post('level_of_education'),
                    );          
                $mID=''; 
                $result=0;                                                       
                $result = $this->util_model->insertRecords($data,'person');
                $mID = $this->util_model->lastId;
                if($result AND !isEmpty($mID))
                {
                    unset($result);
                    $data = array(        
                        'person_id'=>$mID,          
                        'status'=>1,
                        'r_name'=>post('recommender_name'),              
                        'r_fname'=>post('recommender_fname'),              
                        'r_job'=>post('recommender_job'),              
                        'r_address'=>post('recommender_address'),              
                        );
                     $result = $this->util_model->insertRecords($data,'member');
                     $data = array(        
                        'province'=>post('province'),
                        'district'=>post('district'),  
                        'village'=>post('village'),  
                        'person_id'=>$mID,  
                        'type'=>1,  
                        );
                     $result = $this->util_model->insertRecords($data,'address');
                     $data = array(        
                        'province'=>post('current_province'),
                        'district'=>post('current_district'),  
                        'village'=>post('current_village'),  
                        'person_id'=>$mID,  
                        'type'=>2,  
                        );
                     $result = $this->util_model->insertRecords($data,'address');
                    
                }
                if($result)
                {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('main/register'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('main/register'));    
                }   
        }
    }
    function getNewsById($newsId=0)
    {       
        if($newsId !=0)
        {
            $this->main_model->updateNewsView($newsId);
            $data['record']=$this->main_model->getNewById($newsId); 
            $data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/read_more',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
    }
    function getNoteById($nId=0)
    {       
        if($nId !=0)
        {
            $data['record']=$this->util_model->getRecord('*','redactor_note',$cond=array('id'=>$nId));
            $data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/note_detail',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
    }
    function rulesList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->main_model->getAllRules($start,config_item('per_page'));
        $data['latest']=$this->main_model->getLatestNews();
        $total=$this->main_model->countAllRules();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('main/rulesList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('frontend/rules_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('frontend/rules_list',$data,true);
        frame($content);
        $this->load->view('lib/footer');  
    }
    function presidenciesList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->main_model->getAllPresidencies($start,config_item('per_page'));
        $data['latest']=$this->main_model->getLatestNews();
        $total=$this->main_model->countAllPresidencies();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('main/presidenciesList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('frontend/presidency_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('frontend/presidency_list',$data,true);
        frame($content);
        $this->load->view('lib/footer');  
    }

    function presidencies_provinceList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->main_model->getAllProPresidencies($start,config_item('per_page'));
        //print_r($data['record']);exit;
        $data['latest']=$this->main_model->getLatestNews();
        $total=$this->main_model->countAllProPresidencies();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('main/presidencies_provinceList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('frontend/provinces_presidency_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
             
        }
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('frontend/provinces_presidency_list',$data,true);
        frame($content);
        $this->load->view('lib/footer');  
    }
    /**
    * to change lang
    * 
    * @param mixed $lang
    */
    
      /**
    * login chacking
    * 
    */
    function news_category($id=0)
    {           
      
     
    }
    function login()
    {  
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('username',lang('username'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('password',lang('password'),'required|trim',
        array('required' => lang('error').' %s.'));
        /*$this->form_validation->set_message('required', lang('username'));
        $this->form_validation->set_message('required', lang('password'));*/
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {   
            
            //$data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header');   
            $this->load->view('login');
           
            //$this->load->view('lib/footer');    
        }                          
        else
        {                 
           
            $username = post('username');
            $password = post('password');
            //print_r($username);
            if($this->util->maxAttempt($username))
            {   
                //$this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('u_or_p_incorrect').'</div>');
                redirect(site_url('main/login'));
            }                 
            else
            {
                if($this->util->login($username,md5($password)))
                {
                   $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('welcome').'</div>');
                   redirect(site_url('backend/newsList'));
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('u_or_p_incorrect').'</div>');
                    redirect(site_url('main/login'));
                }
            }
            
        } 
        
    }
    function getRuleById($ruleId=0)
    {       
        if($ruleId !=0)
        {
            $data['record']=$this->main_model->getRuleById($ruleId);
            $data['latest']=$this->main_model->getLatestNews(); 
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/rule_detail',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
        else
        {
            return false;
        }
    }
    function getOrganizationById($oId=0)
    {       
        if($oId !=0)
        {
            $data['record']=$this->util_model->getRecord('*','organization',$con=array('id'=>$oId));
            $data['latest']=$this->main_model->getLatestNews();
        
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/organization_detail',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
        else
        {
            return false;
        }
    }
    function getPresidencyById($presidencyId=0)
    {       
        print_r($presidencyId);
        if($presidencyId !=0)
        {
            $data['record']=$this->main_model->getPresidencyById($presidencyId);
            $data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/presidency_detail',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
        else
        {
            return false;
        }
    }
    function getProPresidencyById($presidencyId=0)
    {       
        print_r($presidencyId);
        if($presidencyId !=0)
        {
            $data['record']=$this->main_model->getProPresidencyById($presidencyId);
            $data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/pro_presidency_detail',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
        else
        {
            return false;
        }
    }
    function getLeaderByType($persontype=0)
    {       
        if($persontype !=0)
        {
            $data['record']=$this->main_model->getLeaderByType($persontype);
            $data['latest']=$this->main_model->getLatestNews();
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/about_leaders',$data,true);   
            frame($content);  
            $this->load->view('lib/footer');
        }
        else
        {
            return false;
        }
    }
    function booksList($personId=0)
    {
        if($personId !=0)
        {
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->main_model->getAllBooks($start,config_item('per_page'),$data=array('person_id'=>$personId));
            $data['latest']=$this->main_model->getLatestNews();
            //ex($data['record']);
			$total=$this->main_model->countAllBooks($personId); 
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('main/booksList/'.$personId),
            '.ulist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('frontend/books_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return;
                
            }
            $data['list']=$ajax;                        
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/books_list',$data,true);
            frame($content);
            $this->load->view('lib/footer');
        }  
        else
        {
            return false;
        }
    }
    function announcementsList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->main_model->getAllAnnouncements($start,config_item('per_page'));
        $data['latest']=$this->main_model->getLatestNews();
        $total=$this->main_model->countAllAnnouncements();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('main/announcementsList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('frontend/announcements_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','9');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('frontend/announcements_list',$data,true);
        frame($content);
        $this->load->view('lib/footer');  
    }
    function announcementDetail($id=0)
    {
        if($id !=0)
        {
            $data['record']=$this->util_model->getRecord('*','announcement',$content=array('id'=>$id));    
            $data['latest']=$this->main_model->getLatestNews();   
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/announcement_detail',$data,true);
            frame($content);
            $this->load->view('lib/footer'); 
        }
        else
        {
            return false;
        }
    }
    function organizationList()
      {
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->main_model->getAllOrganization($start,config_item('per_page'));
            $data['latest']=$this->main_model->getLatestNews();
            $data['latest']=$this->main_model->getLatestNews();
            $total=$this->main_model->countAllOrganization(); 
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('main/organizationList'),
            '.ulist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('frontend/organization_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return;
                
            }
            $data['list']=$ajax;
            $this->session->set_userdata('active','5');
            $this->load->view('lib/header'); 
            $content = $this->load->view('frontend/organization_list',$data,true);
            frame($content);
            $this->load->view('lib/footer');  
      }
      function get_district()
      {  
           
            $province_id='';
            $dd='district_'.shortlang();
            $province_id=$this->input->post('province_id');
            $data=$this->main_model->getAllDistrict($province_id);
            $html=''; 
            $html.='<option value="">'. 'انتخاب واسوالی.'.'</option>'; 
            foreach($data as $d)
            {
            $html.='<option value="'.$d->districtcode.'">'.$d->$dd.'</option>';
            }
            echo $html;
      }
     function getAllDistrict()
      {      
            $provinceId='';        
            if(post('province_id') AND !isEmpty(post('province_id')))
            {
                $provinceId =post('province_id');
            }                           
            if(!isEmpty($provinceId))
            {
                if($this->main_model->getAllDistrict($provinceId))
                {
                     echo '<span  style="font-size: 14px; padding:4px;background-color:#F78181">'.lang('duplicate').'</span>'; 
                }
                else
                {
                      echo '<span  style="font-size: 14px; padding:4px;background-color:#33cc00">'.lang('correct').'</span>';   
                }
            }
            else
            {
                echo '<span  style="font-size: 14px; padding:4px;background-color:#F78181">'.lang('empty').'</span>';          
            }
      }
      function newsList($id=0)
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->util_model->getRecord('*','news',$cond=array('category_id'=>$id));
        //print_r( $data['record']);exit;
        $data['latest']=$this->main_model->getLatestNews();
        $total=$this->main_model->countNewsCategory();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('main/newsList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('frontend/news/newsCategoryList_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','9');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('frontend/news/newsCategorylist',$data,true);
        frame($content);
        $this->load->view('lib/footer');  
    }
      function weeknewsList()
      {
          
          
              $start = post('start');
              if(isEmpty($start))
              {
                  $start = 0;
              } 
              $keyword    = post('search');
              $data['record']=$this->main_model->getAllWeeks($start,config_item('per_page'));
              
              $data['latest']=$this->main_model->getLatestNews();
             // print_r($data['record']);exit;
              $total=$this->main_model->countAllWeeks(); 

              $data['pagination'] = $this->paginations->make(
              $total,
              $start,
              config_item('per_page'),
              lang('paginate'),
              site_url('frontend/weeknewsList'),
              '.ulist',
              '&search='.$keyword
              );
              $data['keyword']=$keyword;
              
              $data['start']  = $start; 
              $ajax = $this->load->view('frontend/news_list_ajax',$data,true);
              if(post('ajax')!='')
              {                       
                  echo json_encode(array('result'=>$ajax));
                  return;
                  
              }
              $data['list']=$ajax;                        
              $this->load->view('lib/header'); 
              $content = $this->load->view('frontend/news_list',$data,true);
              frame($content);
              $this->load->view('lib/footer');

            
         
         
      }


      function newsCatDetails($id=0){
        if($id !=0)
       {
          $data['record']=$this->util_model->getRecord('*','news',$cond=array('category_id'=>$id));
           print_r( $data['record']);exit;
           $this->load->view('lib/header');   
           $this->load->view('home/servicesDetails',$data); 
           $this->load->view('lib/footer'); 
       }
       else
       {
           return false;
       }
   }
    /**
    * to loout
    * 
    * 
    */
    function logout()
    {
        if(!isLogin())
        {
            redirect('main/login');  
        }
        else
        {
            $this->util->logout();
            redirect('main/login');
        }
    }
}
