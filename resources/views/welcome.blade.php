<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href={{ asset("/css/style.css") }}>
<link rel="stylesheet" href={{ asset('/css/bootstrap.min.css')}}>
<title>Background Generate</title>
</head>
<body>
    <section class="container">
    <h1>Background Generate</h1>

        <div class="d-flex justify-content-center text-center align-items-center ">
            <div class="flex-wrap justify-contnet-center align-items-center">
                <div class=" justify-content-center align-items-center">
                    <input class="buttonborder" type="file" id="fileInput" onchange="drawImage()">
                </div>
                <br><br>
                <div class="justify-content-center align-items-center ">
                    <input class="ms-3 inputpole" type="text" id="text" placeholder="Enter text" value="Поле для текста">
                    <label class="ms-3 d-flex justify-content-center align-items-center" for="colorPicker">Выберите цвет</label>
                    <input class="inputpole texttd ms-3  justify-content-center align-items-center" type="color" id="colorPicker" onchange="changeColor()">
                </div>
                <br><br>
                    <input type="text" id="x" placeholder="X coordinate">
                    <input type="text" id="y" placeholder="Y coordinate">
                <br><br>
                <div class="ms-5">
                    <input class="inputpole" type="text" id="fontSize" placeholder="Размер шрифта">
                    <button class=" ms-2 buttonborder" onclick="generateBackground()">Сгенерировать</button>    
                </div>
                <br><br>
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="d-flex col-lg-5 col-sm-12 col-md-12 col-12">
                    <canvas class="background img-fluid" id="background_old" style="position: relative; text-align: center;"></сanvas>
                </div>
                
                <div class="mx-5 d-flex justify-content-center align-items-center col-lg-1 col-sm-12 col-md-12 col-12">
                    =>
                </div>

                <div class="d-flex col-lg-5 col-sm-12 col-md-12 col-12">
                    <canvas class="background img-fluid " id="background_new" style="position: relative; text-align: center;"></сanvas>
                </div>
            </div>
        </div>
        <div>
            <button class="buttonborder" id="download" onclick="return download()">Скачать</button>
            <button class="buttonborder" onclick="return cleanSheet()">Очистить</button>
        </div>

    </section>
    <section class="container">
        <div class="d-flex align-items-center justify-content-center">
            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <div class="ms-4">
                    <p>Пресет1</p>
                    <button class="buttonImg" id="preset1"><canvas class="imgPreset img-fluid" id="preset1"></canvas></button>
                </div>
                <div class="ms-4">
                    <p>Пресет2</p>
                    <button class="buttonImg" id="preset2"><canvas class="imgPreset img-fluid" id="preset2"></canvas></button>
                </div>
                <div class="ms-4">
                    <p>Пресет3</p>
                    <button class="buttonImg" id="preset3"><canvas class="imgPreset img-fluid" id="preset3"></canvas></button>
                </div>
                <div class="ms-4">
                    <p>Пресет4</p>
                    <button class="buttonImg" id="preset4"><canvas class="imgPreset img-fluid" id="preset4"></canvas></button>
                </div>
                <div class="ms-4">
                    <p>Пресет5</p>
                    <button class="buttonImg" id="preset5"><canvas class="imgPreset img-fluid" id="preset5"></canvas></button>
                </div>
            </div>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/funcGen.js"></script>

</body>
</html>