<?php
/**
* users controller
* @author: Ali Mashal Frozan
*/
  class Users extends CI_Controller
  {
      /**
      * constructor
      * 
      */
      function __construct()
      {
          parent::__construct();
           //check login
          checkLogin();
          $this->load->model('Users_model','users_model'); 
          $this->load->model('Util_model','util_model'); 
          $this->lang->load('global',shortlang());
          $this->session->set_userdata('active','4');
      }
      /**
      * index function
      * 
      */
      function index()
      {
          $this->usersList();
      }
      /**
      * user list
      * 
      */
      function usersList()
      {
            $start = post('start');
            if(isEmpty($start))
            {
                $start = 0;
            } 
            $keyword    = post('search');
            $data['record']=$this->users_model->getAllUsers($start,config_item('per_page'));
            $total=$this->users_model->countAllUsers(); 
            $data['pagination'] = $this->paginations->make(
            $total,
            $start,
            config_item('per_page'),
            lang('paginate'),
            site_url('users/usersList'),
            '.ulist',
            '&search='.$keyword
            );
            $data['keyword']=$keyword;
            
            $data['start']  = $start; 
            $ajax = $this->load->view('users/users_list_ajax',$data,true);
            if(post('ajax')!='')
            {                       
                echo json_encode(array('result'=>$ajax));
                return;
                
            }
            $data['list']=$ajax;                       
            $this->load->view('lib/header'); 
            $content = $this->load->view('users/users_list',$data,true);
            frame($content,true);
            $this->load->view('lib/footer');  
      }
      /**
      * add new user
      *  
      */
      function addNewUser() 
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
            $this->form_validation->set_rules('username',lang('username'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_rules('password',lang('password'),'required|trim',
            array('required' => lang('error').' %s.'));
             $this->form_validation->set_rules('rpassword',lang('rpassword'),'required|trim|matches[password]',
            array('required' => lang('error').' %s.'));
            /*$this->form_validation->set_message('required', lang('username'));
            $this->form_validation->set_message('required', lang('password'));*/
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {    
                $this->load->view('lib/header');   
                $content = $this->load->view('users/add_new_user',true,true);
                frame($content,true);
                $this->load->view('lib/footer');    
            }                          
            else
            {               
                if(!$this->util_model->getRecord('username','user',$data=array('username'=>post('username'))))
                {
                    $photo=$this->util->addImage('photo','./uploads/img/user/');
                    $data = array(
                        'name'=>post('name'),
                        'lastname'=>post('lastname'),
                        'fname'=>post('fname'),
                        'type'=>post('type'),
                        'photo'=>$photo,
                        'regDate'=>strtotime(Date('Y-m-d'))
                        );
                    $pID=''; 
                    $result=0;                                                       
                    $result = $this->util_model->insertRecords($data,'person',false);
                    $pID = $this->util_model->lastId;
                    if($result AND !isEmpty($pID))
                    {
                        unset($result);
                        $status=0;
                        if(isLogin())
                        {
                            $status =1;
                        }
                        $data = array(
                            'personId'=>$pID,
                            'username'=>post('username'),
                            'password'=>md5(post('password')),
                            'language'=>'en',
                            'active'=>$status,
                            'role'=>post('type'),
                            'regDate'=>strtotime(Date('Y-m-d'))
                            );
                        $result = $this->util_model->insertRecords($data,'user',false);
                    }
                    if($result)
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                        redirect(site_url('users/usersList'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('users/addNewUser'));    
                    }    
                }
                else
                {
                     $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                     redirect(site_url('users/addNewUser'));
                }  
            }
      }
      /**
      * to update user
      * 
      * @param mixed $userId
      * @param mixed $persionId
      */
      function updateUser($userId=0, $personId=0)
      {
            checkLogin();
            if($userId !=0 && $personId !=0)
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
                $this->form_validation->set_rules('username',lang('username'),'required|trim',
                array('required' => lang('error').' %s.'));  
                /*$this->form_validation->set_message('required', lang('username'));
                $this->form_validation->set_message('required', lang('password'));*/
                $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
                if($this->form_validation->run()==false)
                {
                    $data['record']=$this->users_model->getUserToUpdate($userId);
                    $this->load->view('lib/header');    
                    $content = $this->load->view('users/update_user',$data,true);
                    frame($content,true);
                    $this->load->view('lib/footer');    
                }                          
                else
                {               
                    if(!$this->users_model->checkUsername(post('username'),$userId))
                    {
                        $data = array(
                            'name'=>post('name'),
                            'lastname'=>post('lastname'),
                            'fname'=>post('fname'),
                            'type'=>post('type')          
                            );       
                        $result=0;                                                       
                        $result = $this->util_model->updateRecords($data,'person','id',$personId);
                        if($result)
                        {
                            unset($result);
                            $data = array(       
                                'username'=>post('username'),  
                                'active'=>post('status'),  
                                'role'=>post('type')              
                                );   
                            $result = $this->util_model->updateRecords($data,'user','id',$userId);
                        }
                        if($result)
                        {
                            $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                            redirect(site_url('users/usersList'));  
                        }
                        else
                        {
                            $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                            redirect(site_url('users/updateUser/'.$userId.'/'.$personId));    
                        }    
                    }
                    else
                    {
                         $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                         redirect(site_url('users/updateUser/'.$userId.'/'.$personId));
                    }    
                }
            }
      }
      /**
      * check for duplicate username
      *  
      */
      function checkUsername()
      {      
            $userId='';
            $username=post('username');
            if(post('user_id') AND !isEmpty(post('user_id')))
            {
                $userId =post('user_id');
            }            
            if(!isEmpty($username))
            {
                if($this->users_model->checkUsername($username,$userId))
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
      /**
      * check current password of login user
      * 
      */
      function checkCurrentPassword()
      {                
           if($this->util_model->getRecord('*','user',$data=array('id'=>getUserId(),'password'=>md5(post('current_password')))))
            {                                                                                           
                 echo '<span  style="font-size: 14px; padding:4px;background-color:#33cc00">'.lang('correct').'</span>'; 
            }
            else                                                                   
            {
                  echo '<span  style="font-size: 14px; padding:4px;background-color:#F78181">'.lang('incorrect').'</span>';   
            } 
      }
      /**
      * used to change image according to person id and photo name
      * 
      * @param mixed $personId
      * @param mixed $photoName
      */
      function changeImage($personId = 0, $photoName ='')
      {
             //delete previouse image from this path  
             $name = base_url('uploads/img/user/'.$photoName);  
             if ($photoName !='')
             {
                 unlink("./uploads/img/user/".$photoName);
             }  
             $photo_name=$this->util->addImage('image','./uploads/img/user/');  
             $data=array(
                     'photo'=>$photo_name            
              );            
             if($this->util_model->updateRecords($data,'person','id',$personId)) 
             $data['img']=$this->util_model->getRecord('photo','person',$con=array('id'=>$personId));
             return true;  
      }
      /**
      * change password  function
      * 
      */
      function changePassword() 
      {     
            checkLogin();
            $this->load->helper('form');              
            $this->lang->load('form_validation',shortlang());
            $this->form_validation->set_rules('current_password',lang('current_password'),'required|trim',
            array('required' => lang('error').' %s.'));
            $this->form_validation->set_rules('new_password',lang('new_password'),'required|trim',
            array('required' => lang('error').' %s.'));
             $this->form_validation->set_rules('rpassword',lang('rpassword'),'required|trim|matches[new_password]',
            array('required' => lang('error').' %s.'));                        
            $this->form_validation->set_error_delimiters('<div class="axs">','</div>');
            if($this->form_validation->run()==false)
            {      
                $this->load->view('lib/header');    
                $content = $this->load->view('users/change_password',true,true);
                frame($content,true);
                $this->load->view('lib/footer');    
            }                          
            else
            {               
                if($this->util_model->getRecord('*','user',$data=array('id'=>getUserId(),'password'=>md5(post('current_password')))))
                {  
                    $data = array(
                        'password'=>md5(post('new_password'))
                        );                                                              
                    $result = $this->util_model->updateRecords($data,'user','id',getUserId());
                    if($result)
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-success fade in">'.lang('successfully_done').'</div>');
                        redirect(site_url('users/changePassword'));  
                    }
                    else
                    {
                        $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                        redirect(site_url('users/changePassword'));    
                    }    
                }
                else
                {
                     $this->session->set_flashdata("msg",'<div class="alert alert-danger fade in">'.lang('try_again').'</div>');
                     redirect(site_url('users/changePassword'));
                }   
            }
      }
      /**
      * forgot password function
      * 
      */
      function forgotPassword()
      {
          ex('only manager can do this.......');
      }
     
  }
?>

