<header class="main">
	<h1>Рэгістрацыя або аўтарызацыя</h1>
</header>

<hr class="major" />

<div class="row 200%">
	<div class="6u 12u$(medium)">
		<h3>Аўтарызацыя</h3>
		<? if ($data['errors']['login']) { ?>
		<h3 style="color: red"><?=$data['errors']['login'] ?></h3>
		<? } ?>
		<form method="post" action="/login.php">
			<input type="hidden" name="action" value="login">
			<div class="row uniform">
				<div class="6u 12u$(xsmall)">
					<input type="text" name="login" id="demo-name" value="<?=$request->login?>" placeholder="Лагін" />
				</div>
				<div class="6u$ 12u$(xsmall)">
					<input type="password" name="password" id="demo-email" value="" placeholder="Пароль" />
				</div>
				<div class="12u$">
					<ul class="actions">
						<li><input type="submit" value="Увайсці" class="spe cial" /></li>
						<li><input type="reset" value="Скід" /></li>
					</ul>
				</div>
			</div>
		</form>
	</div>

	<div class="6u 12u$(medium)">
		<h3>Рэгістрацыя</h3>

		<? if ($data['errors']['register_message']) { ?>
		<h3 style="color: red"><?=$data['errors']['register_message'] ?></h3>

		<? foreach ($data['errors']['register'] as $error) { ?>
		<h4 style="color: red"><?=$error ?></h4>
		<? } 
	}
	?>

	<form method="post" action="/login.php">
		<input type="hidden" name="action" value="register">
		<div class="row uniform">
			<div class="6u 12u$(xsmall)">
				<input type="text" name="login" id="demo-name" value="<?=$request->login?>" placeholder="Лагін" />
			</div>
			<div class="6u 12u$(xsmall)">
				<input type="text" name="name" id="demo-name" value="<?=$request->name?>" placeholder="Імя" />
			</div>
			<div class="6u 12u$(xsmall)">
				<input type="password" name="password" id="demo-password" value="" placeholder="Пароль" />
			</div>
			<div class="6u 12u$(xsmall)">
				<input type="password" name="repeat" id="demo-repeat" value="" placeholder="Паўтарыце пароль" />
			</div>
			<div class="12u$">
				<input type="email" name="email" id="demo-email" value="<?=$request->email?>" placeholder="Email" />
			</div>
			<div class="6u$ 12u$(small)">
				<input type="checkbox" id="demo-human" name="human" checked>
				<label for="demo-human">Я чалавек</label>
			</div>
			<div class="12u$">
				<ul class="actions">
					<li><input type="submit" value="Рэгістрацыя" class="special" /></li>
					<li><input type="reset" value="Скід" /></li>
				</ul>
			</div>
		</div>
	</form>
</div>

</div>