
// Рисует основную картинку и создает пресеты
function drawImage() {
    const pr1 = document.getElementById("preset1");
    const pr2 = document.getElementById("preset2");
    const pr3 = document.getElementById("preset3");
    const pr4 = document.getElementById("preset4");
    const pr5 = document.getElementById("preset5");
    const background_old = document.getElementById('background_old');


    const fileInput = document.getElementById('fileInput');

    const file = fileInput.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.src = e.target.result;
        img.onload = function() {
            canvasDraw(background_old, img);

            canvasDraw(pr1.children[0], img);
            canvasDraw(pr2.children[0], img);
            canvasDraw(pr3.children[0], img);
            canvasDraw(pr4.children[0], img);
            canvasDraw(pr5.children[0], img);

        };
    }
    reader.readAsDataURL(file);
    
    setTimeout(() => { presetDrawText(pr1, pr1.children[0].width/8, pr1.children[0].height/8, 'start'); }, 3000);
    setTimeout(() => { presetDrawText(pr2, pr2.children[0].width/8, pr2.children[0].height/1.1, 'start'); }, 3000);
    setTimeout(() => { presetDrawText(pr3, pr3.children[0].width/2, pr3.children[0].height/2); }, 3000);
    setTimeout(() => { presetDrawText(pr4, pr4.children[0].width/1.1, pr4.children[0].height/1.1, 'end'); }, 3000);
    setTimeout(() => { presetDrawText(pr5, pr5.children[0].width/1.1, pr5.children[0].height/8, 'end'); }, 3000);

}

// Рисует картинки для пресетов
function canvasDraw(element, img){
    context = element.getContext("2d");
    element.width = img.width;
    element.height = img.height;    

    context.drawImage(img, 0, 0, element.width, element.height);
}

// Накладывает текст на пресеты и создает ивенты на кнопки
function presetDrawText(element, x, y, location="center"){
    let selectedColor = document.getElementById("colorPicker").value
    context = element.children[0].getContext("2d");
    if(element.children[0].width > 3000){
        context.font = "200px Verdana";
    }
    else if(element.children[0].width > 2000){
        context.font = "150px Verdana";
    }
    else if(element.children[0].width > 1000){
        context.font = "90px Verdana";
    }
    else{
        context.font = "32px Verdana";
    }
    context.fillStyle = selectedColor;
    context.textAlign = location;
    context.textBaseline="middle";
    
    context.fillText("Пример", x, y);

    element.addEventListener('click', preset(x, y, location));
}

// Функция переноса текста с пресета на изменяемую картину
function preset(x, y, location){
    return (event) => {
        let selectedColor = document.getElementById("colorPicker").value;
        const text = document.getElementById('text').value;
        const fontSize = document.getElementById('fontSize').value;

        const background_new = document.getElementById('background_new');
        context_new = background_new.getContext("2d");


        context_new.font = fontSize+"px Verdana";
        context_new.fillStyle = selectedColor;
        context_new.textAlign = location;
        context_new.textBaseline="middle";
        context_new.fillText(text, x, y);

       }
    
}

// Рисует текст при нажатии мышкой по полю canvas
function drawTextInImage(){
    const fileInput = document.getElementById('fileInput');
    const img = new Image();
    
    if(fileInput.value!=''){
        let x=document.getElementById("x");
        let y=document.getElementById("y");
        x.value=event.offsetX;
        y.value=event.offsetY;
        let selectedColor = document.getElementById("colorPicker").value;
        const text = document.getElementById('text').value;
        const fontSize = document.getElementById('fontSize').value;
    
        const background_new = document.getElementById('background_new');
        context_new = background_new.getContext("2d");
    
    
        context_new.font = fontSize+"px Verdana";
        context_new.textAlign = "right";
        context_new.fillStyle = selectedColor;
        context_new.textAlign = "center";
        context_new.textBaseline="middle";
        const { width, height } = background_new;
        context_new.fillText(text, (width/background_new.clientWidth)*event.offsetX, (height/background_new.clientHeight)*event.offsetY);
    }
    
}

canvas = document.getElementById('background_new');
canvas.addEventListener('click', drawTextInImage);

// Функция скачивания изменённого изображения
function download(){
    var canvas = document.querySelector('#background_new');
    var dataURL = canvas.toDataURL('image/png');

    var anchor = document.createElement('a');
    anchor.href = dataURL;
    anchor.download = 'image.png';
    anchor.click();
}

// Функция нанесения загруженного изображения на канвас и наложения текста
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
            context_new.textAlign = "center";
            context_new.textBaseline="middle";
            context_new.fillText(text, x, y);
        }
    }
    reader.readAsDataURL(file);
}


// Изменение цвета текста в поле ввода
function changeColor() {
    let selectedColor = document.getElementById("colorPicker").value;
    document.getElementById("text").style.color = selectedColor;
}

// Кнопка очистки изображения
function cleanSheet(){
    let selectedColor = document.getElementById("colorPicker").value;
        document.getElementById("text").style.color = selectedColor;
    const fileInput = document.getElementById('fileInput');

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

            context_new.drawImage(img, 0, 0, background_new.width, background_new.height);
        }
    }
    reader.readAsDataURL(file);
}