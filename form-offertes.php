<?php
/**
 * Template Name: formMaker
 * 
 * Initialize the form automation and response.
 */

require_once get_stylesheet_directory() . "/formMaker/includes/initialize_return.php";

/**
 * Get the WordPress header
 */
get_header();

?>
      <section id="primary" class="content-area back-white">
        <main id="main" class="site-main">
<?php 

/** 
 * Generate the WordPress Loop
 */
while ( have_posts() ) {
  the_post();

?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 

  if ( ! apply_filters( 'twentynineteen_can_show_thumbnail', ! post_password_required() && ! is_attachment() ) ) {

?>
            <header class="entry-header">
<?php 

    get_template_part( 'template-parts/header/entry', 'header' );

?>
            </header>
<?php

  }

?>
	        <div class="entry-content">
<?php

 	the_content();

/**
 * Start formMaker form content
 * First, create the formMaker form container. Needed for aligning the form to the theme content width.
 */

?>
           <div id="form-container" class="alignnone">
<?php

  require_once QUOTES_DIR . "includes/form_construct.php";

  require_once QUOTES_DIR . "includes/thank_you_construct.php";

  require_once QUOTES_DIR . "includes/price_buildup.php";


  // Extra information after form submit, below the 'thank you'-content and quote details
  if($form->form_sent_ok()) {

    require_once QUOTES_DIR . "includes/epilogue.php";

  }

?>
           </div><!-- #form-container -->
<?php

		wp_link_pages(
	 		array(
	  			'before' => '<div class="page-links">' . __( 'Pages:', 'twentynineteen' ),
		  		'after'  => '</div>',
	 		)
		);

?>
  	     </div><!-- .entry-content -->
<?php

  if ( get_edit_post_link() ) {

?>
  		  <footer class="entry-footer">
<?php

    edit_post_link(
      sprintf(
       	wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __( 'Edit <span class="screen-reader-text">%s</span>', 'twentynineteen' ),
          array(
           	'span' => array(
            		'class' => array(),
           	),
          )
       	),
       	get_the_title()
      ),
      '<span class="edit-link">',
      '</span>'
    );

?>
  		  </footer><!-- .entry-footer -->
<?php

  }

?>
     </article><!-- #post-<?php the_ID(); ?> -->
<?php

  // If comments are open or we have at least one comment, load up the comment template.
  if ( comments_open() || get_comments_number() ) {
  	 comments_template();
  }

?>
  		</main><!-- #main -->
  	</section><!-- #primary -->
<?php

} // endwhile
get_footer();
