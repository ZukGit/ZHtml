<?php get_header(); ?>

<div id="main">





<?php while ( have_posts() ) : the_post(); ?>

<?php
if((is_single() || is_page()) && !wpmd_is_phone() ) {
$str = get_the_permalink();
$arr = explode("/",$str);
$size = count($arr);
$pathArr =  array();
if( $size >=4 )
{
$pathSize = $size - 3;


for($x=0;$x<$pathSize;$x++)
{
  $item = "";
for($y=0;$y<$x+3;$y++)
{
 $item = $item.$arr[$y]."/";
}
$pathArr[$x]=$item;
}
//print("\npathArr:\n");
}

//print("\get_category_parents:\n");
//echo get_category_parents(get_the_category(), TRUE, ' &raquo; ');



//print("\n nameArr:\n");
$nameArr =  array();
if(is_single() ){
array_push($nameArr,get_the_title());
$this_category = get_the_category()[0]; // 取得当前分类 
//echo "1---".$this_category->category_parent;
//echo "1---".$this_category->category_parent;
while($this_category->category_parent ) // 若当前分类有上级分类时，循环 
{
//echo $this_category->category_parent;
//echo $this_category->cat_name;
array_push($nameArr,$this_category->cat_name);
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬） 
}
array_push($nameArr,$this_category->cat_name);
array_push($nameArr,"Home");
$nameArr = array_reverse($nameArr);

}
if(is_page() && count($pathArr)>0 ){
	array_push($nameArr,"Home");
	
	$curpage =  $post;
	//print($post.__toString());
	while($curpage->post_parent){
	$parent_title = get_the_title($curpage->post_parent);
	array_push($nameArr,$parent_title);
	$curpage =  get_post($curpage->post_parent) ;
	}

	array_push($nameArr,get_the_title());
}
//print_r ($pathArr);	
//print ("\n ================\n");	
//print_r ($nameArr);

if(count($pathArr) == count($nameArr)){
	echo "<div class='navdiv' style='margin-left:15em; background:#5cedcb !important'>";
	for($index=0; $index<count($pathArr); $index++){
		if($index == count($pathArr) -1){
			echo '<a href='.$pathArr[$index].' style="color:#FFFFFF" 
			 onmouseover="this.style.cssText=color:#7f42c1;">'.$nameArr[$index].'</a>';
		}
		else{
			echo '<a href='.$pathArr[$index].' style="color:#FFFFFF" 
			 onmouseover="this.style.cssText=color:#7f42c1;">'.$nameArr[$index].'</a> <span>→</span>';
		}
		
	}
	
	
	echo '<a  style="color:#FFFFFF;margin-left: 2.5em;" href="javascript:;" onclick="showNav()" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "显示导航 ";
	echo '</a>';
	
	echo '<a  style="color:#FFFFFF;margin-left: 2.5em;" href="javascript:;" onclick="hideNav()" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "隐藏导航 ";
	echo '</a>';
	
	echo '<a  style="color:#FFFFFF;margin-left: 2.5em;" href="javascript:;" onclick="hideLeft()" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "隐藏左侧 ";
	echo '</a>';
	
	
	echo '<a  style="color:#FFFFFF;margin-left: 2.5em;" href="javascript:;" onclick="showLeft()" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "显示左侧 ";
	echo '</a>';
	
	
	echo '<a  style="color:#FFFFFF;margin-left: 2.5em;" href="javascript:;" onclick="hideMain()" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "隐藏主菜单 ";
	echo '</a>';
	
	date_default_timezone_set('PRC'); 
	echo '<a  style="color:#FFFFFF;margin-left: 5em;" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "北京时间: ";
	echo  date("Y-m-d H:i:s");
	echo '</a>';
	
		echo "</div>";
}
}
?>
    <article class="col-md-8 col-md-offset-2 view clearfix ">
        <h1 class="view-title"><?php the_title(); ?></h1>
        <div class="view-meta">
            <span>作者: <?php the_author() ?></span>
            <span>分类: <?php the_category(',') ?></span>
            <span>发布时间: <?php the_time('Y-m-d H:i') ?></span>
            <span><?php edit_post_link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑'); ?></span>
        </div>
        <div class="view-content  markdown-body">
<?php the_content(); ?>
        </div>
        <section class="view-tag">
            <div class="pull-left"><i class="fa fa-tags"></i> <?php the_tags('',''); ?></div>
        </section>
        <?php if (get_option('tang_dashang') == '启用') { ?>
        <section class="support-author">
            <p><?php echo stripslashes(get_option('tang_dashang_info')); ?></p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-cny" aria-hidden="true"></i> 打赏支持</button>
        </section>
        <?php } ?>
        <section id="comments">
            <?php comments_template(); ?>
        </section>
    </article>
<?php endwhile; ?>
    <section class="col-md-8 col-md-offset-2 clearfix">
    <div class="read">
        <div class="read-head"> <i class="fa fa-book"></i> 更多阅读 </div>
        <div class="read-list row">
            <div class="col-md-6">
                <ul>
                    <?php tangstyle_get_most_viewed(); ?>
                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                <?php $rand_posts = get_posts('numberposts=10&orderby=rand');  foreach( $rand_posts as $post ) : ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="read">
        <div class="read-head"> <i class="fa fa-tags"></i> 标签云 </div>
        <div class="read-list">
            <?php wp_tag_cloud();?>
        </div>
    </div>
    </section>
</div>
<!--modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content single-dashang">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cny" aria-hidden="true"></i> 打赏支持</h4>
            </div>
            <div class="modal-body text-center">
                <p><img border="0" src="<?php echo stripslashes(get_option('tang_dashang_alipay')); ?>"><img border="0" src="<?php echo stripslashes(get_option('tang_dashang_wechat')); ?>"></p>
                <p>扫描二维码，输入您要打赏的金额</p>
            </div>
        </div>
    </div>
</div>
<!--modal-->

<?php get_footer(); ?>
