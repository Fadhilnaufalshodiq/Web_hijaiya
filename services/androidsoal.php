<?php
include "../include/koneksi.php";
            include "notice.php";

        
$arr = array();
$q="SELECT * from tb_soal random limit 20 ";
    $result= $mysqli->query($q);
    while($row=$result->fetch_assoc()) {
            $temp = array(
                "soal_id" => $row['id'],
                "soal"=>$row['soal'],
                "a"=>$row['a'],
                "b"=>$row['b'],
                "c" => $row['c'],
                 "d" => $row['d'],
                "jawaban" => $row['jwaban']
            );
            array_push($arr, $temp);
        }   
    $data = json_encode($arr);
    $data = str_replace("\\", "", $data);
    echo "{\"daftar_soal\":" . $data . "}";
?>