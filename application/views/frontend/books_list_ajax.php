 <div class="row">
    <?php
         if($record)
         {
			 
             $name='name_'.shortlang();
             $description='description_'.shortlang();
             foreach($record As $rec)
             {
     ?>
<div class="resume">          
    <div class="resume-main">
        <div class="resume-main-image " style="float: <?=shortlang()=='en'?'right':'left'?>;">
            <img src="<?=base_url('uploads/book/cover_photo/'.$rec->photo)?>" alt="">
                 
        </div><!-- /.resume-main-image -->                       
            <h2><?=$rec->$name?>
                <span class="resume-main-verified"><i class="fa fa-check"></i></span>

                <span class="resume-main-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>                         
                </span><!-- /.resume-main-rating -->
            </h2>

            <p><?=lang('published_by').': '.$rec->person_name.' '.$rec->lastname?></p>
          
            <p><?=lang('publish_date').': '.datecheck($rec->publish_date,false)?></p>
            <p>
             <?=word_limiter($rec->$description,25)?>
            </p><!-- /.resume-main-contact -->

            <div class="">
                <a href="<?=site_url('download/index/'.$rec->book)?>" class="btn btn-secondary"><i class="fa fa-download"></i><?=lang('download')?></a>
            
            </div><!-- /.resume-main-actions -->                         
    </div><!-- /.resume-main -->             
</div><!-- /.resume -->
     
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
