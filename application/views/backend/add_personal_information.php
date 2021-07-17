 <?=$this->session->flashdata('msg');?>
<div class="header">
    <center><h4 class="title"><?=lang('add_new_user')?></h4></center>
</div>                                                                    
<div class="row">
     <form method="POST" action="<?=site_url('backend/addPersonalInformation')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div class="col-sm-12">
            <div class="col-sm-6">
               <div class="form-group">
                    <label for="name"><?=lang('name')?></label>
                    <input type="text" class="form-control rq"  name="name" id="name" placeholder="<?=lang('name')?>" required>
                    <?=form_error('name');?>
               </div><!-- /.form-group -->  
            </div>
             <div class="col-sm-6">
               <div class="form-group">
                    <label for="lastname"><?=lang('lastname')?></label>
                    <input type="text" class="form-control rq"  name="lastname" id="lastname" placeholder="<?=lang('lastname')?>" required>
                    <?=form_error('lastname');?>
               </div><!-- /.form-group -->  
            </div>
         </div>
         
          <div class="col-sm-12">
             <div class="col-sm-6">
                <div class="form-group">
                    <label for="fname"><?=lang('name_and_lname_of_father')?></label> 
                    <input type="text" class="form-control rq"   name="fname" id="fname" placeholder="<?=lang('name_and_lname_of_father')?>" required>
                      <?=form_error('fname');?>
                </div><!-- /.form-group -->
             </div>
               <div class="col-sm-6">
                     <div class="form-group">
                        <label for="type"><?=lang('type')?></label> 
                         <select name="type" id="type" class="form-control" required>
                                <option value=""><?=lang('select')?></option> 
                                <option value="5"><?=lang('current_leader')?></option> 
                               
                         </select>
                        <?=form_error('type');?>
                    </div><!-- /.form-group -->
             </div>
         </div>
         <div class="col-sm-12">
             <div class="col-sm-6">
                <div class="form-group">
                    <label for="photo"><?=lang('photo')?></label> 
                    <input type="file" class="form-control rq" required  name="photo" id="photo">
                      <?=form_error('photo');?>
                </div><!-- /.form-group -->
             </div>
               <div class="col-sm-6">
                    <div class="form-group">
                        <label for="gender"><?=lang('gender')?></label>
                        <select class="form-control" name="gender" required>
                          <option value="male"><?=lang('male')?></option>
                          <option value="female"><?=lang('female')?></option> 
                        </select>
                      <?=form_error('gender');?>
                    </div>
             </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
              <label for="content"><?=lang('biography')?></label>
              <textarea class="ckeditor form-control" rows="6"  name="biography" id="editor1" required style="max-width: 100%;"></textarea>
              <?=form_error('biography');?>
            </div> 
         </div>
          <div class="col-sm-12">  
               <div class="form-group"> 
                 <br>
                 <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
                 <button type="Button" class="btn btn-fill btn-info" onclick="location.href='<?=site_url('users')?>'"><?=lang('back')?></button>
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