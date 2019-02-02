<?php
    $sql = "SELECT * from que a, que_option b where a.q_seq = b.q_n_seq and b.q_n_seq = '".$_GET['no']."'";
    $ro1 = mysqli_query($link,$sql);
    $row1 = mysqli_fetch_assoc($ro1);
    $total = 0;
    do{
    $total = $total + $row1['q_o_vote'];
    }while($row1 = mysqli_fetch_assoc($ro1));

    $sql = "SELECT * from que a, que_option b where a.q_seq = b.q_n_seq and b.q_n_seq = '".$_GET['no']."'";
    $ro = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($ro);
?>

<fieldset>
    <legend>目前位置：首頁 ＞ 問卷調查 ＞ <?=$row['q_name']?></legend>
    <p><?=$row['q_name']?></p>

    <table width=90% align="center">
        <?php do {            
            ?>
        <tr>
            <td width="5%"><?=$row['q_o_seq']?></td>
            <td width="40%"><?=$row['q_o_name']?></td>
            <td><div style="background-color:#0FF;display:inline-block;height:20px;width:<?=30*$row['q_o_vote']?>px"></div><?=$row['q_o_vote']?>票(<?=($row['q_o_vote']/$total)*100;?>%)</td>
        </tr>
    <?php } while($row = mysqli_fetch_assoc($ro));?>
        <tr>
            <td align="center" colspan="3"><a href="?do=que"><button>返回</button></a></td>
        </tr>
    </table>
</fieldset>