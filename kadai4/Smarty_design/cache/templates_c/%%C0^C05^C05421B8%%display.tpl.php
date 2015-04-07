<?php /* Smarty version 2.6.22, created on 2015-04-07 12:41:01
         compiled from display.tpl */ ?>
	<h2>投稿一覧（<?php  echo $GLOBALS['data_count']; ?>件）</h2>
	<ul>
		<?php  if ($GLOBALS['data_count']> 0 ): ?>
			<?php while ($data = mysql_fetch_array($GLOBALS['queryset'])): ?>
				<?php if ($data[5] == "画像"): ?>
				<li><?php echo "投稿番号：",h($data[0]); ?><?php echo "ユーザー：",h($data[1]); ?> <?php echo "コメント：",h($data[2]); ?>- <?php echo h($data[3]); ?><br/><?php echo "<img src = $data[6] alt=\"表示できません。\">"; ?></li>
				<?php elseif ($data[5] == "動画"): ?>
					<li><?php echo "投稿番号：",h($data[0]); ?> <?php echo "ユーザー：",h($data[1]); ?> <?php echo "コメント：",h($data[2]); ?> - <?php echo h($data[3]); ?><br/><?php echo "<video src = $data[6]></video>"; ?></li>
					<?php else: ?>
					<li><?php echo "投稿番号：",h($data[0]); ?> <?php echo "ユーザー：",h($data[1]); ?> <?php echo "コメント：",h($data[2]); ?> - <?php echo h($data[3]); ?></li>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php else: ?>
		<li>まだ投稿はありません。</li>
		<?php endif; ?>
	</ul>