<link rel="stylesheet" href="./public/css/style.css">
<link rel="stylesheet" href={{ asset('/css/bootstrap.min.css')}}>
<body>
    <section>

        <div>
            @if(Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if(Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
                @endauth
                </div>
            @endif
        </div>
        <div class="container">
            <div class="d-flex">

                <!-- Текс и выбор цвета -->
                <div id="TextAndColor">
                    <div class="flex-wrap justify-content-start align-items-start">
                        <div>
                            <h3>Укажите текст</h3>
                            <input type="text">
                        </div>
                        <div>
                            <h3>Выберите цвет</h3>
                            <input type="color">
                        </div>
                    </div>
                </div>

                    <!-- Загрузка изображения пользователем -->
                <div>
                    <h1>Загрузка изображения</h1>
                    <form action="{{ route('image.upload') }}" method="post"enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>
                        <button class="btn btn-default" type="submit">Загрузить</button>
                    </form>
                </div>
                @isset($path)
                    <div class="mx-5 flex-wrap justify-content-center align-items-center">
                        <div id="canvas-container">
                            <img id="click" alt = "img" class="img-fluid" src="{{asset('/storage/' . $path) }}" >
                            <canvas id="point1" height="80%" width="80%"></canvas>
                            <canvas id="point2" height="80%" width="80%"></canvas>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
</body>

<!-- Скрипт JS для выделения изображения -->
<script>
    var point1 = document.getElementById("point1"), point2 = document.getElementById("point2");
    var pointtx1 = point1.getContext("2d"), pointtx2 = point2.getContext("2d");
    pointtx2.setLineDash([5, 5]);
    var origin = null;
    window.onload = () => { pointtx1.drawImage(document.getElementById("img"), 0, 0); }
    point2.onmousedown = e => { origin = {x: e.offsetX, y: e.offsetY}; };
    window.onmouseup = e => { origin = null; };
    point2.onmousemove = e => { 
        if (!!origin) { 
            pointtx2.strokeStyle = "#ff0033";
            pointtx2.clearRect(0, 0, point2.width,point2.height);
            pointtx2.beginPath();
            pointtx2.rect(origin.x, origin.y, e.offsetX - origin.x, e.offsetY - origin.y); 
            pointtx2.stroke(); 
        } 
    };

    document.getElementById('click').onclick = function(e) {
      // e = Mouse click event.
      var rect = e.target.getBoundingClientRect();
      var x = e.clientX - rect.left; //x position within the element.
      var y = e.clientY - rect.top;  //y position within the element.
      console.log("Left? : " + x + " ; Top? : " + y + ".");
    }
</script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>





