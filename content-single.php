<?php
/*
 * Single post metadata and sharing
 *
 * @package DW Focus
 * @since DW Focus 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="entry-meta">
			<?php dw_focus_get_category(); ?>
			<br>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if( has_post_thumbnail() && ! has_post_format('video') && ! has_post_format('audio') && ! has_post_format('gallery') ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(''); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'dw_focus' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<!-- Turn this off, since apparently it's fake-->
	<!-- <?php dw_focus_post_actions(); ?> -->

	<!-- Manually put tags in -->	
	<div class="entry-action">

	<!-- Show author name/avatar -->
	<span class="author-name"><?php echo get_avatar(get_the_author_email(), '16'); ?>  <?php the_author(); ?></span>
	<br>
	<!-- Show date -->
	<?php
		$metadata = wp_get_attachment_metadata();
		printf( __( '<span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span>', 'dw_focus' ),
			esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ));
	?>


	<?php
		$tags_list = get_the_tag_list( '', __( ', ', 'dw_focus' ) );
		if ( $tags_list ) :
	?>
	    	<div class="tag-action">
		    	<span class="title-action"><?php _e('Tags','dw_focus') ?></span>
		        <span class="tags-links">
		            <?php printf( __( '%1$s', 'dw_focus' ), $tags_list ); ?>
		        </span>
	        </div>
	        <?php endif; // End if $tags_list ?>
	</div>

	<footer class="entry-meta entry-meta-bottom">
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author-info">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
			</div><!-- .author-avatar -->
			<div class="author-description">
                <h2><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h2>

                <p class="description"><?php the_author_meta( 'description' ); ?></p>
            </div><!-- .author-description -->
		</div><!-- .author-info -->
		<?php endif; ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
