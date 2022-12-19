<?php
session_start();

    $message = $_POST['comment'];

    $fp = fopen("not_index_comments.php", 'a');

    if (!$fp)
    {
        echo 'Error!';
        exit;
    }
    else if (isset($_SESSION['user']))
    {
        $output = "Name: " . $_SESSION['user'][0] . '<br>Comment: <br>' . $message . "<br><br>\n";
        fwrite ($fp, $output, strlen($output));
        fclose($fp);
        header("Location: ../not_index.php");
        exit;
    }
    else if (!isset($_SESSION['user']))
    {
        echo 'Login first!';
    }