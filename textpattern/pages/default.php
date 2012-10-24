<txp:php>echo parse(file_get_contents(txpath.'/forms/_htmlstart.php'));</txp:php>
<body class="<txp:section /><txp:if_article_list> list_page<txp:else/> entry_page</txp:if_article_list>">
<txp:php>echo parse(file_get_contents(txpath.'/forms/_header.php'));</txp:php>
	<div id="container">
	<section id="main" role="main" class="group">
			<txp:if_search>
					<txp:article  pgonly="1" limit="15" />
				<txp:if_search_results>
					<p>These articles match your search request: </p>
					<txp:article limit="15" searchform="search_results" />
						<txp:else />
					<p>Sorry, we were not able to find a page matching your search request <strong><txp:search_term /></strong>.</p>
				</txp:if_search_results>
				<txp:else />

				<!-- Homepage Articles -->
				<txp:if_article_list>
					<txp:article limit="20" wraptag="" break="" sort="Posted desc">
						<article class="group <txp:section/>">
							<txp:if_article_image>
								<a href="<txp:permlink/>" title="<txp:title />" class="site_thumb" rel="ajax">
									<txp:upm_article_image form="img-siteThumb"/>
								</a>
							</txp:if_article_image>
							<div<txp:if_article_image> class="has_img"</txp:if_article_image>>
								<h3><a href="<txp:permlink/>" title="<txp:title/>" rel="ajax"><txp:title/></a> <txp:section class="cat_link" title="1" link="1" /></h3>
								<txp:rss_auto_excerpt length="216" showlinkwithexcerpt="0" />
							</div>
						</article>
					</txp:article>
					<div id="older_newer">
						<a href="<txp:older/>" class="older">&laquo; <txp:text item="older" /></a>
					</div>
				<txp:else/>
					<txp:article><!-- Individual Articles -->
						<div id="level_1">
						<article id="article" class="group <txp:section/>">
							<h1 class="text_centre mb_0">
								<txp:if_article_section name="gallery">
									<a href="<txp:custom_field name="Gallery Site Homepage" />" title="<txp:title/>"><txp:title/></a>
								</txp:if_article_section>
								<txp:if_article_section name="tutorials,plugins,screencasts">
									<a href="<txp:custom_field name="URL" />" title="<txp:title/>"><txp:title/></a>
								</txp:if_article_section>
								<txp:if_article_section name="blog">
									<txp:title/>
								</txp:if_article_section>
							</h1>
							<txp:if_article_section name="tutorials,plugins,screencasts,blog,gallery">
								<p class="text_centre">Filed under:
									<txp:if_article_section name="gallery">
										<txp:rss_uc_filedunder section="gallery" listwraptag="" class="categories" break=", " linktosection="gallery"/>
									</txp:if_article_section>
									<txp:if_article_section name="tutorials">
										<txp:rss_uc_filedunder section="tutorials" listwraptag="" class="categories" break=", " linktosection="tutorials"/>
									</txp:if_article_section>
									<txp:if_article_section name="plugins">
										<txp:rss_uc_filedunder section="plugins" listwraptag="" class="categories" break=", " linktosection="plugins"/>
									</txp:if_article_section>
									<txp:if_article_section name="screencasts">
										<txp:rss_uc_filedunder section="screencasts" listwraptag="" class="categories" break=", " linktosection="screencasts"/>
									</txp:if_article_section>
								</p>
							</txp:if_article_section>
							<div class="col lrg">
								<txp:if_article_image>
									<a href="<txp:custom_field name="Gallery Site Homepage" />" title="<txp:title />" class="lrg_img">
										<txp:upm_article_image form="img-siteLrg"/>
									</a>
								</txp:if_article_image>
								<txp:if_article_section name="tutorials,blog,plugins,screencasts">
									<txp:body/>
								</txp:if_article_section>
							</div><!-- /.col.lrg -->
							<div class="col sm">
								<txp:if_article_section name="gallery">
									<!-- GALLERY -->
									<txp:body/>
									<txp:if_custom_field name="Gallery Site Homepage">
										<a href="<txp:custom_field name="Gallery Site Homepage" />" title="Visit this website" class="visit_link">Visit this website</a>
										<p>Submitted on <txp:posted format="%b %d, %Y" /><txp:if_custom_field name="Submitted by"> by <txp:custom_field name="Submitted by" /><txp:else /> by <txp:author/></txp:if_custom_field></p>
									</txp:if_custom_field>
								</txp:if_article_section>

								<txp:if_article_section name="tutorials,blog,plugins,screencasts">
									<!-- tutorials,blog,plugins,screencasts -->
									<txp:if_custom_field name="URL">
										<a href="<txp:custom_field name="URL" /><txp:if_custom_field name="Code Canyon Link" value="yes">?ref=mrmartineau</txp:if_custom_field>" class="visit_link">
											<txp:if_article_section name="tutorials">Read Tutorial</txp:if_article_section>
											<txp:if_article_section name="screencasts">Watch Screencast</txp:if_article_section>
											<txp:if_article_section name="plugins">Visit Plugin</txp:if_article_section> Page
										</a>
									</txp:if_custom_field>
									<txp:if_custom_field name="Demo URL">
										<a href="<txp:custom_field name="Demo URL" /><txp:if_custom_field name="Code Canyon Link" value="yes">?ref=mrmartineau</txp:if_custom_field>" class="visit_link">View Demo</a>
									</txp:if_custom_field>
									<txp:if_custom_field name="Developer name">
										<p>Developed by <a href="<txp:custom_field name="Developer URL" /><txp:if_custom_field name="Code Canyon Link" value="yes">?ref=mrmartineau</txp:if_custom_field>" title="<txp:custom_field name="Developer name" />">
											<txp:custom_field name="Developer name" />
									</a></p></txp:if_custom_field>
									<txp:if_article_section name="tutorials,plugins,screencasts">
										<p id="related_item">Related <txp:section/>:<br />
											<txp:if_article_section name="tutorials">
												<txp:rss_uc_related section="tutorials" limit="5" form="related" />
											</txp:if_article_section>
											<txp:if_article_section name="plugins">
												<txp:rss_uc_related section="plugins" limit="5" form="related" />
											</txp:if_article_section>
											<txp:if_article_section name="screencasts">
												<txp:rss_uc_related section="screencasts" limit="5" form="related" />
											</txp:if_article_section>
										</p>
									</txp:if_article_section>
								</txp:if_article_section>
								<ul id="neighbours" class="navi horiz">
									<txp:jmd_neighbor type="prev"/>
									<txp:jmd_neighbor type="next"/>
								</ul><!-- /surrounders -->
								<ul id="item_social" class="floated">
									<li>
										<a href="https://twitter.com/share" class="twitter-share-button" data-url="<txp:permlink/>" data-count="vertical" data-via="jQueryStyle" data-related="MrMartineau:Zander Martineau">Tweet</a>
									</li>
									<li>
										<div id="fb-root"></div>
										<script>(function(d, s, id) {
											var js, fjs = d.getElementsByTagName(s)[0];
											if (d.getElementById(id)) {return;}
											js          = d.createElement(s); js.id = id;
											js.src      = "//connect.facebook.net/en_US/all.js#xfbml=1";
											fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));</script>
										<div class="fb-like" data-href="<txp:permlink/>" data-send="false" data-layout="box_count" data-width="55" data-show-faces="false" data-font="lucida grande"></div>
									</li>
									<li>
										<div class="g-plusone" data-size="tall" data-href="<txp:permlink/>"></div>
									</li>
									<li>
										<script src="http://www.stumbleupon.com/hostedbadge.php?s=5&r=<txp:permlink/>"></script>
									</li>
								</ul><!-- /item_social -->
							</div><!-- /.col.sm -->
							<div id="disqus_thread"></div>
							<script type="text/javascript">
								/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
								var disqus_shortname = 'jquerystyle',
									disqus_url = '<txp:permlink />',
									disqus_identifier = '<txp:title/>';
								/* * * DON'T EDIT BELOW THIS LINE * * */
								(function() {
									var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
									dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
									(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
								})();
							</script>
							<txp:section class="cat_link" title="1" link="1" />
						</article>
						</div><!-- /level_1 -->
					</txp:article>
				</txp:if_article_list>
			</txp:if_search>
	</section><!-- close #main_content -->
	</div><!-- /inner -->
<txp:php>echo parse(file_get_contents(txpath.'/forms/_htmlend.php'));</txp:php>