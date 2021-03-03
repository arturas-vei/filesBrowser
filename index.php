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

    
    ?>
    
</body>
</html>
