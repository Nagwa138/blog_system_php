<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    section {
        height: 100vh;
        background-color: darkred;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 30px;
    }
    </style>
</head>

<body>
    <section>
        <?php
        echo isset($_GET['message'])? $_GET['message'] : 'PAGE ERROR';
        echo ' | ';
        echo isset($_GET['status']) ? $_GET['status']: '419';
        ?>
    </section>
</body>

</html>