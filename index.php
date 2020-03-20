<?php

require_once __DIR__ . '/WebSight/utilities.php';

use function WebSight\{a,abbr,address,area,article,aside,audio,b,base,bb,bdo,blockquote,body,br,button,canvas,caption,cite,code,col,colgroup,command,datagrid,datalist,dd,del,details,dfn,dialog,div,dl_,dt,em,embed,fieldset,figure,footer,form,h1,h2,h3,h4,h5,h6,head,header_,hgroup,hr,html,i,iframe,img,input,ins,kbd,label,legend,li,link_,map,mark,menu,meta,meter,nav,noscript,object,ol,optgroup,option,output,p,param,pre,progress,q,rp,rt,ruby,samp,script,section,select,small,source,span,strong,style,sub,sup,table,tbody,td,textarea,tfoot,th,thead,time_,title,tr,ul,var_,video};
use function WebSight\{pbr,po,arrVal};

$MAIN_IMAGE = [
  'testimonials' => 'IMG_4843-2.jpg',
  'personal-chef' => 'IMG_4820.JPG',
  'contact' => 'Soup.jpg',
];

$BLOG_INFO_PARAMS = [
  'name',
  'description',
  'wpurl',
  'url',
  'admin_email',
  'charset',
  'version',
  'html_type',
  'language',
  'stylesheet_url',
  'stylesheet_directory',
  'template_url',
  'pingback_url',
  'atom_url',
  'rdf_url',
  'rss_url',
  'rss2_url',
  'comments_atom_url',
  'comments_rss2_url'
];

foreach ($BLOG_INFO_PARAMS as $p) {
  $blog_info[$p] = get_bloginfo( $p );
}

define( 'IMG_DIR', $blog_info['template_url'] . '/img' );

//get_header();

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); // required ?>
</head>

<body <?php body_class(); ?>>
<?php
//wp_body_open();
?>
<!--
<div id="page" class="site">
-->

<?php wp_meta(); // required? ?>

<!--
		<header>
      HEADER
      <br>
      <?php bloginfo( 'name' ); ?>

		</header>
-->

<!--
<div id="content" class="site-content">
-->
<?php
print getEssNavBar( $blog_info['url'] );

// end of header
?>


<!--
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
-->

    <?php
    //wp_nav_menu( [] );

    if (is_front_page()) {
      $splashImage = IMG_DIR . "/Splash.jpg";

      print
        div( "class='splash' style='background-image: url(\"$splashImage\"); '",
          div( 'class="text"',
            h1( '', $blog_info['name'] )
            . h2( '', $blog_info['description'] )
          )
        )
      ;
    } else {
      if (have_posts()) {
        while (have_posts()) {
          the_post(); // without this it keeps looping

          //$content = get_the_content();
          ob_start();
          the_content();
          $content = ob_get_clean();

          print
            div( 'class="container text-center"',
              h1( '', get_the_title() )
            )
          ;

          if (
            $pagename == 'testimonials' or
            $pagename == 'personal-chef' or
            $pagename == 'contact'
          ) {
            $image = arrVal( $MAIN_IMAGE, $pagename );

            print
              div( 'class="container"',
                div( 'class="row homeRow"',
                  div( "class='col-sm-6'",
                    $content
                  )
                  . div( "class='col-sm-6'",
                    img( "class='img-responsive center-block' src='" . IMG_DIR . "/$image'" )
                  )
                )
              )
            ;
          } elseif (
            $pagename == 'catering'
          ) {
            print
              div( 'class="container"',
                div( 'class="row homeRow"',
                  div( "class='col-sm-10 col-sm-offset-1'",
                    $content
                  )
                )
              )
            ;
          } else {
            the_content();  // required for plugins to work
          }
        }
      }
    }

?>

<!--
		</main>
	</section>
-->


<?php
//get_footer();
?>

<!--
</div>--><!-- #content -->

<!--
	<footer class="site-footer">
    FOOTER
	</footer>
-->

<!--
</div>--><!-- #page -->

<?php
wp_footer(); // required
?>

</body>
</html>
<?php
// end footer
?>
