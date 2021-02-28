<?php
    function find_unic_id($link){
        for($i=1; $i<100; $i++){
        $query ="SELECT * FROM mp WHERE id={$i}";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if ($result->num_rows > 0) {
            pass;
        }else {
            return $i;
        }
        }
    }
    function post_new_mp($link, $title, $text, $date, $img_name) {
        $mp_id = find_unic_id($link);
        $query ="INSERT INTO mp VALUES($mp_id,'$title','$img_name', '$text', '$date')";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if($result){
            echo 'Данные успешно добавлены';
        }else {
            echo 'Ошибка при добавлении';
        }
    }
//    function check_img() # Перенести из index.php
?>