<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Digg pagination style
 *
 * @preview  « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next »
 */
?>
<span class="pagination">
	<?php if ($previous_page): ?>
		<a href="<?php echo $page->url($previous_page) ?>">&nbsp;<?php echo __('Previous') ?></a>
	<?php else: ?>
		&nbsp;<span class="disabled_tnt_pagination"><?php echo __('Previous') ?></span>
	<?php endif ?>

	<?php if ($total_pages < 13): /* « Previous  1 2 3 4 5 6 7 8 9 10 11 12  Next » */ ?>

		<?php for ($i = 1; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span class="active_tnt_link"><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>

	<?php elseif ($current_page < 9): /* « Previous  1 2 3 4 5 6 7 8 9 10 … 25 26  Next » */ ?>

		<?php for ($i = 1; $i <= 10; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span class="active_tnt_link"><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>

		&hellip;
		<a href="<?php echo $page->url($total_pages - 1) ?>"><?php echo $total_pages - 1 ?></a>
		<a href="<?php echo $page->url($total_pages) ?>"><?php echo $total_pages ?></a>

	<?php elseif ($current_page > $total_pages - 8): /* « Previous  1 2 … 17 18 19 20 21 22 23 24 25 26  Next » */ ?>

		<a href="<?php echo $page->url(1) ?>">1</a>
		<a href="<?php echo $page->url(2) ?>">2</a>
		&hellip;

		<?php for ($i = $total_pages - 9; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span class="active_tnt_link"><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>

	<?php else: /* « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next » */ ?>

		<a href="<?php echo $page->url(1) ?>">1</a>
		<a href="<?php echo $page->url(2) ?>">2</a>
		&hellip;

		<?php for ($i = $current_page - 5; $i <= $current_page + 5; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span class="active_tnt_link"><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>

		&hellip;
		<a href="<?php echo $page->url($total_pages - 1) ?>"><?php echo $total_pages - 1 ?></a>
		<a href="<?php echo $page->url($total_pages) ?>"><?php echo $total_pages ?></a>

	<?php endif ?>

	<?php if ($next_page): ?>
		<a href="<?php echo $page->url($next_page) ?>"><?php echo __('Next') ?></a>
	<?php else: ?>
		<span class="disabled_tnt_pagination"><?php echo __('Next') ?></span>
	<?php endif ?>
</span>