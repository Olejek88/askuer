<?php 
// считаются суммарные потери помещения и тепловой поток
// Градусо-сутки отопительного периода (ГСОП) следует определять по формуле
// ГСОП = (tв - tот.пер.) zот.пер
//$gradusdays=($temperature-$rs_temp) * $cold;
// Вспомогательное | Санитарно-бытовое | Пустующее | Административное
//if ($typeR=='1' || $typeR=='6' || $typeR=='4' || $typeR=='5')
//	{
//	 if ($gradusdays<2000) $Rtepl=1.6;
//	 if ($gradusdays<4000) $Rtepl=2.4;
//	 if ($gradusdays<6000) $Rtepl=3.0;
//	 if ($gradusdays<8000) $Rtepl=3.6;
//	 if ($gradusdays<10000) $Rtepl=4.2;
//	 if ($gradusdays>10000) $Rtepl=4.8;
//	}
// Производственное | Складское
//if ($typeR=='2' || $typeR=='3')
//	{
//	 if ($gradusdays<2000) $Rtepl=1.4;
//	 if ($gradusdays<4000) $Rtepl=1.8;
//	 if ($gradusdays<6000) $Rtepl=2.2;
//	 if ($gradusdays<8000) $Rtepl=2.6;
//	 if ($gradusdays<10000) $Rtepl=3.0;
//	 if ($gradusdays>10000) $Rtepl=3.4;
//	}       	
// добавочные потери теплоты  через ограждающие конструкции
// через наружные двери
//if ($door_type=='1') $b = 0.2 *$height;
//if ($door_type=='2') $b = 0.27*$height;
//if ($door_type=='3') $b = 0.34*$height;
//if ($door_type=='4') $b = 0.22*$height;
//$b=$b+($win_s*0.1 + $win_w*0.05);

// часть расчетных потерь теплоты, кВт, зданием, возмещаемых отопительными приборами
//$Q1=0;
// коэффициент учета дополнительного теплового потока
//$b1=0;
// коэффициент учета дополнительных потерь теплоты 
//$b2=1.07; //у остекления светового проема
// количество секций радиатора
//$sect=$radiator_type%100;
// тип радиатора МС-140
//if ($radiator_type>100 && $radiator_type<200)
//	{
//	 $Q1=$sect*0.16*1000;
//	 $b1=1.03;
//	}
// тип радиатора МС-180 (РС-80)
//if ($radiator_type>200 && $radiator_type<300)
//	{
//	 $Q1=$sect*0.132*1000;
//	 $b1=1.02;
//	}
//$Qpot[$index]=(($wall_square*$height) * ($temperature-$rs_temp) * (1+$b))/$Rtepl;
//$Qras[$index]= $radiators*($Q1*$b1*$b2);
// полезный объем
$Qpot[$index]=$volume;
$Qras[$index]=$volume;
?>

