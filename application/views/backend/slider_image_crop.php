<!-- END PAGE LEVEL SCRIPTS -->
 <?=$this->session->flashdata('msg');?>
<?php
     if($image)
     {
     
 ?>
 <center><h3><?=lang('add_to_slider')?></h3></center>  
 
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/sliderImageCrop/'.$image)?>"  enctype="multipart/form-data" id="coords" class="coords form-inline">
 
    <div class="company-item table-responsive table-full-width">
       
        <img src="<?=base_url('uploads/img/slider/'.$image)?>" id="demo2" alt="Jcrop Example" class="img-responsive"/>
    </div>
    <div class="row">                  
                    
                    <label class="control-label">X1</label>
                    <input type="text" id="x1" name="x1" class="form-control btn-sm"/>
         
                    <label class="control-label">Y1</label>
                    <input type="text" id="y1" name="y1" class="form-control btn-sm"/>
               
           
                    <label class="control-label">X2</label>
                    <input type="text" id="x2" name="x2" class="form-control btn-sm"/>
          
                    <label class="control-label">Y2</label>
                    <input type="text" id="y2" name="y2" class="form-control btn-sm"/>
               
           
                    <label class="control-label">Width</label>
                    <input type="text" id="w" name="w" class="form-control btn-sm"/>
          
                    <label class="control-label">Height</label>
                    <input type="text" id="h" name="h" class="form-control btn-sm"/>
              
    </div>   
 
    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
    </div>
  </form>
  <!-- END FORM-->  
 <?php
     }
  ?>
<script type="text/javascript">
 
 $("#user_image_display").click(function() {
        $("input[id='user_image']").click();
    });

    $('#user_image_form').on('submit',(function(e) {  
        e.preventDefault();  
        if($('#user_image').val() != '') {
               
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                 $("#photo").load(location.href + " #photo"); 
                                                     
                }
            });
        }
        else {
            var msg='<?=lang('select').' '.lang('file')?>';
            alert(msg);
            return 0;                          
        }
    }));

</script>

