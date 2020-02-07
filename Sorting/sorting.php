<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Pilih text untuk di upload:</br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Sorting" name="submit">
</form>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $target_file = basename($_FILES["fileToUpload"]["name"]); //mendapatkan target file yang di upload
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Allow certain file formats
    if($FileType != "txt" ) {
        echo "Sorry, only txt files are allowed.";
        $uploadOk = 0;
    }

    // cek jika $uploadOk bernilai 0 dikarenakan error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not sorted.";
    // jika sukses untuk upload and sort file
    } else {
        $lines = file($_FILES["fileToUpload"]["tmp_name"]); //untuk menapatkan data per baris

        $arr = array(); //array untuk menampung pemecahan per kata dari masing - masing nama
        $myArr = array(); //array untuk menampung nama dengan kata terakhir di depan
        $name = array(); //array untuk menampung nama seperti semula

        //Perulangan untuk membuat nama dengan kata terakhir dari nama di depan
        $i = 0;
        foreach ($lines as $split)
        {        
            $arr[$i] = explode(" ", $split);
            $last_space_position = strrpos($split, ' ');
            $split = substr($split, 0, $last_space_position);
            $myArr[$i] = end($arr[$i]) . " " . $split;
            $i++;
        }

        sort($myArr); //Fungsi untuk mengurutkan nama dari kata terakhir yang sudah ada di depan dari nama

        $j = 0;
        $file = fopen('sorted-names-list.txt', 'w') or die ("Unable to open file"); //Proses untuk membuka file untuk menampung data nama yang sudah diurutkan
        //perulangan untuk mengembalikan nama seperti awal
        foreach ($myArr as $na)
        {        
            $arr[$j] = explode(" ", $na);
            $firt_word = $arr[$j][0];
            $na = substr(strstr($na," "), 1);
            $name[$j] = $na . " " . $firt_word;
            fwrite($file, $name[$j]); //Memasukkan nama yang sudah urut ke dalam file txt
            $j++;
        }

        fclose($file); //Menutup file yang sudah di masukkan data

        echo "Sorting success, cek in sorted-names-list.txt"; //Indikator dan petunjuk apabila sudah selesai pengurutan
        }
    }
    ?>