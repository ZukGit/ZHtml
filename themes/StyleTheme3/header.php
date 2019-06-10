<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php if ( is_home() ) { ?>
<title><?php echo stripslashes(get_option('tang_title')); ?></title>
<meta name="description" content="<?php echo stripslashes(get_option('tang_description')); ?>" />
<meta name="keywords" content="<?php echo stripslashes(get_option('tang_keywords')); ?>" />
<?php } ?>
<?php
if (!function_exists('utf8Substr')) {
    function utf8Substr($str, $from, $len)
    {
        return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s','$1',$str);
    }
}
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
        if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
            $post_content = $result['1'];
        } else {
            $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
            $post_content = $post_content_r['0'];
        }
        $description = utf8Substr($post_content,0,220);
    }
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
?>
<?php if ( is_single() ) { ?>
<title><?php echo trim(wp_title('',0)); ?></title>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_page() ) { ?>
<title><?php echo trim(wp_title('',0)); ?></title>
<?php } ?>
<?php if ( is_category() ) { ?>
<title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_search() ) { ?>
<title>搜索结果 - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_day() ) { ?>
<title><?php the_time('Y年n月j日'); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_month() ) { ?>
<title><?php the_time('Y年M'); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_year() ) { ?>
<title><?php the_time('Y年'); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
<title><?php single_tag_title("", true); ?> - <?php bloginfo('name'); ?></title>
<?php } } ?>
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/icon_32.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/images/icon_152.png">
<link rel="apple-touch-icon" sizes="167x167" href="<?php bloginfo('template_directory'); ?>/images/icon_167.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/images/icon_180.png">
<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/icon_32.png" type="image/x-icon">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>


<?php  if((is_single() || is_page()) && !wpmd_is_phone() ) {
	$value1 = get_bloginfo('template_directory');
echo    ' <script type="text/javascript" src="'.$value1.'/js/jquery.ztree.all-3.5.min.js"></script>';
echo    ' <script type="text/javascript" src="'.$value1.'/js/toc_conf.js"></script>';
echo    ' <script type="text/javascript" src="'.$value1.'/js/ztree_toc.js"></script>';
echo    ' <script type="text/javascript" src="'.$value1.'/js/windows_load.js"></script>';
echo    ' <link rel="stylesheet" href="'.$value1.'/css/nav_back.css">';
echo    ' <link rel="stylesheet" href="'.$value1.'/css/nav_plus.css">';
echo    ' <link rel="stylesheet" href="'.$value1.'/css/zTreeStyle.css">';

} ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/nav_opt.js"></script>


<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
wp_head();
?>
<style type="text/css">
a{color:<?php echo stripslashes(get_option('tang_color')); ?>}
a:hover{color:<?php echo stripslashes(get_option('tang_color_hover')); ?>!important}
.navdiv a:hover{color:#7f42c1 !important}

#header{background-color:<?php  if(is_single() || is_page()){ echo stripslashes(get_option('tang_color'));}else {echo 'rgba(0, 0, 0, 0.01)'; }; ?>!important}
.widget .widget-title::after{background-color:<?php echo stripslashes(get_option('tang_color')); ?>}
.uptop{border-left-color:<?php echo stripslashes(get_option('tang_color')); ?>}
.sub-menu{background-color:<?php echo 'rgba(128, 52, 187, 0.8)'?>    !important}
#header .nav ul li { border-bottom: 1px solid #d1f1e9; !important}
#header .nav a:hover {cursor: pointer;color: #00ff10 !important;}

#titleBar .toggle:before{background:<?php echo stripslashes(get_option('tang_color')); ?>}
#titleBar .title { background:#5cedcb  !important }

<?php  if((is_single() || is_page()) && !wpmd_is_phone() ) {
echo ".col-md-offset-2 {margin-left: 15em;  !important}";
echo ".ztree li a.curSelectedNode {  background-color: #5cc26f !important; }";
echo " .ztree li a {     color: #8351c6; }  "; 

echo " .col-md-8 { width: 80% !important; }"; 
echo "  .img-circle {border-radius: 50% !important;  }"; 
} ?>


</style>
</head>

<?php if (is_single() || is_page()) {
echo '<body>';
}else{
echo '<body class="custom-background">';
}
?>


<header id="header">
    <div class="avatar"><a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo stripslashes(get_option('tang_avatar')); ?>" alt="<?php bloginfo('name'); ?>" class="img-circle" width="50%"></a></div>
    <h1 id="name"><?php bloginfo('name'); ?></h1>
    <div class="sns">
        <?php if (get_option('tang_rss') == '显示') { ?><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i></a><?php } ?>
        <?php if (get_option('tang_weibo') == '显示') { ?><a href="<?php echo stripslashes(get_option('tang_weibo_url')); ?>" target="_blank" rel="nofollow" title="Weibo"><i class="fa fa-weibo" aria-hidden="true"></i></a><?php } ?>
        <?php if (get_option('tang_twitter') == '显示') { ?><a href="<?php echo stripslashes(get_option('tang_twitter_url')); ?>" target="_blank" rel="nofollow" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php } ?>
		
		<?php if (get_option('tang_csdn') == '显示') { ?><a href="<?php echo stripslashes(get_option('tang_csdn_url')); ?>" target="_blank" rel="nofollow" title="CSDN"><i class="fa fa-star" aria-hidden="true"></i></a><?php } ?>
				
        <?php if (get_option('tang_facebook') == '显示') { ?><a href="<?php echo stripslashes(get_option('tang_facebook_url')); ?>" target="_blank" rel="nofollow" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a><?php } ?>
        <?php if (get_option('tang_github') == '显示') { ?><a href="<?php echo stripslashes(get_option('tang_github_url')); ?>" target="_blank" rel="nofollow" title="GitHub"><i class="fa fa-github" aria-hidden="true"></i></a><?php } ?>
    </div>
    <div class="nav">
        <?php wp_nav_menu (array(
            'theme_location'  => 'header-menu',
            'container'       => false,
            'menu'            => '',
            'menu_id'         => 'nav',
            'echo'            => true,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => '',)
        ); ?>
    </div>
    <?php if (get_option('tang_weixin') == '显示') { ?>
    <div class="weixin">
        <img src="<?php echo stripslashes(get_option('tang_weixin_img')); ?>" alt="微信公众号" width="50%">
        <p>微信公众号</p>
    </div>
    <?php } ?>
</header>

<?php  if((is_single() || is_page()) && !wpmd_is_phone() ) {
echo '<div  id="treecontent" style="width:25%; "><ul id="tree" class="ztree" style="width:15em !important; margin-left:12em !important; background:#f1f1f1 !important"></ul></div>';
}
?>
