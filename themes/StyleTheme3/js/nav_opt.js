var showNav = function(){
$("header").show();
document.getElementById("header").style.display="block";
document.getElementById("tree").style.width="15em";
document.getElementById("tree").style.marginLeft="12em";
document.getElementById("main").style.marginLeft="12em";
document.getElementById("treecontent").style.display="block";
document.getElementById("footer").style.display="block";
};


var hideNav = function(){
$("header").hide();
document.getElementById("tree").style.width="27em";
document.getElementById("tree").style.marginLeft="0em";
};




var showLeft = function(){
$("header").show();
document.getElementById("header").style.display="block";
document.getElementById("main").style.marginLeft="12em";
document.getElementById("treecontent").style.display="block";
document.getElementById("footer").style.display="block";
document.getElementById("tree").style.width="15em";
document.getElementById("tree").style.marginLeft="12em";
};



var hideLeft = function(){
document.getElementById("header").style.display="none";
document.getElementById("main").style.marginLeft="-15em";
document.getElementById("treecontent").style.display="none";
document.getElementById("footer").style.display="none";
};



var hideMain = function(){
document.getElementById("header").style.display="none";
document.getElementById("tree").style.width="15em";
document.getElementById("tree").style.marginLeft="0em";
document.getElementById("main").style.marginLeft="0em";
document.getElementById("footer").style.display="none";
document.getElementById("treecontent").style.display="block";
};


// <div class="navdiv" style="margin-left:0em"   导航栏设置为离边距为0
// <article class="col-md-8 col-md-offset-2 view clearfix ">  设置离边距为0
// <div style="width:25%; ">   需要设置为width:25%  0
// <div style="width:25%; display:none ">
//  $("header").hide();
// <div id="mian"  .style.marginLeft="0em";
//  <section class="col-md-8 col-md-offset-2 clearfix">   .style.marginLeft="0em";
// <footer id="footer"> .style.marginLeft="0em";


