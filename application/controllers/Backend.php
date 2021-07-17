<?php
/**
* home controller
*/
  class Backend extends CI_Controller
  {
      /**
      * constructor of class
      * 
      */
      function __construct()
      {
          parent::__construct();
          //check login
          checkLogin();
          $this->load->library('image_lib'); 
          $this->load->model('Util_model','util_model');  
          $this->load->model('Backend_model','backend_model');  
          $this->lang->load('global',shortlang());
      }
      /**
      * index function 
      * 
      */
      function index()
      {
           $this->newsList();
      }
    
    function newsList()
    {   
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->backend_model->getAllNews($start,config_item('per_page'));
            $total=$this->backend_model->countAllNews(); 
           // ex($data['record']);
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            base_url('backend/newsList'),
            '.nlist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword; 
            $data['start']  = $start; 
            $ajax = $this->load->view('backend/news_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return; 
            }
            $this->session->set_userdata('active','1');
            $data['list']=$ajax;                        
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/news_list',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');  
    }
    function addNewsCategory()
    {   
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name_en',lang('name_en'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('name_dr',lang('name_dr'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_rules('name_pa',lang('name_pa'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {   
            $this->session->set_userdata('active','1');
            $this->load->view('lib/header');    
            $content = $this->load->view('backend/add_news_category',true,true);
            frame($content,true);
            $this->load->view('lib/footer');    
        }                          
        else
        {
               $data = array(        
                    'name_en'=>post('name_en'),            
                    'name_dr'=>post('name_dr'),            
                    'name_pa'=>post('name_pa')            
                    );   
                $result = $this->util_model->insertRecords($data,'news_category');
                if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('backend/newsList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/addNewsCategory'));    
                } 
        } 
    }
    function addNewNews()
    {   
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('title',lang('title'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('category',lang('category'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_rules('content',lang('content'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {   
            $this->session->set_userdata('active','1');
            $data['news_category']=$this->util_model->getRecord('*','news_category');
            $this->load->view('lib/header');    
            $content = $this->load->view('backend/add_new_news',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');    
        }                          
        else
        {  
               $video='';
               $photo='';
               $video=$this->util->uploadAtt('video','./uploads/img/news/video/');
               $photo=$this->util->addImage('photo','./uploads/img/news/');
               if($video==0)
               {
                   $video='';
               }
               if($photo==0)
               {
                   $photo='';
               }   
               $data = array(        
                    'title_'.shortlang()=>post('title'),            
                    'category_id'=>post('category'),     
                    'content_'.shortlang()=>post('content'),            
                    'post_date'=>strtotime(date('Y-m-d')),
                    'source_'.shortlang()=>post('source'), 
                    'views'=>0, 
                    'photo'=>$photo,
                    'video'=>$video,
                    'post_by'=>getUserId()             
                    );
                            
                $result = $this->util_model->insertRecords($data,'news');
                if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('backend/newsList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/addNewNews'));    
                } 
        } 
    }
    function updateNews($newsId=0)
    {   
        if($newsId !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('title',lang('title'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('category',lang('category'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_rules('content',lang('content'),'required|trim',
            array('required' => lang('error').' %s.'));  
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {   
                $this->session->set_userdata('active','1');
                $data['news_category']=$this->util_model->getRecord('*','news_category');
                $data['record']=$this->backend_model->getNewsToUpdate($newsId);
                $this->load->view('lib/header');    
                $content = $this->load->view('backend/update_news',$data,true);
                frame($content,true);
                $this->load->view('lib/footer');    
            }                          
            else
            {
                    
                    $photo='';
                    if($_FILES['photo']['name'])
                    {
                            unlink("./uploads/img/news/".post('pr_photo'));
                            $photo=$this->util->addImage('photo','./uploads/img/news/');  
                    }
                    else 
                    { 
                           $photo=post('pr_photo');  
                    }
                   $data = array(        
                        'title_'.shortlang()=>post('title'),            
                        'category_id'=>post('category'),     
                        'content_'.shortlang()=>post('content'),
                        'source_'.shortlang()=>post('source'), 
                        'photo'=>$photo               
                        );                  
                    $result = $this->util_model->updateRecords($data,'news','id',$newsId);
                    if($result)
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                        redirect(site_url('backend/newsList'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('backend/addNewNews'));    
                    } 
            }
        }
        else
        {
            $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
            redirect(site_url('backend/newsList'));
        } 
    }
    function deleteNews($newsId=0)
    {
        if($newsId !=0)
        {
            $news=$this->util_model->getRecord('photo,video','news',$cond=array('id'=>$newsId));
            if($news)
            {
                $news=$news[0];
                $photo=$news->photo;
                $video=$news->video;
                if($photo && $photo !=null && $photo !='')
                {
                     unlink("./uploads/img/news/".$photo);
                }
                if($video && $video !=null && $video !='')
                {          
                     unlink("./uploads/img/news/video/".$video);
                }
            }
                     
            $result = $this->util_model->deleteRecord('id',$newsId,'news');
            if($result)
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/newsList'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/deleteNews/'.$newsId));    
            }
        }
    }
    function gallaryList()
    {   
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            }                           
            $keyword    = post('search');
            $data['record']=$this->util_model->getRecord('*','gallary',$data=array(),$start,config_item('per_page'));
            $total=$this->util_model->countTable('*','gallary');
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
            $ajax = $this->load->view('backend/gallary_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return; 
            }
            $this->session->set_userdata('active','2');
            $data['list']=$ajax;                        
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/gallary_list',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');  
    }
    function insertToGallary()
    {
          
           $files =$this->util->uploadAtt('photo','./uploads/img/gallary/',true);
           $data = array();   
           if($files>0)
           {                    
                foreach($files as $k=>$p){
                    if(!isEmpty($p)){
                                         
                        $data[] = array(                
                            'photo'      => $files[$k]                
                        );
                    }
                }  
            }   
            $result = $this->util_model->insertRecords($data,'gallary',true);
            if($result)
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/addToGallary'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/addToGallary'));    
            } 
    }
    function addToGallary()
    {               
        $this->session->set_userdata('active','2');                                          
        $this->load->view('lib/header');              
        $content = $this->load->view('backend/add_to_gallary',true,true);
        frame($content,true);
        $this->load->view('lib/footer'); 
    }
    function addToSliderView()
    {
        $this->session->set_userdata('active','3');
        //$data['record']=$this->backend_model->getSlider();
        $data['record']=$this->util_model->getRecord('*','slider');
        //pint_r( $data['record']);exit;
        $this->load->view('lib/header');   
        $content = $this->load->view('backend/add_to_slider',$data,true);    
        frame($content,true);
        $this->load->view('lib/footer');
    }
    function addToSlider()
    {         
           
        $photo=$this->util->addImage('photo','./uploads/img/slider/');
        $data = array(              
            'photo'=>$photo            
            );            
        $result = $this->util_model->insertRecords($data,'slider',false);
        if($result)
        {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/addToSliderView'));  
        }
        else
        {
            $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
            redirect(site_url('backend/addToSliderView'));    
        } 
        
    }
    function sliderImageCrop($imageName='')
    {   
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('x1',lang('x1'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {          
            $data['image']=$imageName;
            $this->load->view('lib/header');    
            $content = $this->load->view('backend/slider_image_crop',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');    
        }                          
        else
        {                                               
            
            $config['file_permissions'] = 0644;
            $config['source_image'] = './uploads/img/slider/'.$imageName; 
            $config['x_axis'] = post('x1');
            $config['quality'] = 100;
            $config['y_axis'] = post('y1');
            $config['width'] = post('x2');
            $config['height'] = post('y2');   
            $config['dynamic_output'] = './uploads/img/slider/';  
            $this->image_lib->initialize($config);   
            $this->image_lib->crop();              
                $result =1;
                if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('backend/addToSliderView'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/addNewNews'));    
                } 
        } 
    }
    
     /**
      * user list
      * 
      */
      function organizationList()
      {
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->backend_model->getAllOrganization($start,config_item('per_page'));
            $total=$this->backend_model->countAllOrganization(); 
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('backend/organizationList'),
            '.ulist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('backend/organization_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return;
                
            }
            $data['list']=$ajax;
            $this->session->set_userdata('active','5');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/organization_list',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');  
      }
      /**
      * add new user
      *  
      */
      function addNewOrganization() 
      {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('name',lang('name'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('address',lang('address'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('description',lang('description'),'required|trim',
            array('required' => lang('error').' %s.'));    
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $this->session->set_userdata('active','5');
                $this->load->view('lib/header');   
                $content = $this->load->view('backend/add_new_organization',true,true);
                frame($content,true);
                $this->load->view('lib/footer');    
            }                          
            else
            {     
                    $photo=$this->util->addImage('photo','./uploads/img/organization/');
                    $data[0]='http://';
                    $data[1]='www.facebook.com/';
                    $data[2]='www.facebook.com';
                    $face=str_ireplace($data,'',post('facebook_link')); 
                    $data = array(
                        'name_'.shortlang()=>post('name'),
                        'photo'=>$photo,
                        'address_'.shortlang()=>post('address'), 
                        'description_'.shortlang()=>post('description'), 
                        'facebook_link'=>$face 
                        );                                                           
                    $result = $this->util_model->insertRecords($data,'organization');
                    if($result)
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                        redirect(site_url('backend/organizationList'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('backend/addNewOrganization'));    
                    }    
                       
            }
      }
      function updateOrganization($oId=0) 
      {
           if($oId !=0)
           {
                $this->load->helper('form');              
                $this->lang->load('form_validation',shortlang());
                $this->form_validation->set_rules('name',lang('name'),'required|trim',
                array('required' => lang('error').' %s.'));
                $this->form_validation->set_rules('address',lang('address'),'required|trim',
                array('required' => lang('error').' %s.')); 
                $this->form_validation->set_rules('description',lang('description'),'required|trim',
                array('required' => lang('error').' %s.'));      
                $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
                if($this->form_validation->run()==false)
                {
                    $data['record']=$this->util_model->getRecord('*','organization',$cond=array('id'=>$oId));
                    $this->session->set_userdata('active','5');
                    $this->load->view('lib/header');   
                    $content = $this->load->view('backend/update_organization',$data,true);
                    frame($content,true);
                    $this->load->view('lib/footer');    
                }                          
                else
                {            
                        $photo='';
                        if($_FILES['photo']['name'])
                        {       
                                unlink("./uploads/img/organization/".post('pr_photo'));
                                $photo=$this->util->addImage('photo','./uploads/img/organization/');  
                        }
                        else 
                        { 
                               $photo=post('pr_photo');  
                        }
                        $data[0]='http://';
                        $data[1]='www.facebook.com/';
                        $data[2]='www.facebook.com';
                        $face=str_ireplace($data,'',post('facebook_link')); 
                         $data = array(
                            'name_'.shortlang()=>post('name'),
                            'photo'=>$photo,
                            'address_'.shortlang()=>post('address'), 
                            'description_'.shortlang()=>post('description'), 
                            'facebook_link'=>$face 
                            );                                                 
                        $result = $this->util_model->updateRecords($data,'organization','id',$oId);
                        if($result)
                        {
                            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                            redirect(site_url('backend/organizationList'));  
                        }
                        else
                        {
                            $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                            redirect(site_url('backend/updateOrganization/'.$oId));    
                        }    
                           
                }
           }
           else
           {
               return false;
           }
      }
    function membersList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->backend_model->getAllMembers($start,config_item('per_page'));
        $total=$this->backend_model->countAllMembers();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('backend/membersList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('backend/members_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','6');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('backend/members_list',$data,true);
        frame($content,true);
        $this->load->view('lib/footer');  
    }
    function addNewMember() 
    {
         $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('fname',lang('fname'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_rules('gender',lang('gender'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_rules('tazkira_number',lang('tazkira_number'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_rules('tribe',lang('tribe'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_rules('date_of_birth',lang('date_of_birth'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_rules('marital_status',lang('marital_status'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {      
            $this->session->set_userdata('active','6');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/add_new_member',true,true);
            frame($content,true);  
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
                    'gender'=>post('gender'),
                    'phone_number'=>post('phone_number'),
                    'email'=>post('email'),
                    'job'=>post('job'),
                    'tribe'=>post('tribe'),
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
                        'status'=>2,
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
                redirect(site_url('backend/membersList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/addNewMember'));    
                }   
        }
    }
    function printMember($memberId=0,$personId=0)
    {
        $data['record']=$this->backend_model->getMemberById($memberId);
        //ex($data['record']);
        $this->session->set_userdata('active','6');
        $this->load->view('lib/header');
        $content =$this->load->view('backend/print_member',$data,true);
        frame($content,true); 
        $this->load->view('lib/footer'); 
    }
      /**
    * print pdf
    *
    * @param mixed $uid
    */
    function printMember1($memberId=0,$personId=0)
     {
           $lang=shortlang();
           $this->load->library('Pdf');
           $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
           $pdf->SetCreator(PDF_CREATOR);
           $pdf->SetAuthor('Nilesh Zemse');
           $pdf->SetTitle('sumarized information');
           $pdf->SetSubject('sumarized information');
           $pdf->SetKeywords('PDF, Invoice');
           $pdf->setHeaderFont(Array('DejaVuSans', '', 11));
           $PDF_HEADER_TITLE = "Applicant Information";
           $PDF_HEADER_STRING=
           //$pdf->setPrintHeader(false);
           //$pdf->setPrintFooter(false);
           $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
           //set margins
           $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
           $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
           $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
           $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
           $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
           // set some language dependent data:
           //$lang='dari';
           if($lang!="en"){
           $lg = Array();
           $lg['a_meta_charset'] = 'UTF-8';
           $lg['a_meta_dir'] = 'rtl';
           $lg['a_meta_language'] = 'fa';
           $lg['w_page'] = 'page';
           $pdf->setLanguageArray($lg);
           }
           // ---------------------------------------------------------
           //$pdf->SetFont('times', '', 11);
          $pdf->SetFont('DejaVuSans', '', 11);
           $pdf->AddPage();

            $data['record']=$this->backend_model->getMemberById($memberId);
            $html = $this->load->view('backend/print_member',$data,true);
            $pdf->writeHTML($html);

            // reset pointer to the last page
            $pdf->lastPage();
            //Close and output PDF document
            $pdf_file_name = 'custom_header_footer.pdf';
            ob_end_clean();
            $pdf->Output($pdf_file_name, 'I');
     }
    function updateMember($memberId=0,$personId=0) 
    {
         if($memberId !=0 && $personId !=0)
         {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('name',lang('name'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('fname',lang('fname'),'required|trim',
            array('required' => lang('error').' %s.'));  
            $this->form_validation->set_rules('gender',lang('gender'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_rules('tazkira_number',lang('tazkira_number'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_rules('tribe',lang('tribe'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_rules('date_of_birth',lang('date_of_birth'),'required|trim',
            array('required' => lang('error').' %s.'));  
            $this->form_validation->set_rules('marital_status',lang('marital_status'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {      
                $data['record']=$this->backend_model->getMemberById($memberId);
                $this->session->set_userdata('active','6');
                $this->load->view('lib/header'); 
                $content = $this->load->view('backend/update_member',$data,true); 
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {    
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
                        'tazkira_number'=>post('tazkira_number'),
                        'gender'=>post('gender'),
                        'phone_number'=>post('phone_number'),
                        'email'=>post('email'),
                        'job'=>post('job'),
                        'tribe'=>post('tribe'),
                        'date_of_birth'=>strtotime($dob), 
                        'marital_status'=>post('marital_status'),
                        'field_of_education'=>post('field_of_education'),
                        'level_of_education'=>post('level_of_education'),
                        ); 
                         
                    $result=0; 
                                                                                
                    $result = $this->util_model->updateRecords($data,'person','id',$personId);
                      
                    if($result)
                    {
                        unset($result);
                        $data = array(                  
                            'status'=>post('status'),
                            'r_name'=>post('recommender_name'),              
                            'r_fname'=>post('recommender_fname'),              
                            'r_job'=>post('recommender_job'),              
                            'r_address'=>post('recommender_address'),              
                            );                                                           
                         $result = $this->util_model->updateRecords($data,'member','id',$memberId);
                         $data = array(        
                            'province'=>post('province'),
                            'district'=>post('district'),  
                            'village'=>post('village') 
                            );
                         $result = $this->util_model->updateRecords($data,'address','id',post('permanent_address_id'));
                         $data = array(        
                            'province'=>post('current_province'),
                            'district'=>post('current_district'),  
                            'village'=>post('current_village')
                            );
                          $result = $this->util_model->updateRecords($data,'address','id',post('current_address_id'));
                    }
                    if($result)
                    {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('backend/membersList'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('backend/addNewMember'));    
                    }   
            }
         }
         else
         {
             return false;
         }
    }
    function presidenciesList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->backend_model->getAllPresidencies($start,config_item('per_page'));
        $total=$this->backend_model->countAllPresidencies();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('backend/presidenciesList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('backend/presidency_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','7');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('backend/presidency_list',$data,true);
        frame($content,true);
        $this->load->view('lib/footer');  
    }
     function presidenciesProList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->backend_model->getAllProPresidencies($start,config_item('per_page'));
        $total=$this->backend_model->countAllProPresidencies();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('backend/presidenciesProList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('backend/presidencyPro_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','7');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('backend/presidencyPro_list',$data,true);
        frame($content,true);
        $this->load->view('lib/footer');  
    }
    function addNewPresidency () 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('description',lang('description'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('boss',lang('boss'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','7');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/add_new_presidency',true,true);   
            frame($content,true);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
            $photo='';
            $uploaded=$this->util->addImage('boss_photo','./uploads/img/presidency/boss/');
            if($uploaded !=0)
            {
                $photo=$uploaded;
            }   
            $data = array(        
                    'name_'.shortlang()=>post('name'),
                    'description_'.shortlang()=>post('description'), 
                    'boss_name'=>post('boss'),                        
                    'boss_photo'=>$photo               
                    );                                                         
            $result = $this->util_model->insertRecords($data,'presidency'); 
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/presidenciesList'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/addNewPresidency'));    
            }   
        }
    }
     function updatePresidency ($pId=0) 
    {
        if($pId !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('name',lang('name'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('description',lang('description'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('boss',lang('boss'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $data['record']=$this->util_model->getRecord('*','presidency',$cond=array('id'=>$pId));
                $this->session->set_userdata('active','7');
                $this->load->view('lib/header'); 
                $content = $this->load->view('backend/update_presidency',$data,true);   
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {    
                $photo='';
                if($_FILES['boss_photo']['name'])
                {
                        unlink("./uploads/img/presidency/boss/".post('pr_photo'));
                        $photo=$this->util->addImage('boss_photo','./uploads/img/presidency/boss/');
                }
                else 
                { 
                       $photo=post('pr_photo');  
                } 
                $data = array(        
                        'name_'.shortlang()=>post('name'),
                        'description_'.shortlang()=>post('description'), 
                        'boss_name'=>post('boss'),                        
                        'boss_photo'=>$photo               
                        );                                                         
                $result = $this->util_model->updateRecords($data,'presidency','id',$pId); 
                if($result)
                {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/presidenciesList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/updatePresidency/'.$pId));    
                }   
            }
        }
        else
        {
            return false;
        }
    }
      function addNewProPresidency () 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('description',lang('description'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('boss',lang('boss'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','7');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/add_new_propresidency',true,true);   
            frame($content,true);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
            $photo='';
            $uploaded=$this->util->addImage('boss_photo','./uploads/img/presidency/boss/');
            if($uploaded !=0)
            {
                $photo=$uploaded;
            }   
            $data = array(        
                    'name_'.shortlang()=>post('name'),
                    'description_'.shortlang()=>post('description'), 
                    'boss_name'=>post('boss'),                        
                    'boss_photo'=>$photo               
                    );                                                         
            $result = $this->util_model->insertRecords($data,'presidency_province'); 
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/presidenciesProList'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/presidenciesProList'));    
            }   
        }
    }
       function updateProPresidency ($pId=0) 
    {
        if($pId !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('name',lang('name'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('description',lang('description'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('boss',lang('boss'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $data['record']=$this->util_model->getRecord('*','presidency_province',$cond=array('id'=>$pId));
                $this->session->set_userdata('active','7');
                $this->load->view('lib/header'); 
                $content = $this->load->view('backend/update_presidencyPro',$data,true);   
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {    
                $photo='';
                if($_FILES['boss_photo']['name'])
                {
                        unlink("./uploads/img/presidency/bosspro/".post('pr_photo'));
                        $photo=$this->util->addImage('boss_photo','./uploads/img/presidency/boss/');
                }
                else 
                { 
                       $photo=post('pr_photo');  
                } 
                $data = array(        
                        'name_'.shortlang()=>post('name'),
                        'description_'.shortlang()=>post('description'), 
                        'boss_name'=>post('boss'),                        
                        'boss_photo'=>$photo               
                        );                                                         
                $result = $this->util_model->updateRecords($data,'presidency_province','id',$pId); 
                if($result)
                {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/presidenciesProList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/updateProPresidency/'.$pId));    
                }   
            }
        }
        else
        {
            return false;
        }
    }
    function contactsList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->backend_model->getAllContacts($start,config_item('per_page'));
        $total=$this->backend_model->countAllContacts();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('backend/contactList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('backend/contacts_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','8');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('backend/contacts_list',$data,true);
        frame($content,true);
        $this->load->view('lib/footer');  
    }
  
    function updateContact($contactId=0)
    {       
        if($contactId !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang()); 
            $this->form_validation->set_rules('to',lang('to'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('message',lang('message'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {     
                $this->session->set_userdata('active','8');
                $data['record']=$this->backend_model->getAllContacts(0,config_item('per_page'),$data=array('id'=>$contactId));
                $data['reply']=$this->util_model->getRecord('*','reply',array('contact_id'=>$contactId));
                $this->load->view('lib/header');
                $content = $this->load->view('backend/update_contact',$data,true);   
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {     
                $data = array(
                    'contact_id'=>$contactId,
                    'message'=>post('message'),
                    'reply_date'=>strtotime(Date('Y-m-d'))
                    );
                //$result = $this->util_model->insertRecords($data,'reply'); 
                $email_content = '
                Hello,<br /><br />
                Please click on link below for verifying your account.<br /><br />
                '.site_url('backend/updateContact/'.$contactId).'
                <br /><br />
                Thanks.
                ';    
                $r=$this->util->sendMail($this->config->item('system_email'),post('to'),'Email Verification',$email_content);
                ex($r);   
                if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('backend/updateContact/'.$contactId));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/updateContact/'.$contactId));    
                }  
            }
        }
    }
    function aboutUs()
    {                                              
        $this->session->set_userdata('active','7');
        $this->load->view('lib/header');              
        $content = $this->load->view('backend/about_us',true,true);
        frame($content,true);
        $this->load->view('lib/footer'); 
    }
    function aboutLeaders()
    {                                              
        $this->session->set_userdata('active','7');
        $data['record']=$this->backend_model->getAllLeaders();
        $this->load->view('lib/header');              
        $content = $this->load->view('backend/about_leaders',$data,true);
        frame($content,true);
        $this->load->view('lib/footer'); 
    }
    function LeaderDetail($personId=0)
    {                                              
        if($personId !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('name',lang('name'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('lastname',lang('lastname'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('fname',lang('fname'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('type',lang('type'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('gender',lang('gender'),'required|trim',
            array('required' => lang('error').' %s.'));  
            $this->form_validation->set_rules('biography',lang('biography'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $this->session->set_userdata('active','7');
                $data['record']=$this->backend_model->getLeaderById($personId);                           
                $this->load->view('lib/header'); 
                $content = $this->load->view('backend/leader_detail',$data,true);   
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {    
                   
                $data = array(        
                        'name'=>post('name'),                      
                        'lastname'=>post('lastname'),                      
                        'fname'=>post('fname'),                      
                        'type'=>post('type'),          
                        'gender'=>post('gender'),               
                        'biography_'.shortlang()=>post('biography')               
                        );                                                         
                $result = $this->util_model->updateRecords($data,'person','id',$personId); 
                if($result)
                {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/aboutLeaders'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/LeaderDetail/'.$personId));    
                }   
            }
        } 
        else
        {
            return false;
        }
    }
    function addPersonalInformation() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('lastname',lang('lastname'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('fname',lang('fname'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('type',lang('type'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('gender',lang('gender'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_rules('biography',lang('biography'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','7');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/add_personal_information',true,true);   
            frame($content,true);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
            $photo='';
            $uploaded=$this->util->addImage('photo','./uploads/img/aboutus/');
            if($uploaded !=0)
            {
                $photo=$uploaded;
            }   
            $data = array(        
                    'name'=>post('name'),                      
                    'lastname'=>post('lastname'),                      
                    'fname'=>post('fname'),                      
                    'type'=>post('type'),                         
                    'photo'=>$photo,               
                    'gender'=>post('gender'),               
                    'biography_'.shortlang()=>post('biography')               
                    );  
                    
           // print_r($data);exit;
            $result = $this->util_model->insertRecords($data,'person'); 
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/aboutLeaders'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/addPersonalInformation'));    
            }   
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
            $data['record']=$this->backend_model->getAllBooks($start,config_item('per_page'),$data=array('person_id'=>$personId));
            $total=$this->backend_model->countAllBooks($personId); 
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('backend/booksList/'.$personId),
            '.ulist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('backend/books_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return;
                
            }
            $this->session->set_userdata('active','7');
            $data['list']=$ajax;                        
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/books_list',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');
        }  
        else
        {
            return false;
        }
    }
    function addPublishBook() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('name',lang('name'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('edition',lang('edition'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('published_by',lang('published_by'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','7'); 
            $data['record']=$this->backend_model->getAllLeaders(); 
            $this->load->view('lib/header');                        
            $content = $this->load->view('backend/add_publish_book',$data,true);   
            frame($content,true);  
            $this->load->view('lib/footer');  
        }                          
        else
        {    
            $photo='';
            $book='';
            $uploaded_photo=$this->util->addImage('cover_photo','./uploads/book/cover_photo/');
            $uploaded_book=$this->util->uploadAtt('book_file','./uploads/book/');
            if($uploaded_photo !=0)
            {
                $photo=$uploaded_photo;
            }
            if($uploaded_book !=0)
            {
                $book=$uploaded_book;
            }
            $publish_date='';
            if(shortlang()!='en')
            {
                    $post_date='';
                    $post_date = explode('-',(post('publish_date')));
                    $date_conv = $this->dateconverter->JalaliToGregorian($post_date[0], $post_date[1], $post_date[2]);
                    $publish_date=$date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
            }
            else
            {
                    $publish_date=post('publish_date');
            }   
            $data = array(        
                    'name_'.shortlang()=>post('name'),                      
                    'description_'.shortlang()=>post('description'),                      
                    'edition_'.shortlang()=>post('edition'),    
                    'publish_date'=>strtotime($publish_date),               
                    'person_id'=>post('published_by'), 
                    'photo'=>$photo,                        
                    'book'=>$book 
                    );         
            $result = $this->util_model->insertRecords($data,'book'); 
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/addPublishBook'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/addPublishBook'));    
            }   
        }
    }
    function RulesList()
    {
        $start = post('start');
        if(isEmpty($start))
        {
            $start = 0;
        } 
        $keyword    = post('search');
        $data['record']=$this->backend_model->getAllRules($start,config_item('per_page'));
        $total=$this->backend_model->countAllRules();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('backend/RulesList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('backend/rules_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','7');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('backend/rules_list',$data,true);
        frame($content,true);
        $this->load->view('lib/footer');  
    }
    function addNewRule() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('title[]',lang('title'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('content[]',lang('content'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','7'); 
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/add_new_rule',true,true);
            frame($content,true);  
            $this->load->view('lib/footer');    
        }                          
        else
        {      
               $title=post('title');
               $content=post('content');
               $data = array();   
               if(count($title)>0)
               {                    
                    foreach($title as $k=>$p){
                        if(!isEmpty($p)){
                                             
                            $data[] = array(                
                                'title_'.shortlang()      => $title[$k],
                                'content_'.shortlang()      => $content[$k]
                            );
                        }
                    }  
                }                                                              
                $result = $this->util_model->insertRecords($data,'rule',true); 
                if($result)
                {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/RulesList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/addNewRule'));    
                }   
        }
    }
    function updateRule($id=0) 
    {
        if($id !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('title[]',lang('title'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('content[]',lang('content'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $data['record']=$this->util_model->getRecord('*','rule');
                $this->session->set_userdata('active','7'); 
                $this->load->view('lib/header'); 
                $content = $this->load->view('backend/update_rule',$data,true);
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {      
                    $data=array(
                    'title_'.shortlang()=>post('title'),
                    'content_'.shortlang()=>post('content')
                    );                                                                   
                    $result = $this->util_model->updateRecords($data,'rule','id',$id); 
                    if($result)
                    {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(site_url('backend/RulesList'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('backend/updateRule/'.$id));    
                    }   
            }
        }
        else
        {
            return false;
        }
    }
    function changeImage($personId = 0, $photoName ='')
    {
             //delete previouse image from this path  
              
             if ($photoName !='')
             {
                 unlink("./uploads/img/about_us/".$photoName);
             }  
             $photo_name=$this->util->addImage('image','./uploads/img/about_us/');  
             $data=array(
                     'photo'=>$photo_name            
              );            
             if($this->util_model->updateRecords($data,'person','id',$personId)) 
             $data['img']=$this->util_model->getRecord('photo','person',$con=array('id'=>$personId));
             return true;  
      }
    function download($file_name)
    {
        $this->load->helper('download');
        $data = 'some thing';
        $name = $file_name;
        force_download($name, $data);
    }
    function sendingMessage() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('message',lang('message'),'required|trim',
        array('required' => lang('error').' %s.'));  
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {   
            $data['record']=$this->backend_model->getAllMembersForMessage();
            $this->session->set_userdata('active','6');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/sending_message_to_all',$data,true);   
            frame($content,true);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
                                                                      
                $reccc = $this->backend_model->getAllMembersForMessage();  
                $emails = array();
                $members = array();
                if(post('members') == 2)
                {
                     if($reccc){
                        foreach($reccc as $v):
                        if(post('apply'.$v->id))
                        {
                            
                            if($v->email !='' && $v->email !=null)
                            {
                                
                                $members[] = $v->name;
                                $emails[]   = $v->email;
                            }
                        }
                        endforeach;
                    }
                }
                else
                {
                    if($reccc){
                        foreach($reccc as $v):
                        if($v->email !='' && $v->email !=null)
                        {
                            $members[] = $v->name;
                            $emails[]   = $v->email;
                        }
                        endforeach;
                    }
                }
                $result=0;
        
                if(!empty($emails))
                {   $counter=0;
                    foreach($emails AS $em)
                    {       
                        if($em != '')
                        {
                            $email_content = '
                             '.lang('hello_dear').' '.' <br /><br />
                            '.$members[$counter].'   <br /><br />
                            .<br /><br />
                            '.post('message').'
                            <br /><br />
                            Thanks.
                            ';                  
                            $result=$this->util->sendMail($this->config->item('system_email'),$em,'',$email_content);
                            
                        }
                        $counter++;
                    }
                }
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/sendingMessage'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/sendingMessage'));    
            }   
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
        $data['record']=$this->backend_model->getAllAnnouncements($start,config_item('per_page'));
        $total=$this->backend_model->countAllAnnouncements();
        $data['pagination'] = $this->paginations->make(
        $total,
        $start,
        config_item('per_page'),
        lang('paginate'),
        site_url('backend/announcementsList'),
        '.ulist',
        '&search='.$keyword
        );
        $data['keyword']=$keyword;
        
        $data['start']  = $start; 
        $ajax = $this->load->view('backend/announcements_list_ajax',$data,true);
        if(post('ajax')!='')
        {                       
            echo json_encode(array('result'=>$ajax));
            return;
            
        }
        $this->session->set_userdata('active','9');
        $data['list']=$ajax;                        
        $this->load->view('lib/header'); 
        $content = $this->load->view('backend/announcements_list',$data,true);
        frame($content,true);
        $this->load->view('lib/footer');  
    }
    function addNewAnnouncement() 
    {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('title',lang('title'),'required|trim',
        array('required' => lang('error').' %s.')); 
        $this->form_validation->set_rules('content',lang('content'),'required|trim',
        array('required' => lang('error').' %s.'));
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','9');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/add_new_announcement',true,true);   
            frame($content,true);  
            $this->load->view('lib/footer');    
        }                          
        else
        {    
            $photo='';
            $uploaded=$this->util->addImage('photo','./uploads/img/announcement/');
            if($uploaded !=0)
            {
                $photo=$uploaded;
            }
            $date='';
            if(shortlang()!='en')
            {
                    $post_date='';
                    $post_date = explode('-',(post('date')));
                    $date_conv = $this->dateconverter->JalaliToGregorian($post_date[0], $post_date[1], $post_date[2]);
                    $date=$date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
            }
            else
            {
                    $date=post('date');
            }    
            $data = array(                        
                'title_'.shortlang()=>post('title'),                         
                'date'=>strtotime($date),                
                'description_'.shortlang()=>post('content'), 
                'photo'=>$photo               
                );                                                         
            $result = $this->util_model->insertRecords($data,'announcement'); 
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/announcementsList'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/addNewAnnouncement'));    
            }   
        }
    }
    function updateAnnouncement($id=0) 
    {
        if($id !=0)
        {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('title',lang('title'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('content',lang('content'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $data['record']=$this->util_model->getRecord('*','announcement',$content=array('id'=>$id));
                $this->session->set_userdata('active','9');
                $this->load->view('lib/header'); 
                $content = $this->load->view('backend/update_announcement',$data,true);   
                frame($content,true);  
                $this->load->view('lib/footer');    
            }                          
            else
            {    
                $photo='';  
                if($_FILES['photo']['name'])
                {
                        unlink("./uploads/img/announcement/".post('pr_photo'));
                        $photo=$this->util->addImage('photo','./uploads/img/announcement/');  
                }
                else 
                { 
                       $photo=post('pr_photo');  
                }
               
                $date='';
                if(shortlang()!='en')
                {
                        $post_date='';
                        $post_date = explode('-',(post('date')));
                        $date_conv = $this->dateconverter->JalaliToGregorian($post_date[0], $post_date[1], $post_date[2]);
                        $date=$date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
                }
                else
                {
                        $date=post('date');
                }    
                $data = array(                        
                    'title_'.shortlang()=>post('title'),                         
                    'date'=>strtotime($date),                
                    'description_'.shortlang()=>post('content'), 
                    'photo'=>$photo               
                    );                                                             
                $result = $this->util_model->updateRecords($data,'announcement','id',$id);
                   
                if($result)
                {
                $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                redirect(site_url('backend/announcementsList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(site_url('backend/addNewAnnouncement'));    
                }   
            }
        }
        else
        {
            return false;
        }
    }
     function redactorNotesList()
      {
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->backend_model->getAllRedactorNotes($start,config_item('per_page'));
            $total=$this->backend_model->countAllRedactorNotes(); 
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('backend/redactorNotesList'),
            '.ulist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('backend/redactor_notes_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return;
                
            }
            $data['list']=$ajax;
            $this->session->set_userdata('active','10');
            $this->load->view('lib/header'); 
            $content = $this->load->view('backend/redactor_notes_list',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');  
      }
      /**
      * add new user
      *  
      */
      function addNewRedactorNote() 
      {
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('title',lang('title'),'required|trim',
            array('required' => lang('error').' %s.')); 
            $this->form_validation->set_rules('content',lang('content'),'required|trim',
            array('required' => lang('error').' %s.'));    
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {
                $this->session->set_userdata('active','10');
                $this->load->view('lib/header');   
                $content = $this->load->view('backend/add_new_redactor_note',true,true);
                frame($content,true);
                $this->load->view('lib/footer');    
            }                          
            else
            {     
                    $photo=$this->util->addImage('photo','./uploads/img/redactornote/');
                    $data = array(
                        'title_'.shortlang()=>post('title'),
                        'content_'.shortlang()=>post('content'),
                        'photo'=>$photo                
                        );                                                           
                    $result = $this->util_model->insertRecords($data,'redactor_note');
                    if($result)
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                        redirect(site_url('backend/redactorNotesList'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('backend/addNewRedactorNote'));    
                    }    
                       
            }
      }
        function updateRedactorNote($rId=0) 
        {
            if($rId !=0)
            {
                $this->load->helper('form');              
                $this->lang->load('form_validation',shortlang());
                $this->form_validation->set_rules('title',lang('title'),'required|trim',
                array('required' => lang('error').' %s.')); 
                $this->form_validation->set_rules('content',lang('content'),'required|trim',
                array('required' => lang('error').' %s.'));    
                $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
                if($this->form_validation->run()==false)
                {
                    $data['record']=$this->util_model->getRecord('*','redactor_note',$cond=array('id'=>$rId));
                    $this->session->set_userdata('active','10');
                    $this->load->view('lib/header');   
                    $content = $this->load->view('backend/update_redactor_note',$data,true);
                    frame($content,true);
                    $this->load->view('lib/footer');    
                }                          
                else
                {                                                                            
                        $photo='';
                        if($_FILES['photo']['name'])
                        {
                                unlink("./uploads/img/redactornote/".post('pr_photo'));
                                $photo=$this->util->addImage('photo','./uploads/img/redactornote/');  
                        }
                        else 
                        { 
                                $photo=post('pr_photo');  
                        }
                        $data = array(
                            'title_'.shortlang()=>post('title'),
                            'content_'.shortlang()=>post('content'),
                            'photo'=>$photo                
                            );                                                           
                        $result = $this->util_model->updateRecords($data,'redactor_note','id',$rId);
                        if($result)
                        {
                            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                            redirect(site_url('backend/redactorNotesList'));  
                        }
                        else
                        {
                            $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                            redirect(site_url('backend/updateRedactorNote/'.$rId));    
                        }    
                            
                }
            }
            else
            {
                return false;
            }
        }
        

        //weeksnew
        //weeknewsList

    function weeknewsList()
    {                                              
        $this->session->set_userdata('active','10');
        $data['record']=$this->backend_model->getAllWeeks();
        //print_r($data['record']);exit;
        $this->load->view('lib/header');              
        $content = $this->load->view('backend/weeknews',$data,true);
        frame($content,true);
        $this->load->view('lib/footer'); 
    }
    function addWeekNews() 
     {
        $this->load->helper('form');              
        $this->lang->load('form_validation',shortlang());
        $this->form_validation->set_rules('title',lang('title'),'required|trim',
        array('required' => lang('error').' %s.')); 
     
        $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
        if($this->form_validation->run()==false)
        {
            $this->session->set_userdata('active','10'); 
            
            $this->load->view('lib/header');                        
            $content = $this->load->view('backend/add_week_news',TRUE,true);   
            frame($content,true);  
            $this->load->view('lib/footer');  
        }                          
        else
        {    
            $book='';
            $photo='';
            $photo=$this->util->addImage('photo','./uploads/download');
            $book =$this->util->uploadAtt('book_file','./uploads/download/');
          
            $publish_date='';
            if(shortlang()!='en')
            {
                    $post_date='';
                    $post_date = explode('-',(post('date')));
                    $date_conv = $this->dateconverter->JalaliToGregorian($post_date[0], $post_date[1], $post_date[2]);
                    $date=$date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
            }
            else
            {
                    $date=post('date');
            }   
            $data = array(        
                    'title_'.shortlang()=>post('title'),         
                    'date'=>strtotime($date),     
                    'book'=>$book ,
                    'photo'=>$photo,
                    );         
            $result = $this->util_model->insertRecords($data,'weeks_news'); 
            //print_r($result);exit;
            if($result)
            {
            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
            redirect(site_url('backend/addWeekNews'));  
            }
            else
            {
                $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                redirect(site_url('backend/addWeekNews'));    
            }   
        }
     }
        function deleteDownload($id=0)
        {
            
            if($id !=0)
        
            {
                 $result=$this->util_model->deleteRecord('id',$id,'weeks_news');
                 //print_r($result);exit;
                 if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(base_url('backend/weeknewsList'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(base_url('backend/weeknewsList'));    
                }
            }
            else
            {
                redirect(base_url('backend/weeknewsList')); 
            }
        }  

        
        function deleteSlider($id=0)
        {
            
            if($id !=0)
        
            {
                 $result=$this->util_model->deleteRecord('id',$id,'slider');
                 //print_r($result);exit;
                 if($result)
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                    redirect(base_url('backend/addToSliderView'));  
                }
                else
                {
                    $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                    redirect(base_url('backend/addToSliderView'));    
                }
            }
            else
            {
                redirect(base_url('backend/addToSliderView')); 
            }
        } 
    
  }
?>
