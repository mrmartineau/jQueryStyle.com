<?php

if (!defined('txpinterface')) die('txpinterface is undefined.');

theme::based_on('classic');

class prometheus_theme extends classic_theme
{
	function html_head()
	{
		$js = <<<SF
			$(document).ready( function() {
				if ( $("#nav > li:eq(3)").hasClass('active') ) {
					$('body').addClass('extensions');
				}
				$("#nav > li:eq(0)").addClass("content-item");
				$("#nav > li:eq(1)").addClass("presentation-item");
				$("#nav > li:eq(2)").addClass("admin-item");
				$("#nav > li:eq(3)").addClass("extensions-item");
				$("#nav li").hover( function() { 
					$(this).addClass("sfhover");
				}, function() {
					$(this).removeClass("sfhover");
				});
				$('table#list tr:even').addClass('even');
				if ($("#nav > li:eq(3) ul li").length > 8){
					$("#nav > li:eq(3)").addClass("long-extensions-list");
				}
				if ($.browser.msie && $.browser.version.substr(0,1)<8) {
					$('#nav > li:eq(0) > a').css("background-image", "none").addClass('ie');
					$('#nav > li:eq(1) > a').css("background-image", "none").addClass('ie');
					$('#nav > li:eq(2) > a').css("background-image", "none").addClass('ie');
 					$('#nav > li:eq(3) > a').css("background-image", "none").addClass('ie');
				}
			});
SF;
		return parent::html_head().n.script_js($js).n;
	}

	function header()
	{
		global $txp_user,$siteurl,$sitename;
		
		$prefs = get_prefs();
		$site_link = href($prefs['sitename'], hu);
		
		
		echo "<div id=\"masthead\" class=\"clearfix\">";
		echo "<div id=\"site-name\">";
	    echo $site_link;
	    $out[] = '</div>   
	    <ul id="nav" class="clearfix">';	
		
		
		foreach ($this->menu as $tab)
		{
			$class = ($tab['active']) ? 'tabup active' : 'tabdown inactive';
			$out[] = "<li class='primary {$class}'><a class='first' href='?event={$tab['event']}'>{$tab['label']}</a>";
			if (!empty($tab['items']))
			{
				$out[] = '<ul>';
				foreach ($tab['items'] as $item)
				{
					$class = ($item['active']) ? 'tabup active' : 'tabdown2 inactive';
					$out[] = "<li class='secondary {$class}'><a class='second' href='?event={$item['event']}'>{$item['label']}</a></li>";
				}
				$out[] = '</ul>';

			}
			$out[] = '</li>';
		}
		$out[] = '<li id="view-site"><a href="'.hu.'" target="_blank">'.gTxt('tab_view_site').'</a></li>';
		if ($txp_user) $out[] = '<li id="logout"><a href="index.php?logout=1" onclick="return verify(\''.gTxt('are_you_sure').'\')">'.gTxt('logout').'</a></li>';
		$out[] = '</ul></div>';
		$out[] = "<div id=\"pageWrapper\">";
		$out[] = '<div id="messagepane">'.$this->announce($this->message).'</div>';
		return join(n, $out);
	}

	function footer()
	{
		return '</div>'.n.
			'<div id="end_page">'.n.
			'<a href="http://j.mp/aufgmS" id="mothership"><img src="theme/prometheus/carver.gif" width="60" height="48" border="0" alt="" /></a>'.n.
			graf('Textpattern &#183; '.txp_version).n.
			'<p id="themeBy"><a href="http://j.mp/9c0UO6">This is the Textpattern <span>&ldquo;Prometheus&rdquo;</span> admin theme designed by Zander Martineau</a></p>'.n.
			'<p>Theme version: 0.8</p>'.n.
			'<p>Icons by <a href="http://j.mp/94J9yE">Glyphish</a>, <a href="http://j.mp/cPgBw4">The Working Group</a> and <a href="http://j.mp/cZ42II">Pinvoke</a></p>'.n.
			'<h2 id="txpLinksTitle">Textpattern Resources</h2>'.n.
			'<ul id="txpLinks">'.n.
				'<li><a href="http://j.mp/c0yQuQ">Textpattern Support Forum</a></li>'.n.
				'<li><a href="http://j.mp/aufgmS">Textpattern.com</a></li>'.n.
				'<li><a href="http://j.mp/99Kc9v">Textpattern Reference</a></li>'.n.
				'<li><a href="http://j.mp/aqHUPN">Textpattern Plugins</a></li>'.n.
				'<li><a href="http://j.mp/d9gOc5">TXP Tips</a></li>'.n.
				'<li><a href="http://j.mp/9lo1fu">Textgarden</a></li>'.n.
				'<li><a href="http://j.mp/cjgZ1w">Textile Reference Manual</a></li>'.n.
				'<li><a href="http://j.mp/bJCyCv">We Love TXP</a></li>'.n.
				'<li><a href="http://j.mp/cVQxja">TXP Planet</a></li>'.n.
			'</ul><!-- / #nav  -->'.n.
			'</div>';
	}

	function manifest()
	{
		global $prefs;
		return array(
			'author' 		=> 'Zander Martineau',
			'author_uri' 	=> 'http://martineau.tv/',
			'version' 		=> '0.9',
			'description' 	=> 'Prometheus Admin Theme',
			'help' 			=> 'http://textpattern.com/admin-theme-help/',
		);
	}
}
?>
