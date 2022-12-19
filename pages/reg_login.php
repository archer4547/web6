<?php

    session_start();

    if (isset($_POST['register']) && $_POST['name'] != null && $_POST['email'] != null && $_POST['pass'] != null)
    {
        $file = fopen('users.txt', 'a');

        if ($file)
        {
            fwrite($file, $_POST['name'], strlen($_POST['name']));
            fwrite($file, ' ', 1);
            fwrite($file, $_POST['email'], strlen($_POST['email']));
            fwrite($file, ' ', 1);
            fwrite($file, $_POST['pass'], strlen($_POST['pass']));
            fwrite($file, "\n", 2);
        }
        header ('Location: ../login.php');
        exit;
    }
    else if (isset($_POST['login']) && $_POST['email_l'] != null && $_POST['pass_l'] != null)
    {   
        $file = fopen('users.txt', 'r');
        $users = array();

        while (!feof($file))
        {
            $line = fgets($file);
            $line_data = array();
            $line_data = explode(' ', $line);
            $users += [$line_data[1] => $line_data[2]];
            $users[$line_data[2]] = [$line_data[0]];
        }
        
        $Email = $_POST['email_l'];
        $Password = $_POST['pass_l']; 

        if (isset($users[$Email]) && $users[$Email] == $Password)
        {
            $_SESSION['user'] = [$users[$users[$Email]][0], $Email];
            header ('Location: ../login.php');
            exit;
        } 
        else
        {
            echo '
            <center>
            <p style="font-size: 10vh">Error!</p>
            </center>
            ';
        }
    }
    else
    {
        echo '
        <center>
        <p style="font-size: 10vh">Error!</p>
        </center>
        ';
    }