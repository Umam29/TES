<!DOCTYPE html>
<html>
<body>

<form action="" method="post">
    Masukkan angka 
    <input type="number" name="angka" id="angka">
    <input type="submit" value="submit" name="submit">
</form>

</body>
</html>


<?php
    if (isset($_POST['submit'])) {
        $number = $_POST['angka'];
        $num = $number + 3;
        for ($i = 1; $i <= $number; $i++) {
            //For repeat entire number before star
            for ($j = 1; $j <= $i; $j++) {                
                echo $j;                
            }
            //For repeat star
            for ($k = $j - 1; $k <= $j; $k++) {
                echo "*";
            }
            //For repeat number after star
            for ($l = $j+2; $l <= $num; $l++) {                
                echo $l;                
            }
            echo "</br>";
        }
    }
?>