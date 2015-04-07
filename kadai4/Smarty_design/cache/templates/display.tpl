	<h2>投稿一覧（{php} echo $GLOBALS['data_count'];{/php}件）</h2>
	<ul>
		{php} if ($GLOBALS['data_count']> 0 ):{/php}
			{php}while ($data = mysql_fetch_array($GLOBALS['queryset'])):{/php}
				{php}if ($data[5] == "画像"):{/php}
				<li>{php}echo "投稿番号：",h($data[0]);{/php}{php}echo "ユーザー：",h($data[1]);{/php} {php}echo "コメント：",h($data[2]);{/php}- {php}echo h($data[3]);{/php}<br/>{php}echo "<img src = $data[6] alt=\"表示できません。\">";{/php}</li>
				{php}elseif ($data[5] == "動画"):{/php}
					<li>{php}echo "投稿番号：",h($data[0]);{/php} {php}echo "ユーザー：",h($data[1]);{/php} {php}echo "コメント：",h($data[2]);{/php} - {php}echo h($data[3]);{/php}<br/>{php}echo "<video src = $data[6]></video>";{/php}</li>
					{php}else:{/php}
					<li>{php}echo "投稿番号：",h($data[0]);{/php} {php}echo "ユーザー：",h($data[1]);{/php} {php}echo "コメント：",h($data[2]);{/php} - {php}echo h($data[3]);{/php}</li>
				{php}endif;{/php}
			{php}endwhile;{/php}
		{php}else:{/php}
		<li>まだ投稿はありません。</li>
		{php}endif;{/php}
	</ul>