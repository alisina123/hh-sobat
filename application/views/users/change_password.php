<?=$this->session->flashdata('msg')?>
<div class="header">
    <center><h4 class="title"><?=lang('change_password')?></h4></center>
</div>                                                                    
  <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
       
            <form method="POST" action="<?=site_url('users/changePassword/')?>" onsubmit="javascript: void(0);loadAjax();">
                <div class="form-group">
                    <label for="current_password"><?=lang('current_password')?></label>
                    <input type="text" class="form-control" required  name="current_password" id="current_password">
                    <?=form_error('current_password');?>
                    <div id="r_div"></div>
               </div><!-- /.form-group -->

                <div class="form-group">
                    <label for="new_password"><?=lang('new_password')?></label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                         <?=form_error('new_password');?>
                </div><!-- /.form-group -->
                 <div class="form-group">
                    <label for="rpassword"><?=lang('rpassword')?></label>
                    <input type="password" class="form-control" name="rpassword" id="rpassword">
                         <?=form_error('rpassword');?>
                </div><!-- /.form-group -->
                

                <div class="form-group">   
                         <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
                         <button type="Button" class="btn btn-fill btn-info" onclick="location.href='<?=site_url('users')?>'"><?=lang('back')?></button>
                </div><!-- /.form-group -->
                
           
            </form>
        </div><!-- /.col-sm-4 -->
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
        //xhr.open("POST", "<?=site_url()?>", true); 
        xhr.send(null);
    }
}
    $('#current_password').on('blur change',function(e){
        val = $('#current_password').val();
        if(val != '') {
         $.ajax({
                url: '<?=site_url('users/checkCurrentPassword')?>',
                type: 'POST',
                data:'&current_password='+val,
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
                    
                pass = $('#current_password').val();
                pass = $('#new_password').val();
                rpass = $('#rpassword').val();
                if( pass =='' || rpass =='')
                {    
                    var shortCutFunction = 'error'; //infor/warning/error,success
                    var msg = '<?=lang('new_password').' '.lang('or').' '.lang('rpassword').' '.lang('is'). ' '.lang('empty')?>';
                    var title = '';  
                    var toastIndex = toastCount++;   
                                    
                }
                 else
                {
                    if(pass != rpass)
                    {
                        var shortCutFunction = 'warning'; //infor/warning/error
                        var msg = '<?=lang('new_password').' '.lang('and').' '.lang('rpassword').' '.lang('not'). ' '.lang('match')?>';
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