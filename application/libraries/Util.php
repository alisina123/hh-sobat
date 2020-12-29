<?php
  class Util
  {
      private $ci;
      
      function __construct()
      {
          $this->ci = & get_instance(); 
          $this->ci->load->model('Util_model');
      }
      /**
      * to check login
      * 
      * @param mixed $username
      * @param mixed $passwordgetMostViewed1
      */
      function login($username ='',$password = '')
      {
          if($username !='' && $password !='')
          {
              if(!is_null($user = $this->ci->Util_model->login($username,$password)) && ($user = $this->ci->Util_model->login($username,$password)))
              {
                  $this->ci->session->set_userdata(array( 
                  'userId'=>$user->id,
                  'personId'=>$user->personId,
                  'role'=>$user->role,
                  'status'=>1
                  )
                  );                                             
                  $this->clearAttempt($username);
                  $data = array(
                  'lastLogin'=>strtotime(date('Y-m-d H:i:s'))
                  );
                  $this->ci->Util_model->updateLastLogin($data,$user->id);
                  return true;
              }
              else
              {
                   $this->addAttempt($username);
              }
          }
      }
      /**
      * to clear attempt
      * 
      * @param mixed $username
      */
      function clearAttempt($username='')
      {
        if($username !='')
        {
            $this->ci->Util_model->clearAttempt($username,
            $this->ci->input->ip_address(),$this->ci->config->item('expire_time'));
        }   
      }
      
      /**
      * add attempt
      * 
      * @param mixed $username
      */
      function addAttempt($username = '')
      {
          if($username !='')
          {
             if(!$this->maxAttempt($username))
             {
                 $result = $this->ci->Util_model->addAttempt($username,$this->ci->input->ip_address());
                 if($result)
                 {
                     return true;
                 }
             }
          }
          return false;
      }
      /**
      * check max attempt
      * 
      * @param mixed $username
      */
      function maxAttempt($username ='')
      {
          if($username !='')
          {
              return $this->ci->Util_model->numAttempt($username,$this->ci->input->ip_address())
              >=$this->ci->config->item('max_attempt');
          }
          return false;
      }
      /**
      * to check for login
      * 
      */
      function isLogin()
      {
          if($this->ci->session->userdata('status')==1)
          {
              return true;
          }
          return false;
      }
     
      /**
      * to get role
      * 
      */
      function getRole()
      {
          return $this->ci->session->userdata('role');
      } 
       function slider()
      {
          return $this->ci->Util_model->slider();
      }
      /**
      * get user name by person id
      * 
      */
      function getUserName()
      {
          if($this->isLogin())
          {
              $personId =$this->ci->session->userdata('personId');
              return $this->ci->Util_model->getUserName($personId);
          }
          else
          {
              return false;
          } 
      }
      /**
      * get login person id
      * 
      */
      function getPersonId()
      {
          if($this->isLogin())
          {                
              return $this->ci->session->userdata('personId');
          }
          else
          {
              return false;
          } 
      }
      /**
      * get login user id
      * 
      */
      function getUserId()
      {
          if($this->isLogin())
          {                
              return $this->ci->session->userdata('userId');
          }
          else
          {
              return false;
          } 
      }
      /**
      * to logout user
      * 
      */
      function logout()
      {
          $data = array(
          'lastLogin'=>strtotime(date('Y-m-d H:i:s'))
          );
          $this->ci->Util_model->updateLastLogin($data,$this->ci->session->userdata('userId'));
          $this->ci->session->set_userdata(array( 
                  'userId'=>'',
                  'personId'=>'',
                  'role'=>'',
                  'status'=>0
                  )
                  );
          $this->ci->session->sess_destroy();
      }
    /*
    * GET RECORD FOR DROPDOWN GENERATOR
    * params:
    *   $code: provionce code , this can be array of codes or one code
    */
    function getRecordByQuery($query=''){

        if(!isEmpty($query)){
            return $this->ci->Util_model->getRecordByQuery($query);
            
        }
        return false;
    }
    function getRecord($rec ='*',$table='',$cond=array(),$start=0,$limit=0)
    {
         return  $this->ci->Util_model->getRecord($rec,$table,$cond,$start,$limit);
    }
    /**
    * get person's photo 
    * 
    */
    function getUserPhoto()
    {
        return $this->ci->Util_model->getUserPhoto(getPersonId());
    }
    /**
    * get menus
    * 
    */
    function getMenus()
    {
        return $this->ci->Util_model->getMenus();
    }
    
    function getAllFirstLevelMenu()
    {
        return $this->ci->Util_model->getAllFirstLevelMenu();
    }
    function getAllFirstLevelMenu1()
    {
        return $this->ci->Util_model->getAllFirstLevelMenu1();
    }
    function getAllNews($start=0, $limit = 0,$cond=array())
    {      
        return $this->ci->Util_model->getAllNews($start, $limit,$cond);
    }
    function getAllCategory()
    {
        return $this->ci->Util_model->getAllCategory();
    }
    function getAllnewsPaper()
    {
        return $this->ci->Util_model->getAllnewsPaper();
    }
    function getMostViewed()
    {
        return $this->ci->Util_model->getMostViewed();
    }
   
    function getRedactorNote()
    {
        return $this->ci->Util_model->getRedactorNote();
    }
    /**
    * to upload image
    * 
    * @param mixed $fid
    * @param mixed $path
    */
    function addImage($fid = '',$path = '') 
    {  
        if ($_FILES[$fid]['size'] > 0) { 
                 
                // check the type
                $config['upload_path'] = $path;
                $config['allowed_types'] = config_item('image_types');
                $config['file_name'] = strtotime(date('Y-m-d H:i:s')) . rand(1, 1000);
                $this->ci->upload->initialize($config);
                if (!$this->ci->upload->do_upload($fid) > 0) { 
                } else {
                    $this->file_info = $this->ci->upload->data();
                        return $this->file_info['file_name'];
                }
        }
        return false;
    }
    
    /*
    * GENERIC UPLOAD ATTACHMENT
    * return : uploaded file details object
    */
    
    function uploadAtt($fid='',$upload_path='',$multiple=false,$tumpSize=200,$object=null)
    {              
        $deepResult = array();
        if (!isEmpty($fid) && !isEmpty($upload_path)){
             
            //CHECK FOR ARRAY INPUT FILES
            if($multiple)
            {
                $result = array();
                    
                if($object==null)
                {    
                    // Change $_FILES to new vars and loop them
                    foreach($_FILES[$fid] as $key=>$val)
                    {  
                        $i = 1;
                        foreach($val as $v)
                        {  
                            $field_name = "file_".$i;
                            $_FILES[$field_name][$key] = $v;
                            $i++;   
                        }
                    }
                    unset($_FILES[$fid]); 

                }
                else
                {
                    $_FILES = $object;
                }
                
                
                foreach($_FILES as $key=>$value)
                {
                         
                    if ($value['size'] > 0) {  
                        $ext = explode('.',$value['name']);
                        $ext = $ext[1];
                        $isPic = false;
                        //CHECK TYPE
                        if (strpos(config_item('image_types'),$ext)!==false) {
                            $isPic = true;
                        }   
                        // check the type
                        $path = $upload_path;
                       
                        $config['upload_path']  = $path;
                        $config['allowed_types']= config_item('file_types');
                        
                        
                        $config['file_name'] = strtotime(date('Y-m-d H:i:s')) . rand(1, 1000);
                        $this->ci->upload->initialize($config);
                        
                        if (!$this->ci->upload->do_upload($key)>0) {
                            print_r($this->ci->upload->display_errors());
                        } else {
                            
                            $this->file_info = $this->ci->upload->data();
                           /* if($isPic){
                                // RESIZE IMAGE
                                resizeImage($path,$this->file_info['file_name'],'tmb_',$tumpSize);
                            }*/
                            if($object!=null){
                                $result[$value['tid']][$value['day']][] = $this->file_info;
                            }else{
                                $result []=$this->file_info['file_name']; 
                            }
                        }
                    }
                }
                return $result;
            }
            else
            {  
                if($_FILES[$fid]['size'] > 0) {
                    
                    $ext = explode('.',$_FILES[$fid]['name']);
                    $ext = $ext[1];
                    $isPic = false;
                    //CHECK TYPE
                    if (strpos(config_item('image_types'),$ext)!==false) {
                        $isPic = true;   
                    }   
                    // check the type
                    $path = $upload_path;
                       
                    $config['upload_path']  = $path; 
                    $config['allowed_types']= config_item('file_types');
                    $config['file_name']    = strtotime(date('Y-m-d H:i:s')) . rand(1, 1000);
                    $this->ci->upload->initialize($config);
                    if (!$this->ci->upload->do_upload($fid) > 0) {
                        print_r($this->ci->upload->display_errors());
                    } else {
                        $this->file_info = $this->ci->upload->data();
                              
                        if($isPic){
                            // RESIZE IMAGE   
                           // $this->ci->image_lib->resize($path,$this->file_info['file_name'],'tmb_',$tumpSize);
                       
                        }
                       
                        return $this->file_info['file_name']; 
                    }          
                }
            }
        }
        return false;
    }
    
  
      /*
   * SENDING EMAIL USEING PHP MAILER
   * params:
   *   $from: from address
   *   $to: target email addres
   *   $subject: subject of email
   *   $message: content of the email
   *   $attach: attachment file address and name
   */
    function sendMail($from='',$to='',$subject='',$message='',$attach='')
    {    
        // CHECK ALL PARAMS
        if(!isempty($from) && !isempty($to) && !isempty($subject) && !isempty($message))
        {
            $from = 'info@jobs.mcit.gov.af';
            $this->ci->load->library('SendMailSmtpClass');
            //---------------------------------------------------------------
            $mailSMTP = new SendMailSmtpClass();
            // $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя');
            //$message = config_item('email_header').$message.config_item('email_footer');
            // заголовок письма
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
            $headers .= "From: MCIT JOBS <".$from.">\r\n"; // от кого письмо
            $result   =  $mailSMTP->send($to, $subject, $message, $headers); // отправляем письмо
            // $result =  $mailSMTP->send('Кому письмо', 'Тема письма', 'Текст письма', 'Заголовки письма');
            if($result === true)
            {
               echo "Send";
            }
            else
            {
                echo "Error: " . $result;
            }

        }
        return false;
    }


  }
?>
