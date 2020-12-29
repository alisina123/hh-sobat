<?php
/**
* user model 
* @author: Ali Mashal Frozan
*/
  class Users_model extends CI_Model
  {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /**
    * to get all users
    * 
    * @param mixed $start
    * @param mixed $limit
    */
    function getAllUsers($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');
        $from = "user AS user";
        if(getRole() !=1)
        { 
            $this->db->select('*')->from('user');
            $this->db->where('user.id',getUserId());
            $this->db->or_where('user.role >',isLogin()?getRole():2);
            $from = "(".$this->db->get_compiled_select().")AS user";
        }
        $this->db->select('user.*,p.id AS pid, p.name');
        $this->db->from($from);
        $this->db->join('person p','p.id=user.personId');
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'user.username LIKE "%'.$keyword.'%" OR ';  
           $like .= 'user.role LIKE "%'.$keyword.'%" ';
           $like .= ')';
           $this->db->where($like,null,false);
        }
        if($limit !=0)
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
     /**
     * count all users
     * 
     */
    function countAllUsers()
    {
        $from = "user AS user";
        if(getRole() !=1)
        { 
            $this->db->select('*')->from('user');
            $this->db->where('user.id',getUserId());
            $this->db->or_where('user.role >',isLogin()?getRole():2);
            $from = "(".$this->db->get_compiled_select().")AS user";
        }  
        $this->db->select('count(*) AS total');
        $this->db->from($from);
        $this->db->join('person p','p.id=user.personId');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    
    function getUserToUpdate($userId =0)
    {
        if($userId !=0)
        {                        
            $this->db->select('user.*,p.id AS pid, p.name,p.lastname,p.fname,p.type,p.photo'); 
            $this->db->from('user');
            $this->db->join('person p','p.id=user.personId');
            $this->db->where('user.id',$userId);
            $get = $this->db->get();
            if($get->num_rows()>0)
            {
                return $get->result();
            }
            else
            {
                return false;
            }
        }
    }
    /**
    * check for duplicate username
    * 
    * @param mixed $username
    * @param mixed $staff_id
    */
    function checkUsername($username='',$staff_id='')
    {
        $this->db->select('username');
        $this->db->from('user');
        $this->db->where('username',$username);
        if($staff_id && $staff_id!='')
        {
            $this->db->where_not_in('id',array($staff_id));
        }
        $get=$this->db->get();
        if($get->num_rows()>0)
        {
            return true;
        }
        return false;
        
    }
    
  }
?>
