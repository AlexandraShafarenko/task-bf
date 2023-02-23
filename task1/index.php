<?php
$audi = ['A4', 'A6', 'A7', 'Q3', 'Q5', 'TT'];
$renault = ['Scenic', 'Duster', 'Fluence', 'Megane', 'Sandero', 'Logan'];
$bmw = ['1', '3', '5', '7', 'X1', 'X3', 'X5'];
/**
 * получение пунктов select
 * @param $marka
 * @return string
 */
function getModel($marka){
    $data = '<option disabled selected>Выберите модель</option>';
    foreach($marka as $item){
        $data .= "<option value='$item'>$item</option>";
    }
    return $data;
}
if(isset($_POST["code"])){
    $request = $_POST['code'];
    switch ($request) {
        case 'audi':
            echo getModel($audi);
            exit();
        case 'renault':
            echo getModel($renault);
            exit();
        case 'bmw':
            echo getModel($bmw);
            exit();
    }
}
?>
<!doctype html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="jquery.maskedinput.min.js"></script>
    <script src="index.js"></script>
</head>
<body>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <form id="form">
            <div class="form-group">
                <label class="col-sm-2 control-label">Марка автомобиля</label>
                <div class="col-sm-4">
                    <select class="form-control" name="marka" id="marka">
                        <option disabled selected>Выберите марку</option>
                        <option value="audi">Audi</option>
                        <option value="renault">Renault</option>
                        <option value="bmw">BMW</option>
                    </select>
                </div>
            </div>
            <div class="form-group model-select">
                <label class="col-sm-2 control-label">Модель атомобиля</label>
                <div class="col-sm-4">
                    <select class="form-control" name="model" id="model">
                    </select>
                </div>
            </div>
            <div class="form-group type-select">
                <label class="col-sm-2 control-label">Тип запчасти</label>
                <div class="col-sm-4">
                    <select class="form-control" name="type" id="type">
                        <option disabled selected>Выберите тип запчасти</option>
                        <option value="Бампер передний">Бампер передний</option>
                        <option value="Бампер задний">Бампер задний</option>
                        <option value="Крышка капота">Крышка капота</option>
                        <option value="Дверь водительская">Дверь водительская</option>
                        <option value="Дверь пассажирская">Дверь пассажирская</option>
                        <option value="Дверь задняя левая">Дверь задняя левая</option>
                        <option value="Крыло правое">Крыло правое</option>
                        <option value="Фара противотуманная">Фара противотуманная</option>
                    </select>
                </div>
            </div>
            <div class="form-group name-input">
                <label class="col-sm-2 control-label">Ваше имя</label>
                <div class="col-sm-4">
                    <input type="text" name="name" class="form-control" required>
                </div>
                <label class="col-sm-2 control-label">Ваш телефон</label>
                <div class="col-sm-4">
                    <input name="phone" id="phone" class="form-control"  type='tel' required>
                </div>
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
        <p id="massage"></p>
    </div>
</div>

<script>
    $('#form').submit(function(){
        event.preventDefault();
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'html',
            data: $(this).serialize(),
            success: function(data){
                $("#massage").text(data);
            }
        });
    });
</script>
</body>