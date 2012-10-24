<header id="header" role="banner">
	<a href="<txp:site_url />" id="logo" title="jQuery Style"><img src="/-/img/logo.png" alt="jQuery Style"></a>
	<nav role="navigation">
		<ul id="nav" class="navi centred">
<txp:if_article_list>
		<li><a href="#" class="filter active" data-filter="*">Show all</a></li><!--
		--><li><a href="#" class="filter" data-filter=".gallery">Gallery</a></li><!--
		--><li><a href="#" class="filter" data-filter=".plugins">Plugins</a></li><!--
		--><li><a href="#" class="filter" data-filter=".tutorials">Tutorials</a></li><!--
		--><li><a href="#" class="filter" data-filter=".blog">Blog</a></li><txp:else/><!--
		--><li><a href="<txp:site_url />" title="Back">Back</a></li></txp:if_article_list><!--
		 --><li><form id="live_search" method="get" action="<txp:site_url />">
				<input type="search" name="q" size="19" />
			</form></li>
		</ul>
	</nav>
</header>