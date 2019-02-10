<?php
    if(!empty($_POST['vote'])){
        $sql = "UPDATE que_option set q_o_vote = q_o_vote + 1 where q_o_seq ='".$_POST['vote']."'";
        mysqli_query($link,$sql);
        header("location:?do=que");
    }

    $sql = "SELECT * from que a, que_option b where a.q_seq = b.q_n_seq and b.q_n_seq = '".$_GET['no']."'";
    $ro = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($ro);
?>

<fieldset>
    <legend>目前位置：首頁 ＞ 問卷調查 ＞ <?=$row['q_name']?></legend>

    <p><?=$row['q_name']?></p>
    <form method="post">
    <?php do {
        ?>
        <input type="radio" name="vote" value="<?=$row['q_o_seq']?>"><?=$row['q_o_name']?><br>
    <?php
    } while($row = mysqli_fetch_assoc($ro)); ?>
        <input type="submit" value="我要投票">
    </form>
</fieldset>