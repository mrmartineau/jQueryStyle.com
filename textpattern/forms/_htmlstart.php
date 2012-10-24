<!DOCTYPE html>
<!--[if IEMobile 7 ]>   <html class="no-js ie iem7" itemscope itemtype="http://schema.org/Blog">            <![endif]-->
<!--[if lt IE 7 ]>      <html class="no-js ie ie6" lang="en" itemscope itemtype="http://schema.org/Blog">   <![endif]-->
<!--[if IE 7 ]>         <html class="no-js ie ie7" lang="en" itemscope itemtype="http://schema.org/Blog">   <![endif]-->
<!--[if IE 8 ]>         <html class="no-js ie ie8" lang="en" itemscope itemtype="http://schema.org/Blog">   <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Blog"><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<title>
		<txp:if_section name="default,gallery"><txp:if_individual_article><txp:title /> - <txp:site_name /> Gallery Submission<txp:else /><txp:site_name/> <txp:section title="1"/> - <txp:site_slogan/></txp:if_individual_article></txp:if_section>
		<txp:if_section name="tutorials,plugins,screencasts"><txp:if_individual_article><txp:title /> - jQuery <txp:section title="1"/><txp:else /><txp:site_name/> <txp:section title="1"/> - Awesome jQuery <txp:section title="0"/> resource for you!</txp:if_individual_article></txp:if_section>
		<txp:if_section name="blog,advertise"><txp:if_individual_article><txp:title /> - <txp:site_name /><txp:else /><txp:site_name/> - <txp:section title="1"/></txp:if_individual_article></txp:if_section>
		<txp:if_section name="archives,tutarchives,plugarchives,screenarchives">The <txp:site_name/> <txp:section title="1"/> Archives</txp:if_section>
		<txp:if_section name="store">The <txp:site_name/> Store</txp:if_section>
		<txp:if_section name="news">jQuery News (RSS) Feed Aggregator</txp:if_section>
		<txp:if_section name="featured">The best of the best - jQuery Style's Featured Sites</txp:if_section>
	</title>
	<meta name="Description" content="jQuery Style is a gallery/showcase site for brilliantly designed websites that use jQuery in amazing and thought provoking ways. It is also a resource for all things jQuery." />
	<meta name="Keywords" content="jQuery Style, jQuery, javascript,jquery gallery,jquery showcase,what can be done with jquery,Zander Martineau" />
	<meta name="author" content="Zander Martineau">
	<meta itemprop="name" content="jQuery Style">
	<meta itemprop="description" content="jQuery Style is a gallery/showcase site for brilliantly designed websites that use jQuery in amazing and thought provoking ways. It is also a resource for all things jQuery.">
	<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1">

	<!-- !CSS -->
	<link rel="stylesheet" href="<txp:site_url/>-/css/jquerystyle.css?v=2">
	<link rel="stylesheet" href="<txp:site_url/>-/css/tools/nogrid.css?v=2">
	<link rel="stylesheet" href="<txp:site_url/>-/css/tools/forms.css?v=2">
	<!-- !Modernizr - All other JS at bottom -->
	<!--script src="<txp:site_url/>-/js/libs/modernizr.js"></script-->

	<!-- RSS -->
	<link rel="alternate" type="application/rss+xml" title="jQuery Style Feed - Everything (Gallery, Tutorials, Plugins, Screencasts, Blog)" href="http://feeds2.feedburner.com/jQueryStyleAll" /><link rel="alternate" type="application/rss+xml" title="jQuery Style Twitter Feed" href="http://feeds2.feedburner.com/JqueryStyleTwitter" />

	<!-- ICONS -->
	<link rel="icon" type="image/gif" href="<txp:site_url />favicon.gif" /><link rel="apple-touch-icon" href="<txp:site_url />apple-touch-icon.png" />

	<link rel="search" type="application/opensearchdescription+xml" title="jQuery Style Search" href="http://jquerystyle.com/opensearch.xml" />

	<meta http-equiv="cleartype" content="on">

	<txp:if_individual_article><link rel="canonical" href="<txp:permlink />" /><txp:else /><txp:if_section name=""><link rel="canonical" href="<txp:site_url />" /><txp:else/><link rel="canonical" href="<txp:site_url /><txp:section />" /></txp:if_section></txp:if_individual_article>
</head>