<?php

$cnt = 5;
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

?>

<style>
.c1{
    width:100%;
    height:40px;
    overflow:hidden;
}

.c2{
    width:100%;
}

</style>

<fieldset>
    <legend>目前位置：首頁 ＞ 最新文章區</legend>

    <table width=90% align="center">
        <tr>
            <td width="30%">標題</td>
            <td>內容</td>
            <td width="10%"></td>
        </tr>
        <?php do {
            ?>
        <tr>
            <td width="30%"><?=$row['n_title']?></td>
            <td><div class="c1"><?=$row['n_con']?></div></td>
            <td align="center">
            <?php if(!empty($_SESSION['id'])){
                    $sql ="SELECT * from good where g_id ='".$_SESSION['id']."' and g_n_seq ='".$row['n_seq']."'";
                    $ro1 = mysqli_query($link,$sql);
                    $check = mysqli_num_rows($ro1);
                    $row1 = mysqli_fetch_assoc($ro1);
                    if($check==1){echo "<div onclick='ng(".$row1['g_seq'].")'>收回讚</div>";}else{
                        echo "<div onclick='g(".$row['n_seq'].");'>讚</div>";
                    }                
                }
            ?>
            </td>
        </tr>
        <?php
        }while($row = mysqli_fetch_assoc($ro));?>
            <tr>
        <td align="center" colspan="4">
            <a href="?do=news&page=<?=$up?>">＜</a>

            <?php for($i=1;$i<=$page_total;$i++){ 
                if($page_now == $i){ ?>
                <a style="font-size:25px" href="?do=news&page=<?=$i?>"><?=$i?></a>

            <?php }else{
                ?>
                <a href="?do=news&page=<?=$i?>"><?=$i?></a>
            <?php
            }} ?>

            <a href="?do=news&page=<?=$down?>">＞</a>
        </td>
    </tr>
    </table>
</fieldset>

<script>
    function g(nseq){
        $.post("good.php",{nseq},function(){
            window.location.reload();
        });
    }

    function ng(gseq){
        $.post("good.php",{gseq},function(){
            window.location.reload();
        });
    }

    $('.c1').click(function(){
        $(this).removeClass('c1');
        $(this).addClass('c2');
    });
    

</script>