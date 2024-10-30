<?php
$id = "vc_" . uniqid();
wp_register_style('vc_oc_default_team_hover', plugins_url('../assets/css/template/default.css', __FILE__));
wp_enqueue_style('vc_oc_default_team_hover');
ob_start();
?>  
<?php $src = wp_get_attachment_image_src($image, 'full'); ?> 
<style>
    <?php
if ($social_color)
    echo "#$id .uc_social_link a i{
            color: $social_color;
        }";
echo "#$id .uc_social_link a{
            border-color: $social_color;
        }";
?>
<?php
if ($social_hover_color)
    echo "#$id .uc_social_link a:hover i{
             color: $social_hover_color;
        }";
echo "#$id .uc_social_link a:hover{
            border-color: $social_hover_color;
        }";
?>  
<?php if ($overlay_color): ?>
        #<?php echo $id ?>.uc_member_hover_effect .uc_box_image .uc_overlay {
            background: <?php echo $overlay_color ?>;
        }
<?php endif; ?>

<?php if ($title_color || $title_text_size): ?>
        #<?php echo $id ?> .uc_title {
    <?php echo $title_color ? "color:{$title_color};" : "" ?>
    <?php echo $title_text_size ? "font-size:{$title_text_size}px" : "" ?>;
        }
<?php endif; ?>
<?php if ($caption_color || $caption_text_size): ?>
        #<?php echo $id ?> .uc_job {
    <?php echo $caption_color ? "color:{$caption_color};" : "" ?>
    <?php echo $caption_text_size ? "font-size:{$caption_text_size}px;" : "" ?>
        }
<?php endif; ?>
<?php if ($description_color || $description_text_size): ?>
        #<?php echo $id ?> .uc_content {
    <?php echo $description_color ? "color:{$description_color};" : "" ?>
    <?php echo $description_text_size ? "font-size:{$description_text_size}px" : "" ?>;
        }
<?php endif; ?>
</style>
<div id="<?php echo $id ?>" class="uc_member_hover_effect <?php echo esc_attr($css_class); ?>">
    <div class="uc_box_image">
        <img src="<?php echo $src[0] ?>" alt="" />
        <!-- start of social icon block -->
        <div class="uc_overlay">
            <div class="uc_overlay_inner">
                <?php if ($socials): ?>
                    <div class="uc_social_row">
                        <ul class="uc_social_link">
                            <?php foreach ($socials as $social) { ?>
                                <li><a <?php echo @$social['new_tab'] && (@$social['link'] && @$social['link'] != "#") ? "target='_blank'" : '' ?> href="<?php echo @$social['link'] ? $social['link'] : "#" ?>" class="uc_social_icon"><i class="fa <?php echo $social['icon'] ?>"></i><span></span></a></li>

                            <?php } ?>

                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- end of social icon  block -->
    </div>
    <!-- start of content block -->
    <div class="uc_paragraph">
        <h3 class="uc_title"><?php echo $title ?></h3>
        <small class="uc_job"><?php echo $caption ?></small>
        <p class="uc_content">
            <?php echo $description ?>
        </p>
    </div>
    <!-- end of content block -->
</div>
