<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>

<p class="nocomments"><?php _e('Password protected.', 'authoritypro'); ?></p>
<?php
	return;
}
?>
<!-- You can start editing here. -->

<div class="comments-box">

	<a name="comments" id="comments"></a>

	<?php if ( have_comments() ) : ?>

		<h3><?php comments_number(__('No Responses', 'themejunkie'), __('One Response', 'themejunkie'), __('% Responses', 'themejunkie') );?> <?php _e('to', 'themejunkie') ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
		<?php wp_list_comments('avatar_size=48'); ?>
	</ol>
	
	<div class="navigation">
		<div class="left"><?php previous_comments_link() ?></div>
		<div class="right"><?php next_comments_link() ?></div>
		<div class="clear"></div>
	</div> <!--end .pagination-->

<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>

<!-- If comments are closed. -->
<?php endif; ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

	<h3><?php _e('Leave a Reply', 'themejunkie'); ?></h3>
	
	<div class="cancel-comment-reply"> 
		<small><?php cancel_comment_reply_link(); ?></small>
	</div> <!--end .cancel-comment-reply-->
	
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	
		<p><?php _e('You must be', 'themejunkie') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('Logged in', 'themejunkie') ?></a> <?php _e('to post comment', 'themejunkie') ?>.</p>
		
	<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
  			<?php if ( $user_ID ) : ?>
  			
  			<p><?php _e('Logged as', 'themejunkie') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'themejunkie') ?> &raquo;</a></p>
  			
			<?php else : ?>

			<p>
				<input type="text" name="author" class="txt" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				<label for="author"><?php _e('Name', 'themejunkie') ?> <?php if ($req) ?> (<?php _e('Required', 'themejunkie'); ?>) <?php ; ?></label>
			</p>

			<p>
				<input type="text" name="email" class="txt" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				<label for="email"><?php _e('Mail (will not be published)', 'themejunkie') ?> <?php if ($req) ?> (<?php _e('Required', 'themejunkie'); ?>) <?php ; ?></label>
			</p>

			<p>
				<input type="text" name="url" class="txt" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				<label for="url"><?php _e('Website', 'themejunkie') ?></label>
			</p>

			<?php endif; // End if logged in ?>

	<!--<p><strong>XHTML:</strong> <?php _e('You can use these tags', 'themejunkie'); ?>: <?php echo allowed_tags(); ?></p>-->

			<p><textarea name="comment" id="comment" rows="10" cols="50" tabindex="4"></textarea></p>

			<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit Comment', 'themejunkie') ?>" />
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	
			<?php comment_id_fields(); ?>
	
			<?php do_action('comment_form', $post->ID); ?>
	
		</form> <!--end #commentform-->

<?php endif; // If registration required and not logged in ?>

</div> <!--end #respond-->

<?php endif; // if you delete this the sky will fall on your head ?>

</div> <!--end #comment-box-->
