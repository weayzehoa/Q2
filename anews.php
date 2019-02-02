<?php

    $cnt = 3;
    $cnt_now = 0;
    $page_now = 1;

    $sql = "SELECT * from news";
    $ro1 = mysqli_query($link,$sql);
    $row1 = mysqli_fetch_assoc($ro1);
    $total = mysqli_num_rows($ro1);

    $page_total = ceil($total / $cnt);

    if(!empty($_GET['page'])){
        $page_now = $_GET['page'];
    }

    $up = $page_now -1;
    $down = $page_now +1;

    if($up <= 0){$up = 1;}
    if($down > $page_total){$down = $page_total;}

    $cnt_now = ($page_now -1) * $cnt;

    $sql = "SELECT * from news limit ".$cnt_now.",".$cnt;
    $ro = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($ro);

    
    if(!empty($_POST['look'])){
        for($i=0;$i<count($_POST['seq']);$i++){
            $sql = "UPDATE news set n_look = 0 where n_seq ='".$_POST['seq'][$i]."'";
            mysqli_query($link,$sql);    
        }
        for($i=0;$i<count($_POST['look']);$i++){
            $sql = "UPDATE news set n_look = 1 where n_seq = '".$_POST['look'][$i]."'";
            mysqli_query($link,$sql);
        }
        header("location:?admin=1&do=anews");
    }

    if(!empty($_POST['del'])){
        for ($i=0;$i<count($_POST['del']);$i++) {
            $sql = "DELETE from news where n_seq ='".$_POST['del'][$i]."'";
            mysqli_query($link, $sql);
        }
        header("location:?admin=1&do=anews");
    }

?>


<form method="post">
<fieldset>

<legend>最新文章管理</legend>
	<table width="80%" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    <tr>
        <td align="center" width="10%">編號</td>
        <td align="center" width="50%">標題</td>
        <td align="center" width="20%">顯示</td>
        <td align="center" width="20%">刪除</td>
    </tr>
    <?php do {
        ?>
    <tr>
        <td align="center"><?=$row['n_seq']?></td>
        <td align="center"><?=$row['n_title']?></td>
        <td align="center">
            <input type="hidden" name="seq[]" value="<?=$row['n_seq']?>">
            <input type="checkbox" name="look[]" <?php if($row['n_look']==1){echo "checked";}?> value="<?=$row['n_seq']?>"></td>
        <td align="center"><input type="checkbox" name="del[]" value="<?=$row['n_seq']?>"></td>
    </tr>
    <?php
    }while($row = mysqli_fetch_assoc($ro));?>
    <tr>
        <td align="center" colspan="4">
            <a href="?admin=1&do=anews&page=<?=$up?>">＜</a>

            <?php for($i=1;$i<=$page_total;$i++){ 
                if($page_now == $i){ ?>
                <a style="font-size:25px" href="?admin=1&do=anews&page=<?=$i?>"><?=$i?></a>

            <?php }else{
                ?>
                <a href="?admin=1&do=anews&page=<?=$i?>"><?=$i?></a>
            <?php
            }} ?>

            <a href="?admin=1&do=anews&page=<?=$down?>">＞</a>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="4">
            <input type="submit" name="submit" id="submit" value="確定修改">
        </td>
    </tr>
  </tbody>
</table>
</form>