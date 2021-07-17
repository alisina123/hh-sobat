<?php
/**
* 
*/
  class Util_model extends CI_Model
  {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
    * to check user for name
    * 
    * @param mixed $username
    * @param mixed $password
    */
    function login($username ='', $password = '')
    {
        if($username !='' AND $password !='')
        {
            $this->db->select('*'); 
            $this->db->where('username',$username);
            $this->db->where('password',$password);
            $this->db->where('active',1);
            $get = $this->db->get('user');
            //print_r($this->db->last_query());exit;
            if($get->num_rows()==1)
            {   
                return $get->row();
            }
            return false;
        }
        return false;
    }
     /**
     * to add attempt
     * 
     * @param mixed $username
     * @param mixed $ipAddress
     */
    function addAttempt($username='' , $ipAddress = '')
    {
        if($username !='' && $ipAddress !='')
        {
            $result = $this->db->insert('attempt',array('username'=>$username,'ipAddress'=>$ipAddress));   
            if($result)
            {
                return true;
            }
            return false;
        }
        return false;
    }
    /**
    * count attempt time
    * 
    * @param mixed $username
    * @param mixed $ipAddress
    */
    function numAttempt($username = '', $ipAddress ='')
    {
        if($username !='' && $ipAddress !='')
        {
            $this->db->select('COUNT(*) AS total');
            $this->db->where('ipAddress',$ipAddress);
            $this->db->where('username',$username);
            $get= $this->db->get('attempt');
            //print_r($this->db->last_query());exit;
            if($get->num_rows()>0)
            {
                return $get->row()->total;
            }
            return false;
        } 
        return false; 
    } 
    /**
    * to clear attempt
    * 
    * @param mixed $username
    * @param mixed $ipAddress
    * @param mixed $expire_time
    */
    function clearAttempt($username ='',$ipAddress ='', $expire_time = 86400)
    {
        if($username !='' && $ipAddress !='')
        {
            $this->db->where('username',$username);
            $this->db->where('ipAddress',$ipAddress);                               
            $this->db->or_where('UNIX_TIMESTAMP(attemptTime) <',time()-$expire_time);
            $result = $this->db->delete('attempt'); 
            if($result)
            {
                return true;
            }
            return false;
        }
    }
    /**
    * update last login
    * 
    * @param mixed $data
    * @param mixed $userId
    */
    function updateLastLogin($data =array(), $userId =0)
    {
        if($userId !=0)
        {
            $this->db->trans_start();
            $this->db->where('id',$userId);
            $this->db->update('user',$data);
            $this->db->trans_complete();
        }
    }
    /**
    * get user name by person id
    * 
    * @param mixed $personId
    */
    function getUserName($personId =0)
    {
        if($personId !=0)
        {
            $this->db->select('name');
            $this->db->from('person');
            $this->db->where('id',$personId);
            $get= $this->db->get();
            //ex($this->db->last_query());
            if($get->num_rows()==1)
            {
                return  $get->row()->name;
            }
            return false;
        }
    }
    /**
    * used to insert record with specific parametrs
    * 
    * @param mixed $data
    * @param mixed $table
    * @param mixed $insertBacht
    */
    function insertRecords($data=array(),$table="", $insertBacht=false)
    {              
        if(empty($data) && $table == null)
        {
            return false;
        }
        $this->db->trans_start();
        // check which function to use Inset OR insert_batch
        if( $insertBacht == false)
         {           
            $this->db->insert($table, $data);
            $this->lastId = $this->db->insert_id();
        }
        else
        {
            
            $this->db->insert_batch($table, $data);
        }
        $this->db->trans_complete();
        
        return true;
    }
    /**
     * Update table
     * @param array $data
     * @param string $table
     * @param string $filed
     * @param string $id
     * @return bool
     */
    function updateRecords ($data=array(),$table="",$filed="",$id="",$updateBatch= false)
    { 
        //---- check if any of parameter is not correct then return false
        if(empty($data) && $id == null && $filed == null && $table == null)
            return false;
        $this->db->trans_start();
        $this->db->where($filed,$id); 
        if( $updateBatch == false)
        {
            $this->db->update($table,$data);
        }
        else
        {
            $this->db->update_batch($table,$data); 
        } 
        $this->db->trans_complete();
        return true;
    }
         
    /**
     * Delet records from table
     * @param int $table_id
     * @param int $id
     * @param string $table
     * @return bool
     */
    function  deleteRecord ($table_id=0,$id=0,$table="")
    {
            if ($id == 0 && $table == null && $table_id==0)
                return false;
            $this->db->trans_start();
            $this->db->where($table_id,$id);
            $this->db->delete($table);
            $this->db->trans_complete();
            return true;
    } 
        
    /**
    *get record
    *
    */
    function getRecord($rec ='*',$table='',$cond=array(),$start=0,$limit=0)
    { 
        if($table != '')
        {
            $this->db->select($rec);
            $this->db->from($table);
            if(!empty($cond))
            {
                foreach($cond AS $k=>$v)
                {
                    $this->db->where($k,$v);
                }
            }
            if($limit!=0)
            {
                $this->db->limit($limit,$start);
            }
            $this->db->order_by('id','DESC');                                        
            $get = $this->db->get();    
            if($get->num_rows()>0)
            {   
                return $get->result();
            }
            return false;
        }
    }
    /*
    
    */
    function countTable($rec ='*',$table='',$cond=array())
    {
        if($table != '')
        {
            $this->db->select('count('.$rec.') AS total');
            $this->db->from($table);
            if(!empty($cond))
            {
            foreach($cond AS $k=>$v)
            {
                $this->db->where($k,$v);
            }
            }
            $get = $this->db->get();
            if($get->num_rows()>0)
            {
                return $get->row()->total;
            }
            return false;
        }
    }
    /**
    * to get photo name by person id
    * 
    * @param mixed $personId
    */
    function getUserPhoto($personId=0)
    {
        if($personId !=0)
        {
            $this->db->select('photo');
            $this->db->from('person');
            $this->db->where('id',$personId);
            $get=$this->db->get();      
            if($get->num_rows()==1)
            {    
                return $get->row()->photo;
            }
            else
            {
                return false;
            }
        }
    }
    function slider()
    {
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->limit(4);
        $this->db->order_by('id','DESC');       
        $get=$this->db->get();      
        if($get->num_rows()>0)
        {    
            return $get->result();
        }
        else
        {
            return false;
        } 
    }
      /*
    * GET RECORD BY QUERY
    * params:
    *   $query: specific query
    */
    function getRecordByQuery($query='')
    {
        if(!isEmpty($query))
        {
            $r = $this->db->query($query);
            if($r && $r->num_rows()>0)
            {
                return $r->result();
            }
        }
        return false;
    }
    function getMenus()
    {  
        $this->db->select('parent_id,title_'.shortlang().' AS title,link,menu_order');
        $this->db->from('menu');
        if(shortlang()=='en')
        {
            $this->db->order_by('menu_order','ASC');
        }
        else
        {
            $this->db->order_by('menu_order','DESC');
        }
        $get = $this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    } 
    
    function getAllFirstLevelMenu($start=0, $limit = 0,$cond=array())
    {                             
        $this->db->select('*');
        //$this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from('news');
        if(!empty($cond))
        {
            foreach($cond AS $k=>$v)
            {
                $this->db->where($k,$v);
            }
        }
        if(shortlang()=='en')
        {
            $this->db->order_by('news_category.id','DESC');
        }
        else
        {
            $this->db->order_by('news_category.id','DESC');
        }
        if($limit !=0)
        {
            $this->db->limit($limit,$start);
        }
        $this->db->order_by('news.id','DESC');
        $get = $this->db->get(); 
        //ex($this->db->last_query());   
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function getAllFirstLevelMenu2($start=0, $limit = 0,$cond=array())
    {                             
        $this->db->select('*');
        //$this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from('news');
        if(!empty($cond))
        {
            foreach($cond AS $k=>$v)
            {
                $this->db->where($k,$v);
            }
        }
        if(shortlang()=='en')
        {
            $this->db->order_by('news_category.id','DESC');
        }
        else
        {
            $this->db->order_by('news_category.id','DESC');
        }
        if($limit !=0)
        {
            $this->db->limit($limit,$start);
        }
        $this->db->order_by('news.id','DESC');
        $get = $this->db->get(); 
        //ex($this->db->last_query());   
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function getAllFirstLevelMenu1($start=0, $limit = 0,$cond=array())
    {                             
        $this->db->select('*');
        //$this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from('news_category');
        if(!empty($cond))
        {
            foreach($cond AS $k=>$v)
            {
                $this->db->where($k,$v);
            }
        }
        if($limit !=0)
        {
            $this->db->limit($limit,$start);
        }
        $this->db->order_by('news_category.id','ASC');
        $get = $this->db->get(); 
        //ex($this->db->last_query());   
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function getAllNews($start=0, $limit = 0,$cond=array())
    {                             
        $this->db->select('*');
        //$this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from('news');
        if(!empty($cond))
        {
            foreach($cond AS $k=>$v)
            {
                $this->db->where($k,$v);
            }
        }
        if($limit !=0)
        {
            $this->db->limit($limit,$start);
        }
        $this->db->order_by('news.id','DESC');
        $get = $this->db->get(); 
        //ex($this->db->last_query());   
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function getAllCategory()
    {
        $this->db->select('*');
        $this->db->from('news_category');  
        $get=$this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
    } 
    
    function getAllnewsPaper()
    {
        $this->db->select('*');
        $this->db->from('weeks_news');  
        $this->db->limit(1);
        $this->db->order_by('weeks_news.id','DESC');
        $get=$this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
    } 
    function findMostViewedId()
    {
        $this->db->select('max(views) AS max_viewed');
        $this->db->from('news');                 
        $get=$this->db->get();   
        //ex($this->db->last_query());
        if($get->num_rows()>0)
        {
            return $get->row()->max_viewed;
        }
        else
        {
            return 0;
        }
    }
     function getMostViewed()
    {   
        $views=$this->findMostViewedId();
        $this->db->select('*');
        $this->db->from('news'); 
        $this->db->where('views',$views);                
        $get=$this->db->get();   
        //ex($this->db->last_query());
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
    } 
    function getRedactorNote()
    {   
        $views=$this->findMostViewedId();
        $this->db->select('*');
        $this->db->from('redactor_note'); 
        $this->db->limit(2); 
        $this->db->order_by('id','DESC');              
        $get=$this->db->get();   
        //ex($this->db->last_query());
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        else
        {
            return 0;
        }
    } 
     
    
  }
?>
