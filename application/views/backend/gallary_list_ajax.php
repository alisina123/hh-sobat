<script src="<?=base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script>
 
    
 <?php                                   
     if($record)
     {   
         foreach($record AS $rec)
         {                                 
             
             $image='';    
             $image=base_url('uploads/img/gallary/'.$rec->photo);
 ?>             
                          <!-- PRODUCT ITEM START -->
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="candidate-box">
                          <a href="">
                          <div class="candidate-box-image">
                            <img src="<?=$image?>"  alt="" onClick="view(this);" onerror='epic(this)'>
                            
                          </div>
                          </a>
                        </div>
                      </div>
                      <!-- PRODUCT ITEM END -->
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