<?php
    if(!empty($_GET['type'])){
        $sql = "SELECT * from news where n_type ='".$_GET['type']."'";
        $ro = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($ro);
        do{
            $news['con'][]=$row['n_con'];
        }while($row = mysqli_fetch_assoc($ro));
    }
?>

目前位置：首頁 ＞ 分類網誌 ＞ <?php 
if($_GET['type']==1){echo "健康新知";}
if($_GET['type']==2){echo "菸害防制";}
if($_GET['type']==3){echo "癌症防治";}
if($_GET['type']==4){echo "慢性病防治";}
 ?>


<table width="90%" align="center">
    <tr>
        <td  valign="top" width="20%">
        <fieldset>
            <legend>網誌分類</legend>
            <a href="?do=po&type=1">健康新知</a><br>
            <a href="?do=po&type=2">菸害防制</a><br>
            <a href="?do=po&type=3">癌症防治</a><br>
            <a href="?do=po&type=4">慢性病防治</a>
        </fieldset>
        </td>
        <td  valign="top">
        <fieldset>
            <legend>文章</legend>
            <?=$news['con'][0]?>
        </fieldset>
        </td>
    </tr>
</table>
