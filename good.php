<?php
    include_once("setdb.php");

    if(!empty($_POST['nseq'])){
        $add = 0;
        $sql = "INSERT into good value(null,'".$_SESSION['id']."','".$_POST['nseq']."')";
        mysqli_query($link,$sql);
        $sql = "SELECT * from news where n_seq ='".$_POST['nseq']."'";
        $ro = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($ro);
        $add = $row['n_good'] + 1;
        $sql = "UPDATE news set n_good = ".$add." where n_seq ='".$_POST['nseq']."'";
        mysqli_query($link,$sql);
    }

    if(!empty($_POST['gseq'])){
        $add = 0;
        $sql = "SELECT * from good where g_seq ='".$_POST['gseq']."'";
        $ro = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($ro);

        $sql = "SELECT * from news where n_seq ='".$row['g_n_seq']."'";
        $ro1 = mysqli_query($link,$sql);
        $row1 = mysqli_fetch_assoc($ro1);
        $add = $row1['n_good'] - 1;

        $sql = "UPDATE news set n_good = ".$add." where n_seq ='".$row['g_n_seq']."'";
        mysqli_query($link,$sql);
        $sql = "DELETE from good where g_seq = '".$_POST['gseq']."'";
        mysqli_query($link,$sql);
    }

?>