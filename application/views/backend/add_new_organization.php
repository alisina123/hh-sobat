 <?=$this->session->flashdata('msg');?>
<div class="header">
    <center><h4 class="title"><?=lang('add_new_organization')?></h4></center>
</div>                                                                    
<div class="row">
     <form method="POST" action="<?=site_url('backend/addNewOrganization')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
          
            <div class="col-sm-12">
                 <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name"><?=lang('name')?></label>
                        <input type="text" class="form-control rq"  name="name" id="name" placeholder="<?=lang('name')?>">
                        <?=form_error('name');?>
                   </div><!-- /.form-group --> 
                 </div>
                   <div class="col-sm-6">
                         <div class="form-group">
                            <label for="photo"><?=lang('photo')?></label> 
                            <input type="file" class="form-control rq" required  name="photo" id="photo">
                              <?=form_error('photo');?>
                        </div><!-- /.form-group --> 
                 </div>
         </div>
            <div class="col-sm-12">
                 <div class="col-sm-6">
                      <div class="form-group">
                            <label for="facebook_link"><?=lang('facebook_link')?></label> 
                            <input type="text" class="form-control rq"  name="facebook_link" id="facebook_link" placeholder="<?=lang('facebook_link')?>">
                              <?=form_error('facebook_link');?>
                        </div><!-- /.form-group --> 
                 </div>
                   <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address"><?=lang('address')?></label>
                            <input type="text" class="form-control rq"   name="address" id="address" required placeholder="<?=lang('address')?>">
                          <?=form_error('address');?>
                        </div>
                 </div>
         </div>
           <div class="col-sm-12">    
                <div class="form-group">
                    <label for="description"><?=lang('description')?></label>
                      <textarea class="ckeditor form-control" rows="5"  name="description" id="editor1" required style="max-width: 100%;"></textarea>
                 <?=form_error('description');?>
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