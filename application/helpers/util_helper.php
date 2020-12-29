<?php

   /**
   * this function is used for internationalization
   * 
   * @param mixed $str
   */
      
    function lang($str = "")
    {
        $ci = & get_instance();
        if($str =="")
        {
            return $ci->session->set_userdata('lang');
        }
        else
        {
            return $ci->lang->line($str);
        }
    }
    
 
    /**
    * to set language and by default load language from config
    */
    function shortlang()
    {
        $ci = & get_instance();
        $lang = $ci->session->userdata('lang');
        if($lang !=null)
        {
            return $lang;
        }
        else
        {
            return $ci->config->item('language');
        }
    }
   /**
   * to simplify the pos method
   * 
   * @param mixed $str
   */
    function post($str = "")
    {
        $ci = & get_instance();
        if($str =='')
        {
            return $ci->input->post(); 
        }
        else
        {
            return $ci->input->post($str);
        }
    }
     /**
     * check is login
     * 
     */
    function isLogin()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        if($ci->util->isLogin())
        {
            return true;
        }
        return false;
    }
  
    /**
    * get user name
    * 
    */
    function getUserName()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getUserName();
    }
    function getUserId()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getUserId();
    }
    function getPersonId()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getPersonId();
    }
    function getUserPhoto()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getUserPhoto();
    }
    function getMenus()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getMenus();
    }
    
    function getAllFirstLevelMenu()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getAllFirstLevelMenu();
    }
    function getAllFirstLevelMenu1()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getAllFirstLevelMenu1();
    }
    function slider()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->slider();
        
    }
    /**
    * check login
    * 
    */
    function checkLogin()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        if(!$ci->util->isLogin())
        {
            redirect('main/login');
        }
        return true;
    }
      
    /*
    * PRINT OBJECTS WITH EXIT 
    * params:
    *   $str: this can be any type of variables
    */
    function ex($str=null){

        if($str==null){
            echo 'THE VARIABLE IS NULL!!!!';
        }else if($str===1){
            echo '111111';
        }else{
            echo '<pre>';print_r($str);echo '</pre>';
        }
        exit;
    }

    
    /*
    * CHECK FOR EMPTY OR NOT 
    * params:
    *   $val: this can be array or string 
    */
    function isEmpty($val){
        if($val!=null){

            if(is_array($val)){

                if(count($val)>0){
                    return false;
                }
            }else{
                if(strlen($val)>0){
                    return false;
                }
            }
        }
        return true;
    }
    /**
    * to get role
    * 
    */
    function getRole()
    {
        $ci = & get_instance();
        $ci->load->library('util');
        return $ci->util->getRole();
    }
    function getAllNews($start=0, $limit = 0,$cond=array())
    {       
        $ci= & get_instance();
        $ci->load->library('util');
        return $ci->util->getAllNews($start, $limit,$cond);
    }
    function getAllCategory()
    {
        $ci= & get_instance();
        $ci->load->library('util');
        return $ci->util->getAllCategory();
    } 
    function getAllnewsPaper()
    {
        $ci= & get_instance();
        $ci->load->library('util');
        return $ci->util->getAllnewsPaper();
    } 
    function getMostViewed()
    {
        $ci= & get_instance();
        $ci->load->library('util');
        return $ci->util->getMostViewed();
    }
    function getRedactorNote()
    {
        $ci= & get_instance();
        $ci->load->library('util');
        return $ci->util->getRedactorNote();
    }
     function getRecord($rec ='*',$table='',$cond=array(),$start=0,$limit=0)
    {
        $ci= & get_instance();
        $ci->load->library('util');   
        return  $ci->util->getRecord($rec,$table,$cond,$start,$limit);
    
    }
        // check date and convert
    function datecheck($date='',$is_date=false,$time=false)
    {
        $ci = & get_instance();
        $ci->load->library('Dateconverter');
        $t = '';

        if($time)
        {
            if($is_date == false)
            {
                $d = date('Y-m-d H:i:s',$date);
                $exp = explode(' ',$d);
                $d = $exp[0];
                $t = ' '.$exp[1];
                $is_date = true;
            }
            else
            {
                $d = $date;
            }

        }
        else
        {
            $d = $date;
        }

        $chdate = $ci->dateconverter->datecheck($d,shortlang(),$is_date);
        return $chdate.$t;
    }
    
/**
* change date
*/
function changedatetime($date='')
{
    $ci = & get_instance();
    $ci->load->library('Dateconverter');
    if($date != '')
    {
        if(shortlang() == 'en')
        {
            if(strpos($date,'/'))
            {
                $date = str_replace('/','-',$date);
            }
            return strtotime($date);
        }
        else
        {
            if(strpos($date,' '))
            {
                $persian = array('Û°', 'Û±', 'Û²', 'Û³', 'Û´', 'Ûµ', 'Û¶', 'Û·', 'Û¸', 'Û¹');
                $num = range(0, 9);
                $date = str_replace($persian, $num, $date);

                $en_date = '';
                if(strpos($date,'  '))
                {
                    $date = explode('  ',$date);
                }
                elseif(strpos($date,' '))
                {
                    $date = explode(' ',$date);
                }
                else
                {
                    $date = explode('',$date);
                }
                if(strpos($date[0],'/'))
                {
                    $d_exp = explode('/',$date[0]);
                    //$date[0] = str_replace();
                    $en_date = $ci->dateconverter->JalaliToGregorian($d_exp[0],$d_exp[1],$d_exp[2]);
                    $en_date = implode('-',$en_date);
                }
                elseif(strpos($date[0],'-'))
                {
                    $d_exp = explode('-',$date[0]);
                    //$date[0] = str_replace();
                    $en_date = $ci->dateconverter->JalaliToGregorian($d_exp[0],$d_exp[1],$d_exp[2]);
                    $en_date = implode('-',$en_date);
                }

                $datetime = $en_date.' '.$date[1];
                $datetime = strtotime($datetime);

                return $datetime;
            }
            else
            {
                $persian = array('Û°', 'Û±', 'Û²', 'Û³', 'Û´', 'Ûµ', 'Û¶', 'Û·', 'Û¸', 'Û¹');
                $num = range(0, 9);
                $date = str_replace($persian, $num, $date);
                if(strpos($date,'/'))
                {
                    $d_exp = explode('/',$date);
                    //$date[0] = str_replace();
                    $en_date = $ci->dateconverter->JalaliToGregorian($d_exp[0],$d_exp[1],$d_exp[2]);
                    $en_date = implode('-',$en_date);
                }
                elseif(strpos($date,'-'))
                {
                    $d_exp = explode('-',$date);
                    //$date[0] = str_replace();
                    $en_date = $ci->dateconverter->JalaliToGregorian($d_exp[0],$d_exp[1],$d_exp[2]);
                    $en_date = implode('-',$en_date);
                }

                $en_date = strtotime($en_date);
                return $en_date;
            }
        }
    }
    return '';
}

    
?>
