<?php
/**
* 
*/
  class Backend_model extends CI_Model
  {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /**
    * get all news
    * 
    * @param mixed $start
    * @param mixed $limit
    */
    function getAllNews($start=0, $limit = 0)
    {   
         $from = "news AS news";
         if(getRole()>1)
         {
                
                $this->db->select('*')->from('news');
                $this->db->where('news.post_by',getUserId());   
                $from = "(".$this->db->get_compiled_select().")AS news";
          }                 
        //
        $keyword = $this->input->post('search');
        $this->db->select('news.*,ncat.name_'.shortlang().' As catgory_name');
        $this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from($from);
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                                       
           $like .= 'news.title_'.shortlang().' LIKE "%'.$keyword.'%" OR ';  
           $like .= 'news.views LIKE "%'.$keyword.'%" ';
           $like .= ')';
           $this->db->where($like,null,false);
        }
        if($limit !=0)
        {
            $this->db->limit($limit,$start);
        }
        $this->db->order_by('news.id','DESC');
        $get = $this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    /**
    * count patient table according to user role
    * 
    */
    function countAllNews()
    {
        $this->db->select('count(*) AS total');
        $this->db->from('news');  
        $this->db->join('news_category ncat','ncat.id=news.category_id');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    function getNewsToUpdate($newsId=0)
    {   
        if($newsId !=0)
        {
            $this->db->select('news.*,ncat.name_'.shortlang().' As catgory_name');
            $this->db->join('news_category ncat','ncat.id=news.category_id');
            $this->db->from('news');
            $this->db->where('news.id',$newsId);
            $get = $this->db->get();
            if($get->num_rows()>0)
            {
                return $get->result();
            }
            return false; 
        }
        else
        {
            return false;
        }  
    }
     function getAllOrganization($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');
        $this->db->select('*');
        $this->db->from('organization');
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                           
           $like .= 'organization.name_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function countAllOrganization()
    {
        $this->db->select('count(*) AS total');
        $this->db->from('organization');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    
    function getSlider()
    {
        $this->db->select('count(*) AS total');
        $this->db->from('slider');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
     function getAllMembers($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('member.id AS m_id,member.r_name,member.status,p.*');
        $this->db->from('member');
        $this->db->join('person p','p.id=member.person_id');
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'p.name LIKE "%'.$keyword.'%" OR ';  
           $like .= 'p.fname LIKE "%'.$keyword.'%" OR ';   
           $like .= 'p.tazkira_number LIKE "%'.$keyword.'%" OR ';       
           $like .= 'member.r_name LIKE "%'.$keyword.'%" ';
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
    function getMemberById($meberId=0)
    {
        if($meberId !=0)
        {                                             
            $this->db->select('member.id AS m_id,member.r_name,member.r_fname,member.status,member.r_job,member.r_address,member.status,p.*,address.id AS address_id,address.province,address.district,address.village');
            $this->db->from('member');
            $this->db->join('person p','p.id=member.person_id');
            $this->db->join('address address','address.person_id=p.id');       
            $this->db->where('member.id',$meberId);
            $get = $this->db->get();
            if($get->num_rows()>0)
            {
                return $get->result();
            }
            return false;  
        } 
        else
        {
            return false;
        }
    }
     /**
     * count all members
     * 
     */
    function countAllMembers()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('member');
        $this->db->join('person p','p.id=member.person_id');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    function getAllMembersForMessage()
    { 
        $this->db->select('member.status,p.id,p.email,p.name,p.lastname,p.photo');
        $this->db->from('member');
        $this->db->join('person p','p.id=member.person_id'); 
        $this->db->where('member.status',2);
        $this->db->order_by('member.id','DESC');
        $get = $this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }    
    function getAllRules($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('rule');                           
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                                             
           $like .= 'rule.title_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function countAllRules()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('rule');                            
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    function getAllPresidencies($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('presidency');                          
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'presidency.name_'.shortlang().' LIKE "%'.$keyword.'%" OR ';       
           $like .= 'presidency.description_'.shortlang().' LIKE "%'.$keyword.'%" OR ';  
           $like .= 'presidency.boss_name LIKE "%'.$keyword.'%" ';
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
     * count all members
     * 
     */
    function countAllPresidencies()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('presidency');                         
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }  
      function getAllProPresidencies($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('presidency_province');                          
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'presidency_province.name_'.shortlang().' LIKE "%'.$keyword.'%" OR ';       
           $like .= 'presidency_province.description_'.shortlang().' LIKE "%'.$keyword.'%" OR ';  
           $like .= 'presidency_province.boss_name LIKE "%'.$keyword.'%" ';
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
     * count all members
     * 
     */
    function countAllProPresidencies()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('presidency_province');                         
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }      
    function getAllContacts($start=0, $limit = 0,$cond=array())
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('contact');                          
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'contact.name LIKE "%'.$keyword.'%" OR ';      
           $like .= 'contact.email LIKE "%'.$keyword.'%" OR ';        
           $like .= 'contact.message LIKE "%'.$keyword.'%" ';
           $like .= ')';
           $this->db->where($like,null,false);
        }
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
        $this->db->order_by('id','DESC');
        $get = $this->db->get();     
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
     /**
     * count all members
     * 
     */
    function countAllContacts()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('contact');                         
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    function getAllLeaders()
    {                                             
        $this->db->select('*');
        $this->db->from('person'); 
        $this->db->where('type',4);          
        $this->db->or_where('type',5);          
        $this->db->order_by('id','ASC');
        $get = $this->db->get();     
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function getLeaderById($personId=0)
    {                                             
        if($personId !=0)
        {
            $this->db->select('*');
            $this->db->from('person'); 
            $this->db->where('id',$personId); 
            $get = $this->db->get();     
            if($get->num_rows()>0)
            {
                return $get->result();
            }
            return false;
        }
        else
        {
            return false;
        }   
    }  
  
    function getAllBooks($start=0, $limit = 0,$cond=array())
    {                 
        $keyword = $this->input->post('search');  
        $this->db->select('book.*,p.name AS person_name,p.lastname');
        $this->db->from('book');  
        $this->db->join('person p','p.id=book.person_id');                                                  
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'book.name_'.shortlang().' LIKE "%'.$keyword.'%" OR ';              
           $like .= 'book.description_'.shortlang().' LIKE "%'.$keyword.'%" ';
           $like .= ')';
           $this->db->where($like,null,false);
        }
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
        $this->db->order_by('id','DESC');
        $get = $this->db->get(); 
        //ex($this->db->last_query());    
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
     /**
     * count all members
     * 
     */
     function countAllBooks($personId=0)
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('book'); 
        if($personId !=0)
        {
           $this->db->where('person_id',$personId);       
        }                        
        $get= $this->db->get();
        //ex($this->db->last_query());  
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    } 


   
     /**
     * count all members
     * 
     */
  
    function getAllAnnouncements($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('announcement');                    
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'announcement.title_'.shortlang().' LIKE "%'.$keyword.'%" OR '; 
           $like .= 'announcement.description_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function countAllAnnouncements()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('announcement'); 
        $get= $this->db->get();
        //ex($this->db->last_query());  
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    function getAllRedactorNotes($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');
        $this->db->select('*');
        $this->db->from('redactor_note');  
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                                                                                      
           $like .= 'redactor_note.title_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function countAllRedactorNotes()
    {
        $this->db->select('count(*) AS total');
        $this->db->from('redactor_note');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false;      
    }
    function getAllWeeks($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('weeks_news');                           
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                                             
           $like .= 'weeks_news.title_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
  }
?>
