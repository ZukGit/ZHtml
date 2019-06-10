
   $(window).load(function(){
    var css_conf = eval(markdown_panel_style);
    $('#readme').css(css_conf);
    
    var conf = eval(jquery_ztree_toc_opts);
	$('#tree').ztree_toc(conf); 
  });