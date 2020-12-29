 <?=$this->session->flashdata('msg');?>
<?php
     if($record)
     {
         $record=$record[0];
         $title='title_'.shortlang();
         $content='content_'.shortlang();
         $image=base_url('uploads/img/redactornote/'.$record->photo);
 ?>
 <div class="header">
    <center><h4 class="title"><?=lang('update_redactor_note')?></h4></center>
</div>                                                                    
<div class="row">
     <form method="POST" action="<?=site_url('backend/updateRedactorNote/'.$record->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
          
            <div class="col-sm-12">    
                    <div class="form-group">
                          <label for="title"><?=lang('title')?></label>
                          <input type="text" class="form-control" value="<?=$record->$title?>"  name="title" id="title" required placeholder="<?=lang('title')?>">
                          <?=form_error('title');?>
                        </div> 
            </div>
            <div class="col-sm-12">     
                     <div class="form-group">
                      <div class="row">
                             <div class="col-sm-3"  style="float:<?=shortlang()=='en'?'left':'right'?>;">
                                <div>
                                      <img src="<?=$image?>" onClick="view(this);" onerror='epic(this)'  class="img-responsive img-profile user-img">
                                </div>  
                            </div>
                     </div>  
                        <label for="photo"><?=lang('change_photo')?></label> 
                         <input type="hidden" name="pr_photo" value="<?=$record->photo?>">
                        <input type="file" class="form-control rq"   name="photo" id="photo">
                          <?=form_error('photo');?>
                    </div><!-- /.form-group -->  
            </div>
            <div class="col-sm-12">
                   <div class="form-group">
                      <label for="content"><?=lang('content')?></label>
                      <textarea class="ckeditor form-control" rows="6"  name="content" id="editor1" required style="max-width: 100%;"><?=$record->$content?></textarea>
                      <?=form_error('content');?>
                    </div> 
         </div>
        
          <div class="col-sm-12">  
               <div class="form-group"> 
                 <br>
                 <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
                 <button type="Button" class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend')?>'"><?=lang('back')?></button>
               </div><!-- /.form-group -->  
         </div>

            </form>
    </div><!-- /.row --> 
 <?php
     }
  ?>
<script type="text/javascript">  
function loadAjax() {
    //document.getElementById('result').innerHTML = '';
    openModal();       
    var xhr = false;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xhr) {
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                closeModal();
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        }
        //xhr.open("POST", "<?=base_url()?>", true); 
        xhr.send(null);
    }
}

    $('#username').on('blur change',function(e){
        val = $('#username').val();
        if(val != '') {
         $.ajax({
                url: '<?=site_url('users/checkUsername')?>',
                type: 'POST',
                data:'&username='+val,
                success: function(r)
                {
                    //console.log(r);
                    $('#r_div').html(r);
                }
            });
        }
    });
     var UIToastr = function () {
    return {
        //main function to initiate the module
        init: function () {

            var i = -1,
                toastCount = 0,
                $toastlast   
            $('#save').click(function () {
                   toastr.options = {
                          "closeButton": true,
                          "debug": false,
                          "positionClass": "<?=shortlang()=='en'?"toast-top-right":"toast-top-left"?>", // toast-top-right,toast-top-left ,toast-top-center,toast-top-full-width
                          "onclick": null,
                          "showDuration": "1000",
                          "hideDuration": "1000",
                          "timeOut": "5000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                    };
                    
                pass = $('#password').val();
                rpass = $('#rpassword').val();
                if( pass =='' || rpass =='')
                {    
                    var shortCutFunction = 'error'; //infor/warning/error,success
                    var msg = '<?=lang('password').' '.lang('or').' '.lang('rpassword').' '.lang('is'). ' '.lang('empty')?>';
                    var title = '';  
                    var toastIndex = toastCount++;   
                                    
                }
                 else
                {
                    if(pass != rpass)
                    {
                        var shortCutFunction = 'warning'; //infor/warning/error
                        var msg = '<?=lang('password').' '.lang('and').' '.lang('rpassword').' '.lang('not'). ' '.lang('match')?>';
                        var title = '';  
                        var toastIndex = toastCount++;   
                           
                        
                    }
                    else
                    {
                        return true;
                    }
                }
                $("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));
                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;  
                return false;    
            });    
        }   
    };

}();
</script>