<div class="filter-stacked">        
 <?php
       if(getAllCategory())
       {
           $cat_name='name_'.shortlang();
           $category=getAllCategory(); 
           foreach($category AS $cat)
           {      
                $news=getAllNews(0,1,$data=array('news.category_id'=>$cat->id));
                
                    if($news)
                    {             
                        echo '<h4>'.$cat->$cat_name.'</h4>'; 
                        $news_title='title_'.shortlang();                                
                        $news_content='content_'.shortlang();                                
                        foreach($news AS $news)
                        {  
                        $image='';    
                        $image=base_url('uploads/img/news/'.$news->photo);
                    ?>
                       <div class="positions-list-small-item"> 
                          <h5><a href="<?=base_url('main/getNewsById/'.$news->id)?>"><?=word_limiter($news->$news_title,20)?></a></h5> 
                       <h3 style="font-weight:500; font-size: medium;">
                       <img style="width:100px"  src="<?=$image?>" alt="" class="" onClick="view(this);" onerror='epic(this)'>
                       <?php
                         $temp=word_limiter($news->$news_content,30);
                         $data[]='';
                         $data[0]='<h1>';
                         $data[1]='</h1>';
                         $data[2]='<h2>';
                         $data[3]='</h2>';
                         $data[4]='<h3>';
                         $data[5]='</h3>';
                         $data[6]='<h4>';
                         $data[7]='</h4>';
                         $data[8]='<h5>';
                         $data[9]='</h5>';
                         $data[10]='<h6>';
                         $data[11]='</h6>';
                         $data[12]='<p>';
                         $data[13]='</p>';
                         $data[14]='<b>';
                         $data[15]='</b>';
                         $data[16]='</b>';
                         $data[17]='<u>';
                         $data[18]='</u>';
                         $data[19]='<i>';
                         $data[20]='</i>';
                         $data[21]='<small>';
                         $data[22]='</small>';
                         $data[23]='<strong>';
                         $data[24]='</strong>';
                         $data[25]='<pre>';
                         $data[26]='</pre>';
                         $data[27]='<br>';
                         $data[28]='<br/>';
                         $data[29]='<ol>';
                         $data[30]='</ol>';
                         $data[31]='<ul>';
                         $data[32]='</ul>';
                         $data[33]='<li>';
                         $data[34]='</li>';   
                              
                         $a=str_ireplace($data,'',$temp);
                         echo $a;
                         ?> 
                        
                       </h3>
                       </div>         
                            <?php   
                        }
                                       
                    } 
                   
                   }
               }
           ?>     
               
</div><!-- /.filter-stacked -->  
<script>
//for not available image
   function epic(c) {
    c.onerror='';
    c.src='<?php echo base_url().'assets/img/not_available.jpg'?>';
};

   function view(img) {
      imgsrc = img.src.split("_")[0];
      viewwin = window.open(imgsrc,'#modal_image');    
   }
</script>
