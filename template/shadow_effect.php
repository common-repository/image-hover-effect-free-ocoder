<?php
$id = "vc_" . uniqid();
wp_register_style('vc_oc_team_member_shadow_effect_hover', plugins_url('../assets/css/template/shadow_effect.css', __FILE__));
wp_enqueue_style('vc_oc_team_member_shadow_effect_hover');
ob_start();
?>  
<?php $src = wp_get_attachment_image_src($image, 'full'); ?> 
<style>
                <?php
if ($social_color)
    echo "#$id .uc_social_icons a .fa{
            color: $social_color;
        }";
echo "#$id .uc_social_icons a{
            border-color: $social_color;
        }";
?>
<?php
if ($social_hover_color)
    echo "#$id .uc_social_icons a:hover .fa{
             color: $social_hover_color;
        }";
echo "#$id .uc_social_icons a:hover{
            border-color: $social_hover_color;
        }";
?>  
<?php if ($overlay_color): ?>
#<?php echo $id ?>.uc_team_member_shadow_effect .uc_team_member  .uc_team_image .uc_social_icons {
            box-shadow: inset 0 0 0 0  <?php echo $overlay_color ?>;
            /*opacity: 1;*/
        }
        #<?php echo $id ?>.uc_team_member_shadow_effect .uc_team_member:hover .uc_team_image .uc_social_icons {
            box-shadow: inset 0 0 0 250px  <?php echo $overlay_color ?>;
        }
<?php endif; ?>

<?php if ($title_color || $title_text_size): ?>
        #<?php echo $id ?> .uc_title {
    <?php echo $title_color ? "color:{$title_color};" : "" ?>
    <?php echo $title_text_size ? "font-size:{$title_text_size}px;line-height:".($title_text_size+1)."px;" : "" ?>;
        }
<?php endif; ?>
<?php if ($caption_color || $caption_text_size): ?>
        #<?php echo $id ?> .uc_job {
    <?php echo $caption_color ? "color:{$caption_color};" : "" ?>
    <?php echo $caption_text_size ? "font-size:{$caption_text_size}px;" : "" ?>
        }
<?php endif; ?>
<?php if ($description_color || $description_text_size): ?>
        #<?php echo $id ?> .uc_description {
    <?php echo $description_color ? "color:{$description_color};" : "" ?>
    <?php echo $description_text_size ? "font-size:{$description_text_size}px" : "" ?>;
        }
<?php endif; ?>
</style>
<div id="<?php echo $id ?>" class="uc_team_member_shadow_effect <?php echo esc_attr($css_class); ?>">
    <div class="uc_team_member">
        <div class="uc_team_image">
            <img src="<?php echo $src[0] ?>" alt="<?php echo $title ?>" />
            <?php if ($socials): ?>
                <ul class="uc_social_icons">
                    <?php foreach ($socials as $social) { ?>
                        <li><a <?php echo @$social['new_tab'] && (@$social['link'] && @$social['link'] != "#") ? "target='_blank'" : '' ?> href="<?php echo @$social['link'] ? $social['link'] : "#" ?>" class="uc_social_icon"><i class="fa <?php echo $social['icon'] ?>"></i><span></span></a></li>

                    <?php } ?>

                </ul>
            <?php endif; ?>
        </div>
        <h4 class="uc_title"><?php echo $title ?> 
            <span class="uc_job" style="font-weight:300;display:block;font-size:15px;color:#999;"><?php echo $caption ?></span></h4>
        <p class="uc_description"><?php echo $description ?></p>
    </div>
</div>
