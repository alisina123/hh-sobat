 <div class="row">
    <?php
         if($record)
         {
                                
             foreach($record As $rec)
             {
                $title='title_'.shortlang();
                $description='description_'.shortlang();    
                $image=base_url('uploads/img/announcement/'.$rec->photo);
     ?>
            <div class="post-box-small post-box"> 
                  <div class="post-box-image" style="float: <?=shortlang()=='en'?'':'right'?>;">
                    <a href="#">
                        <img src="<?=$image?>" alt="" onClick="view(this);" onerror='epic(this)'>
                    </a>
                </div><!-- /.post-box-image --> 
                <div class="post-box-content">
                    <h5><a href="<?=base_url('main/announcementDetail/'.$rec->id)?>"><?=word_limiter($rec->$title,25).'  '.lang('date').': '.datecheck($rec->date,false)?></a></h5>

                    <p>
                        <?=word_limiter($rec->$description,100)?> <a href="<?=base_url('main/announcementDetail/'.$rec->id)?>"><?=lang('read_more')?></a></p>
                </div><!-- /.post-box-content --> 
                
            </div><!-- /.post-box -->    
     
     <?php
             }
      ?>
             <div  class="col-md-12 col-sm-12 col-xs-12 pgn"><?=@$pagination?></div>
     
    <?php
        }
        else
        {
            echo '<div class="alert alert-danger fade in">'.lang('no_record_found').'</div>';
        }
    ?>
    </div>
