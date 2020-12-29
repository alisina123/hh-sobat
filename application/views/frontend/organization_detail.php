<?php
if($record)
{
    $record=$record[0];
    $name='name_'.shortlang();
    $address='address_'.shortlang();
                                    
    $description='description_'.shortlang();  
    $photo='';    
    $photo=base_url('uploads/img/organization/'.$record->photo); 
                                           
?>
    
    <h3><?=$record->$name?></h3>                
    <h5><img src="<?=$photo?>" width="20%" alt=""></</h5>                                                
    <div class="content-page"> 
        <h4><a href="#"><?=lang('address').': '.$record->$address?></a></h4> 
        <h4><?=lang('facebook_link').': '?><a href="https://www.facebook.com/<?=$record->facebook_link?>" target="_blank"><?=$record->facebook_link?></a>
  </h4>
      <p style="font-size: 18px;">
      <?=$record->$description?>
      </p>
    </div>            
<?php
}       
?>
