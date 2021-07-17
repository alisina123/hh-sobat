
 <?php                                   
     if($record)
     {   
         $counter = $start;
         foreach($record AS $rec) 
         {    
             $title='name_'.shortlang();                                         
             $description='description_'.shortlang();   
             $photo=base_url('uploads/img/presidency/boss/'.$rec->boss_photo);  
                                                    
 ?>                
                <div class="positions-list-item">
                    <h2>
                       <b> <?=++$counter.': '?></b><a href="<?=site_url('main/getPresidencyById/'.$rec->id)?>"><?=substr($rec->$title,0,60)?></a>
                    </h2>
                     <h5><img src="<?=$photo?>" class="img-boss" alt="" onClick="view(this);" style ="font-style:bold" onerror='epic(this)'><?='  '.$rec->boss_name?></</h5>                                                
    
                    <h3 style="font-size: 16px;"><?=substr($rec->$description,0,200)?></h3>

               </div><!-- /.position-list-item -->   
                 <?php  
         }                 
                 ?>               
             <div  class="col-md-12 pgn"><?=@$pagination?></div>            
       <?php 
  }
  else
  {
      echo '<div  class="alert alert-danger fade in">'.lang('no_record_found').'</div>';
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
