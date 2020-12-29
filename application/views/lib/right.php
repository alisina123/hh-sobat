<style>
html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}
</style>

<div class="filter-stacked">        
 <?php  
    if(getMostViewed())
    {             
        echo '<h3>'.lang('most_viewed').'</h3>'; 
       
        $news_title='title_'.shortlang();                                
        $news_content='content_'.shortlang();
        $news=getMostViewed();                                
        foreach($news AS $news)
        {  
        $image='';    
        $image=base_url('uploads/img/news/'.$news->photo);
    ?>
       <div class="positions-list-small-item" > 
          <h5><a href="<?=base_url('main/getNewsById/'.$news->id)?>"><?=substr($news->$news_title,0,100)?></a></h5> 
       <h3 style="font-weight:400; font-size: medium;"><span>
       <img style="width:100%" src="<?=$image?>" alt="" class=""  onerror='epic(this)'>

       
       </span>
       <?php
         $temp=word_limiter($news->$news_content,60);
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
       <p>   <a href="<?=base_url('main/getNewsById/'.$news->id)?>"><?=lang('read_more')?></a> 
      </p>  
       <p style="color: blue;"><?=lang('views').': '.$news->views?></p>
       </div>         
            <?php   
        }
                       
    } 
    ?>     
     <?php  
    if(getRedactorNote())
    {             
        echo '<h4>'.lang('redactor_note').'</h4>'; 
        $title='title_'.shortlang();                                
        $content='content_'.shortlang();
        $note=getRedactorNote();                                
        foreach($note AS $note)
        {  
        $image='';    
        $image=base_url('uploads/img/redactornote/'.$note->photo);
    ?>
       <div class="positions-list-small-item"> 
       <h5><a href="<?=base_url('main/getNoteById/'.$note->id)?>"><?=substr($note->$title,0,100)?></a></h5> 
       <h3 style="font-weight:500; font-size: medium;"><span>
       <img src="<?=$image?>" alt="" class="" onClick="view(this);" onerror='epic(this)'>
       </span>
       <?php
         $temp=substr($note->$content,0,300);
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
       <p>   <a href="<?=base_url('main/getNoteById/'.$note->id)?>"><?=lang('read_more')?></a> 
      </p>
       </div>         
            <?php   
        }
                       
    } 
    ?>  
     
               
</div><!-- /.filter-stacked -->  
<div class="filter-stacked" style="margin-top:-50px">        
 <?php
       if(getAllnewsPaper())
       {
           $cat_name='title_'.shortlang();
           $category=getAllnewsPaper(); 
           foreach($category AS $cat)
           {      
                
                           
                        echo '<h3>'.$cat->$cat_name.'</h3>'; 
                        $news_title='title_'.shortlang();                                      
                        foreach($category AS $category)
                        {  
                        $image='';    
                        $image=base_url('uploads/img/news/'.$category->photo);
                    ?>
                       <div class="positions-list-small-item"> 
                          <h5><a href="<?=base_url('main/getNewsById/'.$category->id)?>"><?=($category->$news_title)?></a></h5> 
                       <h3 style="font-weight:700; font-size: medium;">
                       <img style="width:280px" src="<?=base_url('uploads/download/'.$category->photo)?>" alt="">
                      
                      
                       </h3>
                       
                       <?=lang('publish_date').': '.datecheck($category->date,false)?>
                       <div class="">
                    
                   
                      <a href="<?=site_url('download/news/'.$category->book)?>" class="btn btn-secondary"><i class="fa fa-download"></i><?=lang('download')?></a>
                      </div><!-- /.resume-main-actions -->   
                       </div>         
                            <?php   
                        }
                                       
                   
                   
                   }
               }
           ?>  
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
