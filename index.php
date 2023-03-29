<div class="forma1" id="forma">
	
	<div class="forma">
	<h3 class="txtkont">Выберите удобное время для записи к юристу</h3>
	<?php
	echo "<table id='table' border=1>";
	$DateNow = date(DATE_RSS);
	echo "<tr>";
	 $monthshort = ['янв','фев','мар','апр','май','июн','июл','авг','сен','окт','ноя','дек'];
	//$monthshort = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
    $daysofweek = ['пн','вт','ср','чт','пт','сб','вс'];
	//$daysofweek = ['понедельник','вторник','среда','четверг','пятница','сб','вс'];
	for($i = 1; $i < 9; $i++)
	{
		$date = new DateTime($DateNow);
		$date->add(new DateInterval('P'.$i.'D'));
		$monthtemp = $date->format('n')-1;
		$daysofweektemp = $date->format('N')-1;
		$Date2 = $date->format('j '.$monthshort[$monthtemp]);
		$Date2 = $Date2.'</br>'.$date->format($daysofweek[$daysofweektemp]);
		if($daysofweektemp <= 4)
		{
			echo "<th>".$Date2."</th>";
		}
        else
                {
                    echo "<th>".$Date2."</th>";
                }
	}
    echo "</tr>";
	$time = "0000-00-00 08:30:00";
    $time = date("H:i", strtotime($time));
    $timecal = date("H:i", strtotime($time));
    
	for($j = 0; $j < 16; $j++)
	{
		$time = date('H:i', strtotime("+30 minutes", strtotime($time)));
		$timecal = date('His', strtotime("+30 minutes", strtotime($timecal)));	
		if($timecal!='130000' and $timecal!='133000')
		{
			echo "<tr>";
			for($i = 1; $i < 9; $i++)
			{
				$date = new DateTime($DateNow);
				$date->add(new DateInterval('P'.$i.'D'));
				$daysofweektemp = $date->format('N')-1;
				if($daysofweektemp <= 4)
				{
					// echo "<td style='background-color: green' id= ".$date->format('Ymd')."T".$timecal.">".$time."</td>";
					echo ' <td class= "b" id= '.$date->format("Ymd")."T".$timecal.'>'.$time.'</td>';
				}
                else
                {
                    echo '<td class= "busy" id= '.$date->format("Ymd")."T".$timecal.'>'.$time.'</td>';
                }
			}
			echo "</tr>";
		}
	}
	echo "</table>";
	?>
	
		<form class="formreview" id="formreview" name="formreview" method="post" action="javascript:void(0);">
			<h3 class="txtkont">Внесите сведения</h3>
			<li> <input name="fam" placeholder="Ваше имя" class="inputF" type="text" required></li>
			<li> <input name="num" placeholder="Ваш телефон" id = "phone" class="inputN" type="text" required></li>
			<li> <input name="txt" placeholder="Ваш вопрос"  class="inputN" type="text" required ></li>
			<li style="display:none"> <input name="date" class='date' style="display:none"></li>
			<li> <button id="submitreview" class="submit" >Отправить</button> <li> <button id="cancel" >Отмена</button></li></li>
		</form>
	</div>
</div>
</div>
</body>


