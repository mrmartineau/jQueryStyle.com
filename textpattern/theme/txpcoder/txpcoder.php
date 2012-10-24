<?php

if (!defined('txpinterface')) die('txpinterface is undefined.');

theme::based_on('classic');

class txpcoder_theme extends classic_theme
{
	function html_head()
	{
		$js = <<<SF
			$(document).ready( function() {
				$("#nav li").hover( function() { 
					$(this).addClass("sfhover");
				}, function() {
					$(this).removeClass("sfhover");
				});
				
				$('#nav li.active')
					.next()
					.addClass('nextright');
				$('#nav li.active')
					.prev()
					.addClass('nextleft');
				$('table#list tr:even').addClass('even');
				if ($.browser.msie && $.browser.version.substr(0,1)<7) {
				  // search for selectors you want to add hover behavior to
					$('#nav > li:eq(0) > a').css("background-image", "url(../textpattern/theme/txpcoder/content.png)");
					$('#nav > li:eq(1) > a').css("background-image", "url(../textpattern/theme/txpcoder/presentation.png)");
					$('#nav > li:eq(2) > a').css("background-image", "url(../textpattern/theme/txpcoder/settings.png)");
 					$('#nav > li:eq(3) > a').css("background-image", "url(../textpattern/theme/txpcoder/extend.png)");
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
		
		
		echo "<div id=\"masthead\">";
		echo "<div id=\"site-name\">";
	    echo $site_link;
	    $out[] = '</div>   
	    <ul id="nav">';	
		
		
		foreach ($this->menu as $tab)
		{
			$class = ($tab['active']) ? 'tabup active' : 'tabdown inactive';
			$out[] = "<li class='primary {$class}'><a href='?event={$tab['event']}'>{$tab['label']}</a>";
			if (!empty($tab['items']))
			{
				$out[] = '<ul>';
				foreach ($tab['items'] as $item)
				{
					$class = ($item['active']) ? 'tabup active' : 'tabdown2 inactive';
					$out[] = "<li class='secondary {$class}'><a href='?event={$item['event']}'>{$item['label']}</a></li>";
				}
				$out[] = '</ul>';

			}
			$out[] = '</li>';
		}
		$out[] = '<li id="view-site" class="primary tabdown inactive"><a href="'.hu.'" target="_blank">'.gTxt('tab_view_site').'</a></li>';
		if ($txp_user) $out[] = '<li id="logout" class="primary tabdown inactive"><a href="index.php?logout=1" onclick="return verify(\''.gTxt('are_you_sure').'\')">'.gTxt('logout').'</a></li>';
		$out[] = '</ul></div>';
		$out[] = '<div id="messagepane">'.$this->announce($this->message).'</div>';
		return join(n, $out);
	}

	function footer()
	{
		return '<div id="end_page">'.n.
			'<a href="http://textpattern.com/" id="mothership"><img src="theme/classic/carver.gif" width="60" height="48" border="0" alt="" /></a>'.n.
			'<p>Admin theme designed by <a href="http://martineau.tv">Zander Martineau</a> from <a href="http://txpcoder.com/">&lt;txp:coder /></a></p>'.n.
			'<p>Icons by <a href="http://www.pinvoke.com/">Pinvoke</a></p>'.n.
			graf('Textpattern &#183; '.txp_version).n.'</div>';
	}

	function manifest()
	{
		global $prefs;
		return array(
			'author' 		=> 'Zander Martineau',
			'author_uri' 	=> 'http://martineau.tv/',
			'version' 		=> '1',
			'description' 	=> '<txp:coder /> Admin Theme',
			'help' 			=> 'http://textpattern.com/admin-theme-help',
		);
	}
}
?>
