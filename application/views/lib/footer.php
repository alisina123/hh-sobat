 
   


<!--    <div class="partners container hidden-print">
    <?php
              $record=getRecord('*','organization',$cond=array(),0,20);
               if($record)
               {    $counter=0; 
                    foreach($record AS $rec)
                    {
                        if(++$counter>5)
                        {
                            break;
                        }
                        $name='name_'.shortlang();
                        $image='';    
                        $image=base_url('uploads/img/organization/'.$rec->photo); 
              ?>
               <a href="#">
                    <img src="<?=$image?>" alt="<?=$name?>">
                </a>
              <?php
                    }
               }   
               ?>    
</div>
       -->

   
    <div class="footer">
    
    
    
    <div class="footer-top">
            <div class="container">
                <div class="row">
                <img src="<?=base_url()?>assets/img/logo.jpg" width="110px" height="110px" style="float: left;">
                    <div class="col-sm-15">
                        <div class="footer-top-block" style="">
							
							<p style="text-align:center;margin-top:15px">© کپی رایت2020, کلیه حقوق برای  حزب حرکت اسلامی ثبات افغانستان محفوظ است.</p>
							
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social"  style="text-align:center;"  href="www.facebook.com"><i aria-hidden="true" class="fa fa-facebook" data-toggle="tooltip" title="Facebook"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social" href="www.facebook.com"><i aria-hidden="true" class="fa fa-twitter" data-toggle="tooltip" title="twitter"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social" style="color:#c8102e" href="www.facebook.com"><i aria-hidden="true" class="fa fa-youtube-play" data-toggle="tooltip" title="youtube"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="social" style="color:#c8102e" href="www.facebook.com"><i aria-hidden="true" class="fa fa-instagram" data-toggle="tooltip" title="instagram"></i></a>

    

                        </div><!-- /.footer-top-block -->
                    </div><!-- /.col-* -->

                    

                    
                        
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-top -->

      
    </div><!-- /.footer -->
  
    
</div><!-- /.footer-wrapper -->

</div><!-- /.page-wrapper -->



<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.ezmark.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-sass/javascripts/bootstrap/collapse.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-sass/javascripts/bootstrap/dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-sass/javascripts/bootstrap/tab.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-sass/javascripts/bootstrap/transition.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-wysiwyg/bootstrap-wysiwyg.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/libraries/cycle2/jquery.cycle2.min.js"></script>          
<script type="text/javascript" src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>         
<?php
     if(shortlang()=="en")
     {
 ?>
 
<script type="text/javascript" src="<?=base_url()?>assets/libraries/cycle2/jquery.cycle2.carousel_en.min.js"></script> 
 <?php
   }
   else
   {
  ?>
  
<script type="text/javascript" src="<?=base_url()?>assets/libraries/cycle2/jquery.cycle2.carousel_dr.min.js"></script> 
  <?php
   }
   ?>

<script type="text/javascript" src="<?=base_url()?>assets/libraries/countup/countup.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/profession.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/custom.js"></script>

<script src="<?=base_url()?>assets/js/new/metronic.js" type="text/javascript"></script> 
<!--<script src="<?=base_url()?>assets/image-crop/jcrop/js/jquery.Jcrop.min.js"></script>
<script src="<?=base_url()?>assets/image-crop/form-image-crop.js"></script> -->
<script type="text/javascript" src="<?=base_url()?>assets/date/js/bootstrap-datepicker.min.js"></script>  
 
<!-- <script type="text/javascript" src="<?=base_url()?>assets/date/js/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/date/js/jquery.datepair.min.js"></script>
-->  
<script src="<?=base_url()?>assets/date/js/persian-datepicker-0.4.5.js"></script> 
<script src="<?=base_url()?>assets/date/js/pwt-date.js"></script>                
<!-- <script src="<?=base_url()?>assets/date/js/bootstrap-datepicker.min2.js"></script>
-->


          
<script type="text/javascript">
    $(document).ready(function(){
       Metronic.init();
       UIToastr.init();    
       //FormImageCrop.init(); 
           $(document).ready(function() {



        

        // ======== Disable Right Click ========
        //
        //   .-"""-.
        //  / _   _ \
        //  ](_' `_)[
        //  `-. x ,-' 
        //    |~~~|
        //    `---'
        //

         document.addEventListener('contextmenu', function(e) {
           e.preventDefault();
        }
		);


    });                
    });
        
</script>   
</body>

<!-- Mirrored from preview.byaviators.com/template/profession/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Feb 2016 10:31:10 GMT -->
</html>
