
<?php
    $sql = "SELECT * from que";
    $ro = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($ro);
?>
<fieldset>
    <legend>目前位置：首頁 ＞ 問卷調查</legend>

    <table width=90% align="center">
        <tr>
            <td width="10%">編號</td>
            <td width="40%">問卷題目</td>
            <td width="20%">投票總數</td>
            <td width="15%">結果</td>
            <td width="15%">狀態</td>
        </tr>
    <?php do {
        ?>
        <tr>
            <td width="10%"><?=$row['q_seq']?></td>
            <td width="40%"><?=$row['q_name']?></td>
            <td width="20%">
            <?php 
                $sql = "SELECT * from que_option where q_n_seq = '".$row['q_seq']."'";
                $ro1 = mysqli_query($link,$sql);
                $row1 = mysqli_fetch_assoc($ro1);
                $total = 0;
                do{
                    $total = $total + $row1['q_o_vote'];
                }while($row1 = mysqli_fetch_assoc($ro1));
                echo $total;
            ?>
            </td>
            <td width="15%"><a href="?do=result&no=<?=$row['q_seq']?>">結果</a></td>
            <td width="15%">
                <?php
                    if(!empty($_SESSION['id'])){echo "<a href='?do=vote&no=".$row['q_seq']."'>參與投票</a>";}else{echo "<a href='?do=login'>請先登入</a>";}
                ?>
            </td>
        </tr>
    <?php } while($row = mysqli_fetch_assoc($ro));?>
</table>
</fieldset>