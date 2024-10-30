<?php
$eff = str_replace("effect", "", $circle_effect);
if ($eff > 8) {
    echo "This only for <a href='https://codecanyon.net/item/image-hover-effects-for-team-member-and-product-visual-composer/19501499?ref=trungstormsix'>Pro Version, please buy it</a>.<br>";
} else {
    $id = "vc_" . uniqid();

    wp_register_style('oc-ihover', plugins_url('../assets/css/template/oc-ihover.css', __FILE__));
    wp_enqueue_style('oc-ihover');
    ob_start();
    ?>  
    <?php $src = wp_get_attachment_image_src($image, 'full'); ?> 
    <style>
    <?php
    if ($social_color)
        echo "#$id .uc_team_social a {
            color: $social_color;
        }";
    ?>
    <?php
    if ($social_hover_color)
        echo "#$id .uc_team_social a:hover {
            color: $social_hover_color;
        }";
    ?>  
    <?php if ($circle_size): ?>
            #<?php echo $id ?> .oc-items.circle {
                width: <?php echo $circle_size ?>px;
            }
            #<?php echo $id ?> .oc-items.circle .info {
                height: <?php echo $circle_size ?>px;
                width: <?php echo $circle_size ?>px;
            }
            #<?php echo $id ?> .oc-items.circle .info-back{
                height: <?php echo $circle_size ?>px;
                width: <?php echo $circle_size ?>px;
            }
             
            #<?php echo $id ?> .oc-items.circle .img {
                width: <?php echo $circle_size ?>px;
                height: <?php echo $circle_size ?>px;
            }
        <?php if ($circle_effect == "effect1"): ?>
                #<?php echo $id ?>  .oc-items.circle.effect1 .spinner {
                    width: <?php echo $circle_size + 10 ?>px;
                    height: <?php echo $circle_size + 10 ?>px;
                }
                #<?php echo $id ?> .oc-items.circle .img {
                    width: <?php echo $circle_size - 10 ?>px;
                    height: <?php echo $circle_size - 10 ?>px;
                }
                #<?php echo $id ?> .oc-items.circle .info,
                #<?php echo $id ?> .oc-items.circle .info-back{
                    height: <?php echo $circle_size - 10 ?>px;
                    width: <?php echo $circle_size - 10 ?>px;
                }
        <?php else: ?>
                #<?php echo $id ?> .oc-items.circle .img {
                    width: <?php echo $circle_size ?>px;
                    height: <?php echo $circle_size ?>px;
                }
        <?php endif; ?>
    <?php endif; ?>
         
    <?php if ($overlay_color): ?>
            #<?php echo $id ?> .oc-items.circle .info {
                background:  <?php echo $overlay_color ?>;
            }
             
    <?php endif; ?>
    <?php if ($title_color || $title_text_size): ?>
            #<?php echo $id ?> .oc-items.circle .uc_title {
        <?php echo $title_color ? "color:{$title_color};" : "" ?>
        <?php echo $title_text_size ? "font-size:{$title_text_size}px" : "" ?>;
            }
    <?php endif; ?>
    <?php if ($caption_color || $caption_text_size): ?>
            #<?php echo $id ?> .oc-items.circle .uc_caption_position {
        <?php echo $caption_color ? "color:{$caption_color};" : "" ?>
        <?php echo $caption_text_size ? "font-size:{$caption_text_size}px;" : "" ?>
            }
    <?php endif; ?>
    <?php if ($description_color || $description_text_size): ?>
            #<?php echo $id ?> .oc-items.circle .uc_description_position {
        <?php echo $description_color ? "color:{$description_color};" : "" ?>
        <?php echo $description_text_size ? "font-size:{$description_text_size}px" : "" ?>;
            }
    <?php endif; ?>
    </style>
    <div id="<?php echo $id ?>" class="main">
        <div class="oc-items circle <?php echo $circle_effect ?> <?php echo $th_animation ?>"> 
            <?php if ($circle_effect == "effect1"): ?>
                <div class="spinner"></div>
            <?php endif; ?>
            <div class="img">       
                <img class="uc_img_circle" src="<?php echo $src[0] ?>" alt="<?php echo $title ?>" />
            </div>
            <div class="info" id="tex_contain" <?php if ($circle_effect != "effect5") echo 'style="display: table;"' ?>>
                <?php if ($circle_effect != "effect5"): ?>
                    <div style="display: table-cell; vertical-align: middle;">
                    <?php endif; ?>
                    <?php if ($circle_effect == "effect5" || $circle_effect == "effect18" || $circle_effect == "effect20"): ?>
                        <div class="info-back">
                        <?php endif; ?>
                        <h2 class="uc_title"><?php echo $title ?></h2>
                        <p class="uc_caption_position"><?php echo $caption ?></p>
                        <?php if ($description): ?>
                            <p class="uc_description_position"><?php echo $description ?></p>
                        <?php endif; ?>   
                        <?php if ($circle_effect == "effect5" || $circle_effect == "effect18" || $circle_effect == "effect20"): ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($circle_effect != "effect5"): ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($socials): ?>
                <p class="uc_team_social"> <?php
                    foreach ($socials as $social) {
                        if (filter_var($social['link'], FILTER_VALIDATE_EMAIL)) {
                            $social['link'] = "mailto:" . $social['link'];
                        }
                        ?>            
                        <a <?php echo @$social['new_tab'] && (@$social['link'] && @$social['link'] != "#") ? "target='_blank'" : '' ?> href="<?php echo @$social['link'] ? $social['link'] : "#" ?>" class="uc_social_icon"><i class="fa <?php echo $social['icon'] ?>"></i></a>
                        <?php } ?>
                </p>
            <?php endif; ?>
        </div>

    </div>
<?php
}