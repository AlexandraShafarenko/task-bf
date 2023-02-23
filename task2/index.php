<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<?php
$f_json = 'https://bfdev.ru/test/json.txt';
$json = file_get_contents("$f_json");
$json_array = json_decode($json, true);

$hostname = "localhost";
$database = "task_bf";
$username = "root";
$password = "root";
$db = new Mysqli($hostname, $username, $password, $database);

if($db->connect_errno){
    die('Connect Error: ' . $db->connect_errno);
}
//создание таблицы task2
/*$sql = "CREATE TABLE IF NOT EXISTS `task2` (
    `nomenclature_code` varchar(255) NOT NULL PRIMARY KEY,
    `quantity_sklad_1` int NOT NULL,
    `quantity_sklad_2` int NOT NULL
)";
$db->query($sql);
*/
/*foreach($json_array as $sklad){
    foreach($sklad as $key => $items){
        $nomenclature_code = $key;
        foreach ($items as $item){
            if($item['SKLAD_ID'] == 1){
                $quantity_sklad_1 = $item['QUANTITY'];
            }else{
                $quantity_sklad_2 = $item['QUANTITY'];
            }
        }
        $sql = "INSERT INTO `task2` (`nomenclature_code`, `quantity_sklad_1`, `quantity_sklad_2`)
            VALUES ('$nomenclature_code', '$quantity_sklad_1', '$quantity_sklad_2')";

        $db->query($sql);
    }
}
*/
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
<?php
//Получение остатка складов
$result = $db->query("SELECT `quantity_sklad_1`, `quantity_sklad_2` FROM `task2`");

$result_array = $result->fetch_all();
$sklad1 = 0;
$sklad2 = 0;
foreach ($result_array as $items){
    $sklad1 += (int) $items[0];
    $sklad2 += (int) $items[1];
}
echo "<p>Остаток на складе номер 1 - $sklad1 ед.</p>";
echo "<p>Остаток на складе номер 2 - $sklad2 ед.</p>";
echo '<hr>';
?>
<p>Остаток склада номер 1</p>
<?php
//Получение остатка склада 1
$result = $db->query("SELECT `nomenclature_code`, `quantity_sklad_1` FROM `task2` WHERE `quantity_sklad_1` >0");

$result_array = $result->fetch_all();
foreach ($result_array as $items){
    $str_array = explode('-',$items[0]);
    $str = $str_array[0] . '-' . $str_array[1];
    echo "<p>$str - $items[1] ед.</p>";
}
?>
<hr>
<p>Остаток склада номер 2</p>
<?php
//Получение остатка склада 2
$result = $db->query("SELECT `nomenclature_code`, `quantity_sklad_2` FROM `task2` WHERE `quantity_sklad_2` >0");

$result_array = $result->fetch_all();
foreach ($result_array as $items){
    $str_array = explode('-',$items[0]);
    $str = $str_array[0] . '-' . $str_array[1];
    echo "<p>$str - $items[1] ед.</p>";
}
?>
    </div>
</div>
<?php
//Запись данных из БД в json-строку
$result = $db->query("SELECT `nomenclature_code`, `quantity_sklad_1`, `quantity_sklad_2` FROM `task2`");

$result_array = $result->fetch_all();
$json_array = [];
foreach ($result_array as $items){
    $str_array = explode('-',$items[0]);
    $str = $str_array[0] . '-' . $str_array[1];
    $item_array = [
        $items[0] =>[
                'code' => $str,
            'sklad_1' => $items[1],
            'sklad_2' => $items[2]
        ]
    ];
    $json_array = array_merge($json_array, $item_array);
}
$json_string = json_encode($json_array);

$db = null;