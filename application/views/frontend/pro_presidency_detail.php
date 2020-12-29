<?php
if($record)
{
    $record=$record[0];
    $name='name_'.shortlang();
                                    
    $description='description_'.shortlang();  
    $photo=base_url('uploads/img/presidency/boss/'.$record->boss_photo);                  
?>
    
    <h3><?=$record->$name?></h3>                
    <h5><img src="<?=$photo?>" class="img-boss" alt=""> &nbsp;&nbsp;&nbsp;&nbsp;<?=$record->boss_name?></</h5>                                                
    <div class="content-page">   
      <p style="font-size: 18px;">
      <?=$record->$description?>
      </p>
    </div>            
<?php
}       
?>
