<?php
$cryptinstall="./crypt/cryptographp.fct.php";
include $cryptinstall; 
define('INCLUDE_CHECK',true);
define( '_JEXEC', 1 );
include "def.php";
require 'functions.php';
require 'config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minecrfat Skin System</title>
<link rel="stylesheet" type="text/css" href="template/css/style.css" media="screen" />
<script type="text/javascript">
function swch(block_id) {
  if (document.getElementById('block'+block_id).style.display=='block') {
    document.getElementById('block'+block_id).style.display = 'none';
    document.getElementById('block'+block_id+'_swch').innerHTML = '[+]';
  } else {
    document.getElementById('block'+block_id).style.display = 'block';
    document.getElementById('block'+block_id+'_swch').innerHTML = '[-]';
  }
  return false;
}
</script>
</head>
<body>
<div id='wrapper'>
<div id='top'></div>
	<!-- Шапка сайта -->
	<div id='header'>
		<div class='spacer1px'></div>
		<!-- Логотип сайта -->
		<a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'] ?>" id="logo"></a>
	</div>
	<div id='container'>
		<div id='main'>
			<!-- Правая колонка сайта -->
			<div id='right'>
				<div class="column">
					<div class="bg-tl"></div>
					<div class="bg-tr"></div>
					<div class='clear'></div>
					<div class="bg-cl">
						<div class="content">
    <h2>Обратная связь</h2>
<?php
$err = null;
if($_POST['submit']=='Отправить')
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$msg = $_POST['msg'];

	$name = trim($name);
	$email = trim($email);
	$subject = trim($subject);
	$msg = trim($msg);

	if (empty($name) || empty($email) || empty($subject) || empty($msg))
	{
		$err = 'Не все поля заполнены.';
	}
	elseif (!validatemail($email))
	{
		$err = "E-mail введен не корректно.";
	}
	elseif (!chk_crypt($_POST['captcha']))
	{
		$err = "Каптча введена не верно!";
	}
	else
	{
		$fmsg     = "From : $name \r\nE-mail : $email \r\nSubject : $subject \r\n\n" . "Message : \r\n$msg";
		$fsubject = $psubject.$subject;
		mail($to, $fsubject, $fmsg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
		$info = "Спасибо <b>".$name."</b>, Ваше сообщение успешно отправлено! Вы будете перенаправлены на главную страницу через 5 секунд.";
		echo '<br /><p class="ok">'.$info.'<br /></p>';
		echo "<meta http-equiv='refresh'; content='5; url=index.php'> ";
	}
}
if(!empty($err))
{
echo '<br /><p class="err">'.$err.'<br /></p>';
}
?>
    <form action="feedback.php" method="post">
								<p><br />Имя:<br /><input type=text name=name class="field" /><br /></p>
								<p><br />E-mail:<br /><input type=text name=email class="field" /><br /></p>
								<p><br />Тема:<br /><input type=text name=subject class="field" /><br /></p>
								<p><br />Сообщение:<br /></p>
								<p><textarea class="textarea" name="msg" cols="20" rows="5" ></textarea></p>
								<p><br /><?php dsp_crypt(0,1); ?></p>
								<p><br />Введите каптчу:<br /><input  type=text name=captcha class="field" /><br /></p>
								<p><input type="submit" name="submit" value="Отправить" class="regbutton" /><br /></p>
								<p><input type="button" onclick="location.href='index.php'" value="На главную" class="regbutton" /><br /></p>
</form>



						</div>
					</div>
					<div class='clear'></div>
					<div class="bg-bl"></div>
					<div class="bg-br"></div>
					<div class="bg-bc"></div>
					<div class='clear'></div>
				</div>

			
				
			</div>
			<!-- Левая колонка сайта-->
			<div id='left'>
				<!-- Вывод текста из файла -->
				<?php
				paginate(); 
				?>
			</div>
		</div>
	</div>
	<div class='clear'></div>
	<div class='spacer64px'></div>
</div>
<div id='footer' align="center"><!-- Подвал сайта -->
<br />
Original code by z0z1ch. Edited by byxar.
</div>
</body>
</html>