
<?php
/**
 * The template for displaying posts in the Standard post format
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-main-content">
        <?php if ( is_search() || !is_single()) : // Only display Excerpts for Search and not single pages ?>
        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <div class="entry-thumbnail">
            <div class="entry-content-inner">
                <?php
                the_post_thumbnail('tmpmela-blog-posts-list');
                $postImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
                ?>
                <?php
                if(!empty($postImage)): ?>
                   <div class="block_hover">
                    <div class="links">
                        <a href="<?php echo esc_url($postImage); ?>" title="<?php esc_attr_e( 'Click to view Full Image', 'firezy' );?>" data-lightbox="example-set" class="icon mustang-gallery"><i class="fa fa-plus"></i></a> <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php esc_attr_e( 'Click to view Read More', 'firezy' );?>" class="icon readmore"><i class="fa fa-link"></i></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<div class="post-info <?php if(empty($postImage)): ?> non <?php endif; ?>">
    <a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"></a>
    <?php
    if( $post->post_title == '' ) :
        $entry_meta_class = "empty-entry-header";
    else :
        $entry_meta_class = "";
    endif; ?>
	
 <div class="post-info-inner">
     <div class="entry-header <?php echo esc_attr($entry_meta_class); ?>">
        <div class="entry-meta">
           <?php tmpmela_post_entry_date(); ?>
           <?php tmpmela_comments_link(); ?>	        
       </div>
       <h1 class="entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title_attribute(); ?></a></h1>
   </div><!-- .entry-header -->
<?php endif; ?>
<div class="entry-content-other">
    <?php if ( is_search() || !is_single()) : // Only display Excerpts for Search and not single pages ?>
    <div class="entry-summary">
        <div class="excerpt"><?php echo tmpmela_posts_short_description(); ?></div>
    </div><!-- .entry-summary -->
</div><!-- post-info -->
</div>
<?php else : ?>
    <?php
    if( $post->post_title == '' ) :
        $entry_meta_class = "empty-entry-header";
    else :
        $entry_meta_class = "";
    endif; ?>
       
        <div class="entry-content">
            <?php
            the_post_thumbnail('tmpmela-blog-posts-list');
            $postImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
            ?>
            <?php the_content( wp_kses( __('Read More <span class="meta-nav">&rarr;</span>', 'firezy' ),tmpmela_allowed_html())); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'firezy' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div><!-- .entry-content -->
		
		<div class="entry-meta">
            <?php tmpmela_author_link(); ?>
            <?php tmpmela_comments_link(); ?>
            <?php tmpmela_tags_links(); ?>
            <?php tmpmela_categories_links(); ?>
            <?php tmpmela_post_entry_date(); ?>
            <?php edit_post_link( esc_html__( 'Edit', 'firezy' ), '<div class="meta-inner"><span class="edit-link"><i class="fa fa-pencil"></i>', '</span></div>' ); ?>
        </div><!-- .entry-meta -->
    <?php endif; ?>
</div> <!-- entry-content-other -->
</div>
</article><!-- #post -->