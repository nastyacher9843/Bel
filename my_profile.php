<?php 
include_once("header.php");

if ($my->id == 0) {
	header("Location: /");
}

$results = $mysqli->query("SELECT * FROM test_results WHERE user_id = " . $my->id);
$res = [];
while ($result = $results->fetch_object()) {
	$res[] = $result;
}
?>


<header class="main">
	<h1>Профіль <?=$my->name?></h1>
</header>

<h2 id="content">Пройдзенныя Вамі тэсты</h2>
<br><br>

<? foreach ($res as $result) { ?>
<hr>
<p><a href="/test.php?id=<?=$result->test_id?>">Тэст №<?=$result->test_id?></a>: <?=$tests[$result->test_id]->name?></p>
<p>Працэнт правільных адказаў: <?=$result->percent?>%</p>
<? } ?>

<hr class="major" />

</div>

</div>	


<?php

include_once("sidebar.php"); 
include_once("footer.php");
?>