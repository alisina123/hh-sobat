<?php
/**
* 
*/
  class Main_model extends CI_Model
  {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /**
    * get menu
    * 
    * @param mixed $start
    * @param mixed $limit
    */
    function getMenus()
    {  
        $this->db->select('*');
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

    function getAllWeeks($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('weeks_news.*');
        $this->db->from('weeks_news');  
                                                       
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                                            
           $like .= 'weeks_news.title_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function countAllWeeks()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('weeks_news');                         
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
    }
     /**
    * get all news
    * 
    * @param mixed $start
    * @param mixed $limit
    */
    function getAllNews($start=0, $limit = 0)
    {   
        $keyword = $this->input->post('search');
        $this->db->select('news.*,ncat.name_'.shortlang().' As catgory_name');
        $this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from('news');
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';
           $like .= 'news.title_'.shortlang().' LIKE "%'.$keyword.'%" OR ';   
           $like .= 'news.source_'.shortlang().' LIKE "%'.$keyword.'%" ';
           $like .= ')';
           $this->db->where($like,null,false);
        }
        if($limit !=0)
        {
            $this->db->limit(7);
        }
        $this->db->order_by('news.id','DESC');
        $get = $this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function countAllNews()
    {        
        $this->db->select('count(*) AS total');
        $this->db->from('news');                         
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
    }
    function getLatestNews()
    {                                           
        $this->db->select('news.*,ncat.name_'.shortlang().' As catgory_name');
        $this->db->join('news_category ncat','ncat.id=news.category_id');
        $this->db->from('news');   
       $this->db->limit(5); 
        $this->db->order_by('news.id','DESC');
        $get = $this->db->get();
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;   
    }
    function getNewById($newsId=0)
    {   
        if($newsId !=0)
        {                                            
            $this->db->select('news.*,ncat.name_'.shortlang().' As catgory_name');
            $this->db->join('news_category ncat','ncat.id=news.category_id');
            $this->db->from('news');
            $this->db->where('news.id',$newsId);     
            $this->db->order_by('news.id','DESC');
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
    function updateNewsView($newsId=0)
    {
        if($newsId !=0)
        {
             $r = $this->db->query('update news set views=views+1 where id='.$newsId.'');
             if($r)
             {
                 return true;
             }
             else
             {
                 return false;
             }
        }
        else
        {
            return false;
        }
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
        $this->db->order_by('id','ASC');
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
    function getRuleById($ruleId=0)
    {  
        if($ruleId !=0)
        {
            $this->db->select('*');
            $this->db->from('rule');
            $this->db->where('id',$ruleId);        
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
    }
    function getPresidencyById($presidencyId=0)
    {  
        if($presidencyId !=0)
        {
            $this->db->select('*');
            $this->db->from('presidency');
            $this->db->where('id',$presidencyId);        
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
     
    function getProPresidencyById($presidencyId=0)
    {  
        if($presidencyId !=0)
        {
            $this->db->select('*');
            $this->db->from('presidency_province');
            $this->db->where('id',$presidencyId);        
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
    function getLeaderByType($personType=0)
    {                                             
        if($personType !=0)
        {
            $this->db->select('*');
            $this->db->from('person'); 
            $this->db->where('type',$personType); 
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
           $like .= 'book.name_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function getAllProvinces()
    {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->group_by('provincecode');
        $get=$this->db->get();
        //ex($this->db->last_query());
        if($get->num_rows()>0)
        {
            return $get->result();
        }
        return false;
    } 
    function getAllDistrict($provinceId=0)
    {       
        if($provinceId !=0)
        {
            $this->db->select('*');
            $this->db->from('province');
            $this->db->where('provincecode',$provinceId);
            $this->db->group_by('districtcode');
            $get=$this->db->get();
            //ex($this->db->last_query());
            if($get->num_rows()>0)
            {
                return $get->result();
            }
            return false;
            }
            return false;
    } 
    function getAllAnnouncements($start=0, $limit = 0)
    {
        $keyword = $this->input->post('search');  
        $this->db->select('*');
        $this->db->from('announcement');                    
        if($this->input->post('search') && $this->input->post('search') !='')
        { 
           $like = '(';                                                             
           $like .= 'announcement.title_'.shortlang().' LIKE "%'.$keyword.'%" ';
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
    function countNewsCategory()
    {        
                                                   
        $this->db->select('count(*) AS total');
        $this->db->from('news');
        //$this->db->join('news_category ncat','ncat.id=news.category_id');
        $get= $this->db->get();   
        if($get->num_rows()>0)
        {
            return $get->row()->total;
        }
        return false; 
          
       
    } 
 
   
  }
  
?>
