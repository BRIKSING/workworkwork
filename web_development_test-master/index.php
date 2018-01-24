<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#datepicker" ).datepicker();
      } );

  </script>
  <script type="text/javascript">
  var data = [];
    function value1() {
      document.getElementById('v1').value = event.currentTarget.value;
      data['v1'] = event.currentTarget.value;
    }

    function value2() {
      document.getElementById('v2').value = event.currentTarget.value;
      data['v2'] = event.currentTarget.value;
    }
  </script>
   <!-- AJAX реализация методов. Ранее AJAX не знал, но прочитал
    и в голове определенно отложилось. Буду рад изучить данную
    технологию подробнее-->
  <script type="text/javascript">
  function CreateRequest()
  {
    var Request = false;
    if (window.XMLHttpRequest)
    {
        //Gecko-совместимые браузеры, Safari, Konqueror
        Request = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        //Internet explorer
        try
        {
             Request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (CatchException)
        {
             Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }
    if (!Request)
    {
        alert("Невозможно создать XMLHttpRequest");
    }
    return Request;
  }
  ;
  function SendRequest(r_method, r_path, r_args, r_handler)
  {
    //Создаём запрос
    var Request = CreateRequest();
    //Проверяем существование запроса еще раз
    if (!Request)
    {
        return;
    }
    //Назначаем пользовательский обработчик
    Request.onreadystatechange = function()
    {
        //Если обмен данными завершен
        if (Request.readyState == 4)
        {
            //Передаем управление обработчику пользователя
            r_handler(Request);
        }
    }
    Request.open("POST", r_path, true);
    //Устанавливаем заголовок
    Request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
    //Посылаем запрос
    Request.send(r_args);
  }
  ;

  function ReadFile(filename, container)
  {
    let checkArgs = CurrentParams();
    let args = SetParameters();
    if(Validate(checkArgs))
    {
      //Создаем функцию обработчик
      var Handler = function(Request)
      {
          document.getElementById(container).innerHTML = Request.responseText;
      }
      //Отправляем запрос
      SendRequest("POST",filename,args,Handler);
    }
    else alert("SOMETHING IS GOING WRONG!");
  }
  ;

  function CurrentParams(input = "")
  {
    if(input!="")
      data[input.name] = input.value;
      for (var variable in data) {
        if (data.hasOwnProperty(variable)) {
          //alert(data[variable]);
        }
      }
    return data;
  };
  function Validate(data) {
    let d = new Date(data['date']);
    for (var variable in data) {
      if (data.hasOwnProperty(variable)) {
        if(variable == 'v1' || variable == 'v2') {
          if(data[variable] < 1000 || data[variable]=="")
            return false;
        }
      }
    }
    let y = Date.parse(d.toString());
    let now =   Date.now();
    return y-now>=0;
  }
  </script>
  <script type="text/javascript">
  //не понимаю,почему не хочет видеть этот метод
  function SetParameters() {
    let d = CurrentParams();
    let i = 0;
    var result="";
    for (var variable in d) {
      if (data.hasOwnProperty(variable)) {
        i++;
        result += variable+"="+d[variable]+(i==5?"":"&");
      }
    }
    return result;
  }
  </script>
    <title>WORLD BANK Publications</title>
  </head>
  <body>
    <div class="container">
      <div class="head">
        <div class="logo-cont">
          <img src="logo.jpg" alt="WORLD BANK Publications" class="logo">
        </div>
        <div class="phones">
          <div class="phone">8-800-100-5005</div>
          <div class="phone">+7 (3452) 522-000</div>
        </div>
      </div>
      <div class="menu">
        <a href="" class="menu-li"><div>Кредитные карты</div></a>
        <a href="" class="menu-li"><div>Вклады</div></a>
        <a href="" class="menu-li"><div>Дебетовая карта</div></a>
        <a href="" class="menu-li"><div>Страхование</div></a>
        <a href="" class="menu-li"><div>Друзья</div></a>
        <a href="" class="menu-li"><div>Интернет-банк</div></a>
      </div>
      <div class="content">
        <!-- Я примерно представляю как сделать "хлебные крошки"
           Но так как тут нет страниц - прдетавил только тааким образом-->
        <?php echo "<div class = 'breadcumbs'><a href=''>Главная</a>&rarr;<a href=''>Вклады</a>&rarr;<a href='index.php'>Калькулятор</a></div>"; ?>

          <form class="calc-form" action="index.php" method="post">
            <h1>Калькулятор</h1>
            <div class="calc">
            <div class="data">
              <span class="name">Дата оформления вклада</span><br>
              <span class="name">Сумма вклада</span><br>
              <span class="name">Срок вклада</span><br>
              <span class="name">Пополнение вклада</span><br>
              <span class="name">Сумма пополения вклада</span><br>
            </div>
              <div class='data'>
              <input name="date" class="field" type="text" id="datepicker" onchange="CurrentParams(this)"><br>
              <input id='v1' name="v1" class="field" min="1000" max="3000000"  type="number" onchange="CurrentParams(this)"><br>
                <select class="field" name="years" onchange="CurrentParams(this)">
                  <option value="1">1 год</option>
                  <option value="2">2 годa</option>
                  <option value="3">3 годa</option>
                  <option value="4">4 годa</option>
                  <option value="5">5 лет</option>
                </select>
              <br>
              <div class="field">
                  <input type="radio" checked value='0' name="radio" onchange="CurrentParams(this)">Нет
                  <input type="radio" value='1' name="radio" onchange="CurrentParams(this)">Да
              </div>
              <input id='v2' name="v2" class="field" min="1000" max="3000000" type="number" onchange="CurrentParams(this)"><br>
            </div>
            <div class="ranges">

              <input class="rng" type="range" value="1000" max="3000000" onmousemove="value1()"/>
              <div class="sums">
                <span class="sum">1 тыс. руб</span>
                <span class="sum">3000000</span>
              </div>
              <br>
              <br>
              <br>
              <br>
              <input class="rng" type="range" value="1000" max="3000000" onmousemove="value2()"/>
              <div class="sums">
                <span class="sum">1 тыс. руб</span>
                <span class="sum">3000000</span>
              </div>
            </div>
          </div>

          <!-- <input type="submit" name="submit" value="Рассчитать" onclick="alert(SetParameters())"> -->
          <button class="b" type="button" name="button" onclick="ReadFile('calc.php', 'res')">AJAX</button>

          Результат: <span id='res' class="result"></span> руб
        </form>
      </div>
      <div class="footer">
        <div class="footer-menu">
          <a href="" class="footer-menu-li"><div>Кредитные карты</div></a>
          <a href="" class="footer-menu-li"><div>Вклады</div></a>
          <a href="" class="footer-menu-li"><div>Дебетовая карта</div></a>
          <a href="" class="footer-menu-li"><div>Страхование</div></a>
          <a href="" class="footer-menu-li"><div>Друзья</div></a>
          <a href="" class="footer-menu-li"><div>Интернет-банк</div></a>
        </div>
      </div>
    </div>
  </body>
</html>
