<?php
	include_once("setdb.php");
	
	$goto = "content.php";
	if(!empty($_GET['do'])){
		if($_GET['do'] == "login"){ $goto = "login.php";}
		if($_GET['do'] == "admin"){ $goto = "admin.php";}
		if($_GET['do'] == "po"){ $goto = "po.php";}
		if($_GET['do'] == "news"){ $goto = "news.php";}
		if($_GET['do'] == "pop"){ $goto = "pop.php";}
		if($_GET['do'] == "que"){ $goto = "que.php";}
		if($_GET['do'] == "acc"){ $goto = "acc.php";}
		if($_GET['do'] == "apo"){ $goto = "apo.php";}
		if($_GET['do'] == "anews"){ $goto = "anews.php";}
		if($_GET['do'] == "apop"){ $goto = "apop.php";}
		if($_GET['do'] == "aque"){ $goto = "aque.php";}
		if($_GET['do'] == "forget"){ $goto = "forget.php";}
		if($_GET['do'] == "reg"){ $goto = "reg.php";}
		if($_GET['do'] == "logout"){ $goto = "logout.php";}
		if($_GET['do'] == "result"){ $goto = "result.php";}
		if($_GET['do'] == "vote"){ $goto = "vote.php";}
	}

	$sql = "SELECT * from visit where v_date = '".$today."'";
	$ro = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($ro);
	//下面這幾行可以不做, 但資料庫須先建立今日瀏覽的資料
	$check = mysqli_num_rows($ro);
	if($check == 0){
		$sql = "INSERT into visit value(null,'".$today."',1)";
		mysqli_query($link,$sql);
		$row['v_today'] = 1;
		$_SESSION['v'] = 123;
	}

	//判斷有沒有SESSION['v']存在, 若沒有則更新今日瀏覽次數 +1
	if(empty($_SESSION['v'])){
		$sql = "UPDATE visit set v_today = v_today + 1 where v_date ='".$today."'";
		mysqli_query($link,$sql);
		$_SESSION['v'] = 123;
	}


	$sql = "SELECT SUM(v_today) as total from visit";
	$ro1 = mysqli_query($link,$sql);
	$row1 = mysqli_fetch_array($ro1);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>健康促進網</title>
	<link href="./home_files/css.css" rel="stylesheet" type="text/css">
	<script src="./home_files/jquery-1.9.1.min.js"></script>
	<script src="./home_files/js.js"></script>
</head>

<body>
	<div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
		<pre id="ssaa"></pre>
	</div>
	<iframe name="back" style="display:none;"></iframe>
	<div id="all">
		<div id="title">
			<?=date("m")?> 月 <?=date("d")?> 號 <?=date("l")?> | 今日瀏覽: <?=$row['v_today']?> | 累積瀏覽: <?=$row1['total']?> <span style="float:right"><a href="?">回首頁</a></span></div>
		<div id="title2">
			<a href="?"><img src="home_files/02B01.jpg" alt="健康促進網-回首頁"></a>
		</div>
		<div id="mm">
			<div class="hal" id="lef">
				<?php if(!empty($_GET['admin'])){?>
					<a class="blo" href="?admin=1&do=acc">帳號管理</a>
					<a class="blo" href="#">分類網誌</a>
					<a class="blo" href="?admin=1&do=anews">最新文章管理</a>
					<a class="blo" href="#">講座管理</a>
					<a class="blo" href="?admin=1&do=aque">問卷管理</a>
				<?php }else{ ?>
					<a class="blo" href="?do=po&type=1">分類網誌</a>
					<a class="blo" href="?do=news">最新文章</a>
					<a class="blo" href="?do=pop">人氣文章</a>
					<a class="blo" href="#">講座訊息</a>
					<a class="blo" href="?do=que">問卷調查</a>
				<?php } ?>
			</div>
			
			<div class="hal" id="main">
				<div>
				<marquee width="80%">請民眾踴躍投稿電子報。讓電子報成為大家相互交流、分享的園地！詳見最新文章</marquee>
					<span style="width:18%; display:inline-block; text-align:right">
						<?php if(!empty($_SESSION['id'])){
								if($_SESSION['id']=="admin"){
									echo $_SESSION['id'].'<a type="button" href="?admin=1&do=admin">管理</a>|<a type="button" href="?do=logout">登出</a>';
								}else{
									echo $_SESSION['id'].'<a type="button" href="?do=logout">登出</a>';
								}
							}else{
                            echo '<a href="?do=login">會員登入</a>';
                        }?>
					</span>
					<div class="">
						<?php include_once($goto); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="bottom">
			本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © <?=date("Y")?> 健康促進網社群平台 All Right Reserved
			<br>服務信箱：health@test.labor.gov.tw<img src="./home_files/02B02.jpg" width="45">
		</div>
	</div>

</body>

</html>