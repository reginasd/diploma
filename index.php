<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!-- Получить все букеты из базы данных  -->
<?php $posts = getPublishedPosts(); ?>
<!DOCTYPE html>
<html>
<head>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Dione | Флористическая студия </title>
</head>
<body>
	<div class="container">
		<!-- // меню -->
	<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // баннер -->
	<?php include( ROOT_PATH . '/includes/banner.php') ?>
		<!-- Содержимое страницы -->
		<div class="content">
			<h2 class="content-title">Dione</h2>
			<hr>
<?php foreach ($posts as $post): ?>
	<div class="post" style="margin-left: 0px;">
		<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
		<?php if (isset($post['topic']['name'])): ?>
			<a 
				href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>"
				class="btn category">
				<?php echo $post['topic']['name'] ?>
			</a>
		<?php endif ?>

		<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
			<div class="post_info">
				<h3><?php echo $post['title'] ?></h3>
				<div class="info">
					<span><?php echo strftime("%B %d, %Y", strtotime($post["created_at"])); ?></span>
					<span class="read_more">Подробнее...</span>
				</div>
			</div>
		</a>
	</div>
<?php endforeach ?>
		</div>
		<!-- footer -->
	<?php include( ROOT_PATH . '/includes/footer.php') ?>