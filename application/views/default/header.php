<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <!--  Version: Multiflex-3 Update-2 / Layout-4             -->
    <!--  Date:    November 29, 2006                           -->
    <!--  Author:  G. Wolfgang                                 -->
    <!--  License: Fully open source without restrictions.     -->
    <!--           Please keep footer credits with a link to   -->
    <!--           G. Wolfgang (www.1-2-3-4.info). Thank you!  -->

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="3600" />
        <meta name="revisit-after" content="2 days" />
        <meta name="robots" content="index,follow" />
        <meta name="publisher" content="Your publisher infos here ..." />
        <meta name="copyright" content="Your copyright infos here ..." />
        <meta name="author" content="Design: G. Wolfgang www.1-2-3-4.info / Author: www.definslab.com" />

        <meta name="distribution" content="global" />
        <meta name="description" content="Your page description here ..." />
        <meta name="keywords" content="Your keywords, keywords, keywords, here ..." />

        <?php
            echo $this->page->get('css',true);
            echo $this->page->get('css');
            echo $this->page->get('js', true);
            echo $this->page->get('js');

            echo "<title>" . $this->page->title . "</title>";
        ?>

<!--        <link rel="icon" type="image/x-icon" href="./img/favicon.ico" />-->

    </head>

    <!-- Global IE fix to avoid layout crash when single word size wider than column width -->
    <!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->

    <body>
        <!-- Main Page Container -->
        <div class="page-container">

            <!-- For alternative headers START PASTE here -->


            <!-- A. HEADER -->
            <div class="header">

                <!-- A.1 HEADER TOP -->
                <div class="header-top">

                    <!-- Sitelogo and sitename -->
                    <a class="sitelogo" href="#" title="Go to Start page"></a>
                    <div class="sitename">
                        <h1><a href="index.html" title="Go to Start page">Academic Network</a></h1>

                        <h2>An academic social network</h2>
                    </div>

                    <!-- Navigation Level 0 -->
                    <div class="nav0">
                        <ul>
                            <li><a href="#" title="Pagina home in Italiano"><?php echo $this->page->img('img/flag_italy.gif'); ?></a></li>
                            <li><a href="#" title="Homepage auf Deutsch"><?php echo $this->page->img('img/flag_germany.gif'); ?></a></li>
                            <li><a href="#" title="Hemsidan p&aring; svenska"><?php echo $this->page->img('img/flag_sweden.gif'); ?></a></li>

                        </ul>
                    </div>

                    <!-- Navigation Level 1 -->
                    <div class="nav1">
                        <ul>
                            <li><a href="#" title="Go to Start page">Home</a></li>
                            <li><a href="#" title="Get to know who we are">About</a></li>

                            <li><a href="#" title="Get in touch with us">Contact</a></li>
                            <li><a href="#" title="Get an overview of website">Sitemap</a></li>
                            <li><a href="#" title="Get an overview of website">Register</a></li>
                        </ul>
                    </div>
                </div>

                <!-- A.2 HEADER BOTTOM -->

                <div class="header-bottom">

                    <!-- Navigation Level 2 (Drop-down menus) -->
                    <div class="nav2">

                        <!-- Navigation item -->
                        <ul>
                            <li><a href="index.html">Home</a></li>
                        </ul>

                        <!-- Navigation item -->
                        <ul>
                            <li><a href="#">Page Layouts<!--[if IE 7]><!--></a><!--<![endif]-->
                                <!--[if lte IE 6]><table><tr><td><![endif]-->
                                <ul>
                                    <li><a href="layout1.html">Layout-1 (1-col)</a></li>
                                    <li><a href="layout2.html">Layout-2 (2-col)</a></li>

                                    <li><a href="layout3.html">Layout-3 (2-col)</a></li>
                                    <li><a href="layout4.html">Layout-4 (3-col)</a></li>
                                    <li><a href="layout5.html">Layout-5 (3-col)</a></li>
                                </ul>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                        </ul>

                        <!-- Navigation item -->
                        <ul>
                            <li><a href="#">Header Layouts<!--[if IE 7]><!--></a><!--<![endif]-->
                                <!--[if lte IE 6]><table><tr><td><![endif]-->
                                <ul>
                                    <li><a href="header1.html">Header-1 (T+M+B)</a></li>
                                    <li><a href="header2.html">Header-2 (T+M)</a></li>

                                    <li><a href="header3.html">Header-3 (T+B)</a></li>
                                    <li><a href="header4.html">Header-4 (M+B)</a></li>
                                    <li><a href="header5.html">Header-5 (T)</a></li>
                                    <li><a href="header6.html">Header-6 (M)</a></li>
                                    <li><a href="header7.html">Header-7 (B)</a></li>
                                </ul>

                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                        </ul>
                        <ul>
                            <li><a href="index.html">Communities</a></li>
                        </ul>
                        <ul>
                            <li><a href="index.html">Institutes</a></li>

                        </ul>


                    </div>
                </div>

                <!-- A.3 HEADER BREADCRUMBS -->

                <!-- Breadcrumbs -->
                <div class="header-breadcrumbs">
                    <ul>

                        <li><a href="#">Home</a></li>
                        <li><a href="#">Webdesign</a></li>
                        <li><a href="#">Templates</a></li>
                        <li>Multiflex-3</li>
                    </ul>

                    <!-- Search form -->

                    <div class="searchform">
                        <form action="index.html" method="get">
                            <fieldset>
                                <input name="field" class="field"  value=" Search..." />
                                <input type="submit" name="button" class="button" value="GO!" />
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>


            <!-- For alternative headers END PASTE here -->

            <!-- B. MAIN -->
            <div class="main">