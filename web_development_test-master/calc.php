<?php
    $date = preg_split("#/#",$_POST['date']); //0 - month, 1 - day, 2 - year
    $sum = $_POST['v1'];
    $addingSum = $_POST['v2'];
    $yesNo = $_POST['radio'];
    $years = $_POST['years'];
    $currentYear = $date[2];
    for ($i=$date[2]; $i<=$currentYear+$years; $i++)
    {
      for ($i==$date[2] ? $j=$date[0] : $j=1; $j <= 12; $j++)
      {
        if($j == $date[0] && $i==$currentYear+$years)
          break;
        $daysy = 365 + date("L", mktime(0,0,0,1,1,$i));
        $PERCENT = 10;
        $daysn = date("t", mktime(0,0,0,$j,1,$i));
        $sumAdd = $yesNo?$addingSum:0;
        //Если я правильно понял тему задания - то нужно рассчитать
        //сколько денег останется на счету под 10 % на определенный срок
        // и если пользователь будет каждый месяц класть на счет n-ую сумму
        //денег. Поэтому немного по-другому осмыслил формулу
        $sum += $sumAdd + ($sum + $sumAdd) * ($daysn * $PERCENT / $daysy) / 100;
      }
    }
    echo $sum;
 ?>
