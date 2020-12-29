<?php
  if($record)
  {
	  //ex($record);
      $record=$record[0];
      $biography='biography_'.shortlang();
?>
       

                               
        <div class="col-sm-12">
            <div class="post-box">
                <div class="post-box-image">
                    <a href="#">
                        <img src="<?=base_url('uploads/img/aboutus/'.$record->photo)?>" alt="" onClick="view(this);" onerror='epic(this)'>
                    </a>
                </div><!-- /.post-box-image -->

                <div class="post-box-content">
                    <h4><a href="#"><?=lang('name').' '.lang('and').lang('lastname').': '.$record->name.' '.$record->lastname?></a>
                      <a href="#" style="float:<?=shortlang()=='en'?'right':'left'?>;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('main/booksList/'.$record->id)?>'"><i class="fa fa-book"></i><?=lang('books')?></a>
                    </h4>
                 
                    <h4><a href="#"><?=lang('fname').': '.$record->fname?></a></h4>

                    <p>
                        <?=$record->$biography?>
                    </p>

                    <a href="#" class="post-box-read-more">Read More</a>
                </div><!-- /.post-box-content -->
            </div><!-- /.post-box -->
        </div><!-- /.col-sm-6 -->

  

<?php
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