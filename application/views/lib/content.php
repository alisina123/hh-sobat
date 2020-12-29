<div class="header-bottom container" style="margin-top:10px;background-color:#02344a">   
    <div class="container" > 
    <?php
if($latest)
{                  
?>
<div class="row">
    
      <div class="hero-content-carousel" style="height:40px;margin-bottom:20px">
    
             
            <ul class="cycle-slideshow vertical" style=" right: <?=shortlang()=="en"?'':'0px' ?>;"
                data-cycle-fx="carousel"
                data-cycle-slides="li"
                data-cycle-carousel-visible="1"
                data-cycle-carousel-vertical="true"> 
                <?php
                       foreach($latest AS $la)
                       {
                           $la_title='title_'.shortlang();
                   ?>  
                <li><h4><a style="color: #fff;" href="<?=base_url('main/getNewsById/'.$la->id)?>"><span style="color: red;"><?=lang('new_news').'  '?>: </span> <?=($la->$la_title)?></a></h4></li>  
               <?php
                       }
                ?>
              </ul>
        </div>


</div> 
<?php
}                
?> 
    </div>
    
</div>
    <div class="main-wrapper">
        <div class="main">
            <div class="container">   
                <div class="row">
                       <div class="col-md-3 col-sm-3 col-xs-12" style="float: <?=shortlang()=='en'?'left':'right'?>;">
                           <?=$left?>                   
                      </div><!-- /.col-* -->
                       <div class="col-md-3 col-sm-3 col-xs-12" style="float: <?=shortlang()=='en'?'right':'left'?>;">
                           <?=$right?>                   
                      </div>
					  <!-- /.col-* -->
                      <div class="col-md-6 col-sm-6 col-xs-12" style="background-color: #E8E8E8 ;"">
                            <!-- Content -->
                            <div class="content"> 
                                <div id="result"><!-- Results are displayed here -->
                                     <?=$content?>          
                                </div>   
                                <div id="fade">
                                     <div id="modal">   
                                        <img id="loader" src="<?=base_url()?>assets/gif/loader2.gif" />
                                    </div>
                                </div>       
                            </div>
                            <!-- Content --> 
                     </div>
                </div> 
            </div><!-- /.container -->
        </div><!-- /.main -->
    </div><!-- /.main-wrapper -->