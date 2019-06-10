<?php get_header(); ?>

<div id="main">




 

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
	
	
	echo '<a  style="color:#FFFFFF;margin-left: 5em;" onmouseover="this.style.cssText=color:#7f42c1;">';
	echo  "北京时间: ";
	date_default_timezone_set('PRC'); 
	echo  date("Y-m-d H:i:s");
	echo '</a>';
	
	echo "</div>";
}
}
?>
    <article class="col-md-8 col-md-offset-2 view clearfix ">
        <h1 class="view-title  markdown-body" style="border-bottom:1px dashed #5bc0eb;padding-bottom:10px;margin-bottom:30px;"><?php the_title(); ?></h1>
        <div class="view-content ">
<?php the_content(); ?>
        </div>
        <section id="comments">
            <?php comments_template(); ?>
        </section>
    </article>
<?php endwhile; else: ?>
<?php endif; ?>
</div>

<?php get_footer(); ?>
