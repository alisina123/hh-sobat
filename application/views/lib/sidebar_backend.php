
<div class="widget hidden-print">
    <?php
                $active[1] = '';
                $active[2] = '';
                $active[3] = '';      
                $active[4] = '';                             
                $active[5] = '';                             
                $active[6] = '';                             
                $active[7] = '';                             
                $active[8] = '';                             
                $active[9] = '';    
                $active[10] = '';                             
                $active[$this->session->userdata('active')] ='active-sidebar';
               
                ?>     
    <ul class="nav" style="font-size: medium; font-weight: 700;">
        <li class="<?=$active[1]?>"><a href="<?=site_url('backend/newsList')?>"><span>1.</span><?=lang('news')?></a></li>
        <?php
            if(getRole()==1)
            {
        ?>
         <li class="<?=$active[2]?>"><a href="<?=site_url('backend/gallaryList')?>"><span>2.</span><?=lang('gallary')?></a></li>
        <li class="<?=$active[3]?>"><a href="<?=site_url('backend/addToSliderView')?>"><span>3.</span><?=lang('slider')?></a></li>
        <li class="<?=$active[4]?>"><a href="<?=site_url('users')?>"><span>4.</span><?=lang('users')?></a></li>
        <li class="<?=$active[5]?>"><a href="<?=site_url('backend/organizationList')?>"><span>5.</span><?=lang('organizations')?></a></li>
        <li class="<?=$active[6]?>"><a href="<?=site_url('backend/membersList')?>"><span>6.</span><?=lang('members')?></a></li>
        <li class="<?=$active[7]?>"><a href="<?=site_url('backend/aboutUs')?>"><span>7.</span><?=lang('about_us')?></a></li>
        <li class="<?=$active[8]?>"><a href="<?=site_url('backend/contactsList')?>"><span>8.</span><?=lang('contact_us')?></a></li>
        <li class="<?=$active[9]?>"><a href="<?=site_url('backend/announcementsList')?>"><span>9.</span><?=lang('anouncements')?></a></li>
        <li class="<?=$active[10]?>"><a href="<?=site_url('backend/weeknewsList')?>"><span>10.</span><?=lang('weeknews')?></a></li>
        <?php
            }
         ?>
    </ul>
</div><!-- /.widget -->
 