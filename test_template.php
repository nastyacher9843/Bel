<header class="main">
	<h1>Пытанне №<?=$question->order?></h1>
</header>

<h2 id="content"><?=$question->text?></h2>
<p> У выпадку, калі хаця б адзін варыянт не верны - не залічваецца ўсё пытанне</p>

<hr class="major" />

<div class="row 200%">
	<form method="post" action="/test.php?id=<?=$request->id?>&question_id=<?=$request->question_id?>">
		<input type="hidden" name="form" value="yeees">
		<div class="row uniform">
			<? foreach ($question->answers as $answer) { ?>
			<div class="12u$">
				<input type="checkbox" id="demo-human<?=$answer->id?>" name="answer[<?=$answer->id?>]">
				<label for="demo-human<?=$answer->id?>"><?=$answer->text?></label>
			</div>
			<? } ?>
			<div class="12u$">
				<? if ($message) { ?>
				<h2 style="color: red"><?=$message?></h2>
				<? } ?>
				<ul class="actions">
					<li><input type="submit" value="Подтвердить" class="special" /></li>
					<li><input type="reset" value="Сброс" /></li>
				</ul>
			</div>
		</div>
	</form>
</div>

</div>