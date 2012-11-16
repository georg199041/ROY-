<?php
$months = array(
	1  => 'Января',
	2  => 'Февраля',
	3  => 'Марта',
	4  => 'Апреля',
	5  => 'Мая',
	6  => 'Июня',
	7  => 'Июля',
	8  => 'Августа',
	9  => 'Сентября',
	10 => 'Октабря',
	11 => 'Ноября',
	12 => 'Декабря',
);
?>
<div class="front-block-comments">
	<h2>Комментарии</h2>
	<?php foreach ($this->getComments() as $comment): ?>
	<div class="front-block-user-comments">
		<div class="front-block-user-comments__tab">
			<span class="front-block-user-comments__tab_before"></span>
			<span class="front-block-user-comments__tab_center">
				<span class="front-block-user-comments__tab_user-name"><?php echo $comment->getName(); ?></span>
				<span class="front-block-user-comments__tab_arrow">&larr;</span>
				<span class="front-block-user-comments__tab_user-data">
					<?php
						$ts = $comment->getCreatedTs();
						echo date('d', $ts) . ' ' . $months[(int) date('n', $ts)] . ' ' . date('Y, H:m:s', $ts);
					?>
				</span>
			</span>
			<span class="front-block-user-comments__tab_after"></span>
		</div>
		<div class="front-block-user-comments-text">
			<?php echo $comment->getComment(); ?>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="front-block-comment-add">
		<h3>Ваш комментарий</h3>
		<?php echo Core::getBlock('comments/index/add-comment'); ?>
		<form method="post" action="/comments/index/add">
			<input type="hidden" name="backto" />
			<div class="front-block-comment__input-box">
				<label>Ваше имя</label> <input type="text" />
			</div>
			<div class="front-block-comment__input-box">
				<label>Адрес электроной почты (не публикуется)</label> <input
					type="text" />
			</div>
			<div class="front-block-comment__input-box">
				<label>Текст сообщения</label>
				<textarea rows="" cols=""></textarea>
			</div>
			<button class="front-block-comment__button" type="submit" value="">
				<span>Отправить</span>
			</button>
			<span class="front-block-comment__required">Все поля обязательны к
				заполнению</span>
		</form>
	</div>
</div>
