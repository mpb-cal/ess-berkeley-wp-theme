<?php

require_once __DIR__ . '/WebSight/utilities.php';

use function WebSight\{a,abbr,address,area,article,aside,audio,b,base,bb,bdo,blockquote,body,br,button,canvas,caption,cite,code,col,colgroup,command,datagrid,datalist,dd,del,details,dfn,dialog,div,dl_,dt,em,embed,fieldset,figure,footer,form,h1,h2,h3,h4,h5,h6,head,header_,hgroup,hr,html,i,iframe,img,input,ins,kbd,label,legend,li,link_,map,mark,menu,meta,meter,nav,noscript,object,ol,optgroup,option,output,p,param,pre,progress,q,rp,rt,ruby,samp,script,section,select,small,source,span,strong,style,sub,sup,table,tbody,td,textarea,tfoot,th,thead,time_,title,tr,ul,var_,video};


define( 'CSS_NORMALIZE', "normalize.min" );
define( 'CSS_BOILERPLATE', "boilerplate-main" );
define( 'CSS_BS', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
define( 'CSS_ESS', 'essberkeley' );
define( 'JS_BOOTSTRAP', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' );

add_action( 'after_setup_theme', 'essberkeley_setup' );
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
show_admin_bar( false );


if (!function_exists( 'essberkeley_setup' ) ) {
  function essberkeley_setup() {
      register_nav_menus( array(
          'primary' => __( 'Primary Menu' ),
      ) );

      add_theme_support( 'title-tag' );
  }
}

function add_style( $css ) {
  wp_enqueue_style(
    $css,
    get_template_directory_uri() . "/css/$css.css"//,
    //array(),
    //'1',
    //'all'
  );
}

function add_theme_scripts() {
  add_style( CSS_NORMALIZE );
  add_style( CSS_BOILERPLATE );

  wp_enqueue_style(
    'bootstrap.min',
    CSS_BS//,
    //array(),
    //'1',
    //'all'
  );

  add_style( CSS_ESS );

  wp_enqueue_script( 'bootstrap.min', JS_BOOTSTRAP, ['jquery'] );
}


function getNavbarHeader( $collapseId, $contents )
{
  return
    div( 'class="navbar-header"',
      button( "type=button class='navbar-toggle collapsed' data-toggle='collapse' data-target='#$collapseId'",
        span( 'class="sr-only"', 'Toggle navigation' )
        . span( 'class="icon-bar"' )
        . span( 'class="icon-bar"' )
        . span( 'class="icon-bar"' )
      )
      . $contents
    )
  ;
}


function getNavBar( $header, $contents )
{
  $collapseId = 'navbar';

  return
    nav( 'class="navbar navbar-inverse navbar-fixed-top" role="navigation"',
      div( 'class="container"',
        getNavbarHeader( $collapseId, $header )
        . div( "id='$collapseId' class='navbar-collapse collapse'", $contents )
      )
    )
  ;
}


function getEssNavBar( $home_url )
{
  return
    getNavBar(
      a( "class='navbar-brand' href='$home_url'", 'ESS!' ),
      ul( 'class="nav navbar-nav navbar-right"',
        li( 'class=text-right', a( "href=contact", 'Contact' ) )
        . li( 'class="text-right dropdown"',
          a( "href='#' class='dropdown-toggle' data-toggle='dropdown'", 'Services' . span( 'class="caret"' ) )
          . ul( 'class="dropdown-menu"',
            li( 'class=text-right', a( "href='personal-chef'", 'Personal Chef' ) )
            . li( 'class=text-right', a( "href='catering'", 'Catering' ) )
            . li( 'class=text-right', a( "href='grazing-boards'", 'Grazing Boards' ) )
          )
        )
        . li( 'class=text-right', a( "href='gallery'", 'Gallery' ) )
        . li( 'class=text-right', a( "href='testimonials'", 'Testimonials' ) )
      )
    )
  ;
}


?>
