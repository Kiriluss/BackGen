<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href={{ asset("/css/style.css") }}>
<link rel="stylesheet" href={{ asset('/css/bootstrap.min.css')}}>
<title>Background Гены</title>
</head>
<body>
    <section class="">
        <div>
            <h1>Background Гены</h1>
            <input type="file" id="fileInput">
            <br><br>
            <input type="text" id="text" placeholder="Enter text">
            <label for="colorPicker">Выберите цвет</label>
            <input type="color" id="colorPicker" onchange="changeColor()">
            <br><br>
            <input type="text" id="x" placeholder="X coordinate">
            <input type="text" id="y" placeholder="Y coordinate">
            <div id="coords">(координаты покажутся здесь)</div>
            <br><br>
            <input type="text" id="fontSize" placeholder="Размер шрифта">

            <button onclick="generateBackground()">Generate</button>
            <br><br>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <div>
                <canvas class="background img-fluid" id="background_old" style="position: relative; text-align: center;"></сanvas>
            </div>
            
            <div class="mx-5 d-flex align-items-center">
                =>
            </div>

            <div>
                <canvas class="background img-fluid " id="background_new" style="position: relative; text-align: center;"></сanvas>
            </div>
        </div>
        <div>
            <button onclick="return download()">Скачать</button>
        </div>

    </section>

<script>
    function drawTextInImage(){
        const fileInput = document.getElementById('fileInput');
        const img = new Image();

        let selectedColor = document.getElementById("colorPicker").value;
        const text = document.getElementById('text').value;
        const fontSize = document.getElementById('fontSize').value;

        const background_new = document.getElementById('background_new');
        context_new = background_new.getContext("2d");


        context_new.font = fontSize+"px Verdana";
        context_new.textAlign = "right";
        context_new.fillStyle = selectedColor;
        const { width, height } = background_new;
        console.log((width/background_new.clientWidth)*event.offsetX);
        context_new.fillText(text, (width/background_new.clientWidth)*event.offsetX, (height/background_new.clientHeight)*event.offsetY);
    }
    canvas = document.getElementById('background_new');
    canvas.addEventListener('click', drawTextInImage);

    function download(){
        var canvas = document.querySelector('#background_new');

        var anchor = document.createElement('a');
        anchor.href = canvas.toDataURL('image/png');  // 'image/jpg'
        anchor.download = 'image.png';                // 'image.jpg'
        anchor.click();

        
    }
    
    function generateBackground() {
        let selectedColor = document.getElementById("colorPicker").value;
            document.getElementById("text").style.color = selectedColor;
        const fileInput = document.getElementById('fileInput');
        const text = document.getElementById('text').value;
        const fontSize = document.getElementById('fontSize').value;
        let x = document.getElementById('x').value;
        let y = document.getElementById('y').value;

        const file = fileInput.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.src = e.target.result;
            img.onload = function() {
                const background_new = document.getElementById('background_new');
                context_new = background_new.getContext("2d");
                background_new.width = img.width;
                background_new.height = img.height;


                const background_old = document.getElementById('background_old');
                context_old = background_old.getContext("2d");
                background_old.width = img.width;
                background_old.height = img.height;

                context_new.drawImage(img, 0, 0, background_new.width, background_new.height);
                context_old.drawImage(img, 0, 0, background_old.width, background_old.height);


                background_new.style.backgroundSize = 'cover';
                const textElement = document.createElement('div');
                textElement.innerText = text;
                textElement.style.position = 'absolute';
                
                if(Number(x) > img.width)
                    {
                        x = img.width-50;
                    }
                if(Number(y) > img.height-50)
                    {
                        y = img.height-50;
                    }

                context_new.font = fontSize+"px Verdana";
                context_new.textAlign = "right";
                context_new.fillStyle = selectedColor;
                console.log(selectedColor);
                context_new.fillText(text, x, y);
            }
        }
        reader.readAsDataURL(file);
    }

    function changeColor() {
        let selectedColor = document.getElementById("colorPicker").value;
        document.getElementById("text").style.color = selectedColor;
    }
    
</script>

</body>
</html>