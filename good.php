<?php
    include_once("setdb.php");

    if(!empty($_POST['nseq'])){
        $sql = "INSERT into good value(null,'".$_SESSION['id']."','".$_POST['nseq']."')";
        mysqli_query($link,$sql);
        $sql = "UPDATE news set n_good = n_good + 1 where n_seq ='".$_POST['nseq']."'";
        mysqli_query($link,$sql);
    }

    if(!empty($_POST['gseq'])){
        $sql = "SELECT * from good where g_seq ='".$_POST['gseq']."'";
        $ro = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($ro);
        $sql = "UPDATE news set n_good = n_good -1 where n_seq ='".$row['g_n_seq']."'";
        mysqli_query($link,$sql);
        $sql = "DELETE from good where g_seq = '".$_POST['gseq']."'";
        mysqli_query($link,$sql);
    }

?>