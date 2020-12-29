<?php
if($record)
{
    $record=$record[0];
    $title='title_'.shortlang();                                
    $content='content_'.shortlang();                    
?>
    <h3><?=$record->$title?></h3>
    <div class="content-page">   
      <p style="font-size: 18px;">
      <?=$record->$content?>
      </p>
    </div>            
<?php
}       
?>
