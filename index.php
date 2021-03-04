<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple file browser</title>
    <style>
        table {
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }
        table, tr, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
        th {
            background-color: #1C23FF;
            color: #FFF;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
        tr:nth-child(odd) {
            background-color: #fff;
        }
    </style>
</head>
<body <?php if(!$_SESSION['logged_in'] == true) print('style="background-color: #4C00FF;"'); 
            if($_SESSION['logged_in'] == true) print('style="background-color: #99FF95;"')?> >

    <?php //login form
    if(!$_SESSION['logged_in'] == true){
        print('<div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">');
        print('<form action = "" method = "post">');
        print('<h4>' . $mesage . '</h4>');
        print('<input type="text" name="username" placeholder = "username = Arturas" required></br>');
        print('<input type="password" name="password" placeholder = "password = 1234" required><br>');
        print('<button type="submit" name="login" style="margin-left: 55px; margin-top: 10px">Login</button>');
        print('</form>');
        print('</div>');
        die();
    }

    $path = './'.$_GET['my_way'];
    $files = scandir($path);
    print('<h2>You are in: '. $path .'</h2>');
    echo '<br>';
    print('<table>');
    print('<tr><th>File or Folder</th><th>Name</th><th>Action</th></tr>');

    // main structure - scan current directory and show files/folders
    foreach ($files as $file) {
        print('<tr>');
        if ($file != '.' && $file != '..') {
            print('<td>'. (is_dir($path . $file) ? '<img src="img/folder_pic.png">' : '<img src="img/file_pic.png">') .'</td>');
            print('<td>');
            if (is_dir($path . $file) == 'true') {
                print('<a href="');
                if (isset($_GET['my_way']) == 'true') {
                    print($_SERVER['REQUEST_URI'] . $file . '/'. '">' . $file . '</a>');
                } else print($_SERVER['REQUEST_URI'] . '?my_way=/' . $file . '/'. '">' . $file . '</a>');
            } else 
            print($file.'</td>'); 
            //delete/download file buttons
            print((is_file($path . $file) ? '<td>
                <form method="post" style="display: inline-block"><input type="hidden" name="deletion" value='.str_replace(' ', '&nbsp;', $file).'><input type="submit" value="Delete"></form>
                <form method="post" style="display: inline-block"><input type="hidden" name="download" value='.str_replace(' ', '&nbsp;', $file).'><input type="submit" value="Download"></form>
                </td>' 
                : "<td> Don't touch :) </td>"));
        }       
        print('</tr>');
    }
    print('</table>');
    echo '<br>';

    //back button
    print("\t".'<button><a href="');
    $back_fake = explode('/', $_SERVER['QUERY_STRING']);
    $back_real = explode('/', $_SERVER['QUERY_STRING'],-2);
    if (count($back_fake) == 1 || count($back_fake) == 2) {
        print('?my_way=/'.'">BACK button</a>');
    } else
        print('?'.implode('/',$back_real).'/'.'">BACK button</a>');
        print('</button><br>')
    ?>

    <!-- upload file -->
    <br>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload"/>
        <button type="submit">Upload file</button>
    </form>

    <!-- new directory -->
    <br>
    <form method="get"> 
        <input type="hidden" name="my_way" value="<?php print($_GET['my_way']) ?>" /> 
        <input placeholder="New folder name" type="text" name="new_dir">
        <button type="submit">Create</button>
    </form>

    <!-- logout button -->
    <br>
     <form action="index.php" method="post"> 
        <input type="hidden" name="logout">
        <button type="submit">Logout!</button>
    </form>

</body>
</html>