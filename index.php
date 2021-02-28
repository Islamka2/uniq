<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Unique Media</title>
</head>
<body>
    <form method="POST" class='add_mp' enctype="multipart/form-data">
        <input type="text" name='title' class='input-text'>
        <input type='text' name='text' class='input-text'>
        <input type="date" name='date' value='2020-10-05'>
        <input type="file" name="img">
        <input type="submit" name='send-mp'value='Добавить мероприятие' class='submit-mp'>
    </form>

    <?php
    require_once 'db/connection.php'; // подключаем скрипт
    require_once 'functions/mp.php';
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $query = "SELECT * FROM mp ORDER BY date";
    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
    $rows = mysqli_num_rows($result);
    echo 'lol';

    if($result){
        for($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($result);
            echo "<div class='card mb-3'>
        <img class='card-img-top' src='images/$row[2]' alt='Card image cap'>
        <div class='card-body'>
            <h5 class='card-title'>$row[1]</h5>
            <p class='card-text'>$row[3]</p>
            <p class='card-text'><small class='text-muted'>$row[4]</small></p>
        </div>
    </div>";
        }
    }else{
        echo 'nema';
    }
    ?>
    <?php
    require_once 'db/connection.php'; // подключаем скрипт
    require_once 'functions/mp.php';
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    
    // выполняем операции с базой данных
    $query ="SELECT * FROM mp";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if (isset($_POST['send-mp'])) {
        $title = htmlentities(mysqli_real_escape_string($link, $_POST['title']));
        $text = htmlentities(mysqli_real_escape_string($link, $_POST['text']));
        $date = htmlentities(mysqli_real_escape_string($link, $_POST['date']));
        if(isset($_FILES['img'])) {
            if(preg_match("/png/i", $_FILES['img']['name']) or (preg_match('/jpg/i', $_FILES['img']['name']))) { #ПРОВЕРКА НА ФОРМАТ ФАЙЛА
                echo 'Картинка будет добавлена.';
                $name_img = $_FILES['img']['name'];
                $tmp_img = $_FILES['img']['tmp_name'];
                $local_image = 'images/';
                $upload = move_uploaded_file($tmp_img, $local_image.$name_img);
                if($upload){
                    echo "Файл загружен".$name_img;

                }else {
                    echo ' Файл не загружен';
            }
        }
            }else {
                echo 'Не поддерживаемый формат';
            }
            $local_image = 'images/';
            $upload = move_uploaded_file($tmp_img, $local_image.$name_img);
            if($upload){
                echo "Файл загружен".$name_img;

            }else {
                echo ' Файл не загружен';
            }
        } else {
            echo 'ne test';
        }
        post_new_mp($link, $title, $text,$date, $name_img);

    // закрываем подключение
    mysqli_close($link);
    ?>
</body>
</html>



