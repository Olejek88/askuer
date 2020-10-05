<?php
if ($source==8)
{
    $query2='';         // запрос
    $today=getdate ();  // текущее время
    $period=0; 		// время года
    if ($today[mon]==12 || $today[mon]==1  || $today[mon]==2)  { $period=1; $t1=15.9; }
    if ($today[mon]==3  || $today[mon]==4  || $today[mon]==5)  { $period=2; $t1=9.9; }
    if ($today[mon]==6  || $today[mon]==7  || $today[mon]==8)  { $period=3; $t1=7.8; }
    if ($today[mon]==9  || $today[mon]==10 || $today[mon]==11) { $period=4; $t1=13.7; }

    if ($arr["otch"]==1) $datts='date='.$year.$month.$day.'0'.$tm.'0000';
    if ($arr["otch"]==2) $datts='(date='.$year.$month.$day.'000000 OR date='.$year.$month.$day.'120000)';
    if ($arr["otch"]==4) $datts='(date='.$year.$month.'01000000 OR date='.$year.$month.'01120000)';
    
    $Wp1=0; $Wp2=0; $Wp3=0; $Wp5=0; $Wp4=0; $Wd62=0;
    // привязка жесткая, поскольку методики тоже жестко привязаны
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==19)	// деталь
	{
	 // Wрасч=Wр1тп101 + Wр2тп102 + Wр3кнтп250 + Wр4тп4 + Wр5тп5 + WрД62
               // Wр1тп101 = -Wрасч.1 - Wпрох -Wнр.осв - Wнр.освЭ-А + W4 + W5 + W8 + W16 + W3 + W10 + W11 + W6 + W12 + W23
             	     //       Wрасч.1 = W3* + W3** + W10* + W10** + W11* + W11** + Wхим.лаб.
	                  // Wр2тп102 = W1_ру2 - WрЭ-А - Wк10 - Wскл. - расход
	 // От ТП-101
	 fwrite ($fp,"<br>От ТП-101 <br>");
	 // W4 + W5 + W8 + W16 + W3 + W10 + W11 + W6 + W12 + W23
	 // нет W23 (счетчик ф23)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0115';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0116';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W5=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0121';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W8=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0125';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W16=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0114';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0123';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W10=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0124';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W11=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1102';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W6=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1103';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 $query2='SELECT value FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8803';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W23=$mu[0];
	 if ($arr["otch"]==2) $W23=$W23/24; if ($arr["otch"]==1) $W23=$W23/(24*30);	 

	 $Wp1=$W4 + $W5 + $W8 + $W16 + $W3 + $W10 + $W11 + $W6 + $W12 + $W23 - $Wnarosv;
	 fwrite ($fp,'Wр1=W4('.$W4.')+W5('.$W5.')+W8('.$W8.')+W16('.$W16.')+W3('.$W3.')+W10('.$W10.')+W11('.$W11.')+W6('.$W6.')+W12('.$W12.')+W23(?)'.'<br>');
	 fwrite ($fp,'W4 - показания счетчика ф4 корпус6 (Эл. энергия Деталь, W4, ТП101) = '.$W4.'<br>');
	 fwrite ($fp,'W5 - показания счетчика ф5 корпус6 (Эл. энергия Деталь, W5, ТП101) = '.$W5.'<br>');
	 fwrite ($fp,'W8 - силовые нагрузки терм. отделении цеха14 (Эл. энергия W8, ТП101) = '.$W8.'<br>');
	 fwrite ($fp,'W16 - силовые нагрузки отделении ТВЧ цеха14  (Эл. энергия корпус №1, W16, ТП101) = '.$W16.'<br>');
	 fwrite ($fp,'W3 - показания счетчика на ф3 (Эл. энергия, W3, ТП101) = '.$W3.'<br>');
	 fwrite ($fp,'W10 - показания счетчика ф10 цеха 14 (Эл. энергия корпус №1, W10, ТП101) = '.$W10.'<br>');
	 fwrite ($fp,'W11 - показания счетчика ф11 корпус6 (Эл. энергия корпус №1, W11, ТП101) = '.$W11.'<br>');
	 fwrite ($fp,'W6 - показания счетчика ф6 литейный (ТП 101(Ф6 ООО <Литейка>)акт.) = '.$W6.'<br>');
	 fwrite ($fp,'W12 - показания счетчика ф12 (ТП 101(Ф 12 ООО <Литейка>)акт.) = '.$W12.'<br>');
	 fwrite ($fp,'W23 - показания счетчика ф23 (Р23 показания эл.счетчика ф23) = '.$W23.'<br>');
	 fwrite ($fp,'Wнар.осв. - периметр освещения = '.$Wnarosv.'<br>');

	 // нет W3* (освещение на 2-ом этаже корпуса №1)(свободные площади)
	 // нет W10* (силовые нагрузки 2-ом этаже корпуса №1)(свободные площади)
	 // нет W11* (счетчик ОАСУП 2-ом этаже корпуса №1)
	 // Wхим.лаб отсутствует в методике
	 $query2='SELECT SUM(value) FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8804';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3z=$mu[0];
	 if ($arr["otch"]==2) $W3z=$W3z/24; if ($arr["otch"]==1) $W3z=$W3z/(24*30);

	 $query2='SELECT SUM(value) FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8805';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W10z=$mu[0];
	 if ($arr["otch"]==2) $W10z=$W10z/24; if ($arr["otch"]==1) $W10z=$W10z/(24*30);	 

	 $query2='SELECT SUM(value) FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8806';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W11z=$mu[0];
	 if ($arr["otch"]==2) $W11z=$W11z/24; if ($arr["otch"]==1) $W11z=$W11z/(24*30);	

	 $query2='SELECT SUM(value) FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8819';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Whlab=$mu[0];
	 if ($arr["otch"]==2) $Whlab=$Whlab/24; if ($arr["otch"]==1) $Whlab=$Whlab/(24*30);

	 if ($arr["otch"]==1) { $Wpk1=11.1*0.6 + 17.45*0.8 + 22.5*0.8 + 14.8*0.8 + 19*0.8 + 0.25*0.8; $W3zz=11.1*0.6; $W10zz=17.45*0.8; $W11zz=26*0.8; $Wproh=14.8*0.8; $Wnarosv=19*0.8; $Wnarea=0.25*0.8; }
	 if ($arr["otch"]==2) { $Wpk1=11.1*0.6*8 + 17.45*0.8*8 + 22.5*0.8*8 + 14.8*0.8*24 + 19*0.8*$t1 +0.25*0.8*24; $W3zz=11.1*0.6*8; $W10zz=17.45*0.8*8; $W11zz=26*0.8*8; $Wproh=14.8*0.8*24; $Wnarosv=19*0.8*$t1; $Wnarea=0.25*0.8*8; }
	 if ($arr["otch"]==4) { $Wpk1=21 * (11.1*0.6*8 + 17.45*0.8*8 + 22.5*0.8*8 + 14.8*0.8*24 +0.25*0.8*24)  + 19*0.8*$t1*31; $W3zz=11.1*0.6*8*21; $W10zz=17.45*0.8*8*21; $W11zz=26*0.8*8*21; $Wproh=14.8*0.8*24*31; $Wnarosv=19*0.8*$t1*31; $Wnarea=0.25*0.8*8*31; }
	 
 	 $Wrasch1=$W3z+$W10z+$W11z+$W3zz+$W10zz+$W11zz+$Whlab;
         fwrite ($fp,'Wрасч.1 = W3* + W3** + W10* + W10** + W11* + W11** + Wхим.лаб. + Wпрох + Wнр.осв + Wнр.освЭ-А ='.$Wrasch1.'<br>');
	 fwrite ($fp,'W3* - освещение на 2-м этаже корпуса 1(свободные площади ЧТП) = '.$W3z.'<br>');
	 fwrite ($fp,'W10* - силовые нагрузки на 2-м этаже (свободные площади ЧТП) = '.$W10z.'<br>');
	 fwrite ($fp,'W11* - расход по счетчику ОАСУП на 2-м этаже (кВт) = '.$W11z.'<br>');
	 fwrite ($fp,'W3** - расход на освещение 3 этаж (Т-Ю, ЭКО) = '.$W3zz.'<br>');
	 fwrite ($fp,'W10** - силовые нагрузки на 3-м этаже (Т-Ю, ЭКО) = '.$W10zz.'<br>');
	 fwrite ($fp,'W11** - силовые нагрузки на 3-м этаже - правое крыло (ЧТП) = '.$W11zz.'<br>');
	 fwrite ($fp,'Wпрох - расход энергии по проходной = '.$Wproh.'<br>');
	 fwrite ($fp,'Wхим.лаб. - хим. лаборатория = '.$Whlab.'<br>');
	 fwrite ($fp,'Wнар.осв.Э-А - освещение при погрузке вагонов = '.$Wnarea.'<br>');

	 $Wpk1=$Wrasch1+$Wproh+$Wnarosv+$Wnarea;

	 $Wp1tp=$Wp1-$Wpk1;
	 fwrite ($fp,'Wр1тп-101 ('.$Wp1tp.')=Wр1('.$Wp1.')-Wрасч.1('.$Wpk1.')<br>');

	 fwrite ($fp,'<br>От ТП-102 <br>');
	 // От ТП-102
	 // Wр2тп102 = W1_ру2 - WрЭ-А - Wк10 - Wскл. - расходы
	 // W1_ру2 1215 (Эл. энергия корпус 10&12) 
	 // WpЭ-А = Wр1 + Wр2 (к12 этаж1, W1a,ТП102 + к12,W2a,ТП-102)(0214+0212) 
	 // Wк10 = Эл. энергия корпус №10, W2a*, ТП102 (0217)
	 // расход цеха в корпусе №4 и модуле "Кисловодск", лит.цех корпус №5
	 // ТП 102(яч.1)акт
	 // ШУЭ-2(Цех-4)акт. ШУЭ-1(цех-4)акт. ШУЭ-3(Цех-4)акт.
	 // ТП 102 (Ф12 ООО <Литейка>)акт.
	 // ТП 102(Ф10 ООО <Литейка>)акт.
	 // ТП-102(Ф9 ООО <Литейка>)акт.
	 // ТП 102(Ф4 ООО <Литейка>)акт.

	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND (device=0214 OR device=0212)';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wpea=$mu[0];	 // WpЭ-А

	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0217';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wk10=$mu[0];	 // Wк10
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1211';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1py2=$mu[0]; // W1_ру2
	 $query2='SELECT SUM(value) FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8809';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wskl=$mu[0]; // Wскл
	 if ($arr["otch"]==2) $Wskl=$Wskl/24; if ($arr["otch"]==1) $Wskl=$Wskl/(24*30);
         $Wp2=$W1py2-$Wpea-$Wskl;

	 fwrite ($fp,'Wр2тп102 ('.$Wp2.')= W1_ру2('.$W1py2.') - WрЭ-А('.$Wpea.')-Wк10('.$Wk10.')-Wскл.(?)-Wрасх(?)<br>');
	 fwrite ($fp,'W1_ру2 - ТП-102, фидер 1 в РУ2 (ТП 102(яч.1)акт) = '.$W1py2.'<br>');
	 fwrite ($fp,'WрЭ-А - Wр1+Wр2 (Эл. энергия к12 этаж1, W1a,ТП102 + к12,W2a,ТП-102) = '.$Wpea.'<br>');
	 fwrite ($fp,'Wк10 - расход по корпусу 10 (ОАСУП,Юнит) (Эл. энергия корпус №10, W2a*, ТП102) = '.$Wk10.'<br>');
	 fwrite ($fp,'Wскл. - расход склада бумаги, спирта  = '.$Wskl.'<br>');
	 fwrite ($fp,'Wрасх - расход цеха 3 и 4 в корпусе4 и в модуле "Кисловодск" литейного цеха в корпусе 5 (?) = 0<br>');

	 fwrite ($fp,'<br>От КНТП-250<br>');
	 // От КНТП-250
	 // Wр3тп250 =7.1 * 0.9
	 if ($arr["otch"]==1) $Wp3=7.1*0.9;
	 if ($arr["otch"]==2) $Wp3=7.1*0.9*8;
	 if ($arr["otch"]==4) $Wp3=7.1*0.9*8*21;
	 fwrite ($fp,'Wр3тп102 = '.$Wp3.' - расход по ИТМ ГО<br>');

	 fwrite ($fp,'<br>От КНТП-5 (ТП-5)<br>');
	 // От КНТП-5 (ТП-5)
	 // Wр5 тп-5 = W10(ру2) - Wпроп - Wрасч.Страйк
	 // W10(ру2) = ТП 5(яч10)акт (1210)
	 // Wпроп = Wвент + Wсил1 + Wсил2 + Wосв - участок пропитки
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1210';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W10=$mu[0];

	 if ($arr["otch"]==1) $Wprop=20*0.8+25*0.5+6*0.5+1.1*0.8;
	 if ($arr["otch"]==2) $Wprop=20*0.8*8+25*0.5*9.2+6*0.5*24+1.1*0.8*8;
	 if ($arr["otch"]==4) $Wprop=21*(20*0.8*8+25*0.5*9.2+1.1*0.8*8)+6*0.5*24*30;
	 $Wp5=$W10-$Wprop;
	 fwrite ($fp,'Wр5 тп-5 ('.$Wp5.') = W10(ру2) ('.$W10.') - (Wпроп + Wрасч.Страйк) ('.$Wprop.')<br>');
	 fwrite ($fp,'W10(ру2) - расход КНТП-5, яч.10 РУ-2 = '.$W10.'<br>');
	 fwrite ($fp,'Wпроп - расход пропитка цеха 5 <br>');

	 // От КНТП-4
	 fwrite ($fp,'<br>От КНТП-4<br>');
	 // Wр4 тп-4 = W1 + W2 + Wрзу + Wр д-58 + Wосв. - Wцзл - Wуос
	 // ШУЭ-4(РМУ-6 ООО <Деталь>)акт. (1111)
	 // ШУЭ-5(РМУ-6 ООО <Деталь>) акт.(1112)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1111';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1112';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];
	 // $Wkntp4 = Wр д-58 - Wуос + Wосвещ
	 if ($arr["otch"]==1) $Wkntp4= 2.5*0.8-6.5+3.8*0.8+4.6*0.8;
	 if ($arr["otch"]==2) $Wkntp4= 2.5*0.8*8-6.5*8+3.8*0.8*15+4.6*0.8*8;
	 if ($arr["otch"]==4) $Wkntp4= 21*(2.5*0.8*8-6.5*8+3.8*0.8*15+4.6*0.8*8);
	 $Wp4=$W1+$W2+$Wkntp4;
	 fwrite ($fp,'Wр4 тп-4 ('.$Wp4.') = W1 ('.$W1.') + W2 ('.$W2.') + (Wрзу + Wр д-58 + Wосв. - Wцзл - Wуос) ('.$Wkntp4.')<br>');
	 fwrite ($fp,'W1 - показания РМУ-6 силовая нагрузка (ШУЭ-4(РМУ-6 ООО <Деталь>)акт.) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - показания РМУ-6 осветительная нагрузка (ШУЭ-5(РМУ-6 ООО <Деталь>)акт.) = '.$W2.'<br>');
	 fwrite ($fp,'Wрзу - ремонтно заготовительный участок <br>');
	 fwrite ($fp,'Wр д-58 - расход электроэнергии склада Д-58 <br>');
		 
	 // От ШР-1-19	 
	 fwrite ($fp,'<br>От ШР-1-19<br>');
	 if ($arr["otch"]==1) $Wd62=0.75*0.8;
	 if ($arr["otch"]==2) $Wd62=0.75*0.8*8;
	 if ($arr["otch"]==4) $Wd62=0.75*0.8*8*21;
	 fwrite ($fp,'WрД62='.$Wd62.' -  склад Д-62<br>');

	 $data0[$x][7]= $Wp1 + $Wp2 + $Wp3 + $Wp5 + $Wp4 + $Wd62;
	 fwrite ($fp,'<b>'.$dat[$x].'</b>'.' Wsum=<b>'.$data0[$x][7].'</b>='.$Wp1.' - '.$Wpk1.' + '.$Wp2.' + '.$Wp3.' + '.$Wp5.' + '.$Wp4.' + '.$Wd62.'<br>');
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==25)	// юнит
	{
	 // Wсум=Wкор1осв + Wкор1сил + Wпроп + Wц5 + Wскл. + W21 + W22 + Wпот.
	 // Wпроп=Wвент + Wсил + Wосв1 + Wосв2
	 if ($arr["otch"]==1) $Wk1=7.6*0.6+20*0.8+(20*0.8+25*0.5+6*0.5+1.1*0.8);
	 if ($arr["otch"]==2) $Wk1=7.6*0.6*8+20*0.8*8+(20*0.8*8+25*0.5*9.2+6*0.5*24+1.1*0.8);
	 if ($arr["otch"]==4) $Wk1=7.6*0.6*8*21+20*0.8*8*21+(20*0.8*8*30+25*0.5*8*9.2*21+6*0.5*24*30+1.1*0.8*8*21);
	 if ($arr["otch"]==1) { $Wkosv=7.6*0.6; $Wksil=20*0.8; $Wvent=20*0.8; $Wsil1=25*0.5; $Wsil2=6*0.5; $Wosv=1.1*0.8; }
	 if ($arr["otch"]==2) { $Wkosv=8*7.6*0.6; $Wksil=8*20*0.8; $Wvent=20*0.8*8; $Wsil1=25*0.5*9.2; $Wsil2=6*0.5*24; $Wosv=1.1*0.8*8; }
	 if ($arr["otch"]==4) { $Wkosv=7.6*0.6*8*21; $Wksil=20*0.8*8*21; $Wvent=20*0.8*8*21; $Wsil1=25*0.5*9.2*21; $Wsil2=6*0.5*24*31; $Wosv=1.1*0.8*8*21;}
	 $Wprop=$Wvent+$Wsil1+$Wsil2+$Wosv;
	 fwrite ($fp,'Wпроп('.$Wprop.')=Wвент('.$Wvent.') + Wсил1('.$Wsil1.') + Wсил2('.$Wsil2.') + Wосв('.$Wosv.')<br>');
	 fwrite ($fp,'Wвент - уст. вент х Ки х t х T, Р уст.вент=20 кВт,Ки=0,8 = '.$Wvent.'<br>');
	 fwrite ($fp,'Wсил1 - Руст1 х Ки х t х T,Руст1=25 кВт,Ки=0,5,t=9,2ч = '.$Wsil1.'<br>');
	 fwrite ($fp,'Wсил2 - Руст2 х Ки х t х T,Руст1=6 кВт,Ки=0,5,24ч = '.$Wsil2.'<br><br>');
	 fwrite ($fp,'Wосв  - Руст.осв х Ки х t хТ,Руст.осв=1,1,Ки=0,8 = '.$Wosv.'<br><br>');

	 // Wц5=W12 - Wстол - Wсум.рму6 - Wэ-а - Wнасос - Wчтп - Wк10 - Wрзу - Wосв.ц1 - Wтд - Wтепл
	 // ТП 4(яч.12)акт. (1209)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1209';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 // КНТП250(столовая подвал) акт.
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1116';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wk13=$mu[0];
	 // ШУЭ-4(РМУ-6 ООО <Деталь>)акт. (1111)
	 // ШУЭ-5(РМУ-6 ООО <Деталь>) акт.(1112)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1111';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wrmu1=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1112';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wrmu2=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1216';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wnas=$mu[0];
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1209';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 $query2='SELECT value FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8812';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wf17=$mu[0];
	 $query2='SELECT value FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8813';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wf7=$mu[0];
	 $query2='SELECT value FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8810';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wrzu=$mu[0];
	 // W21 Эл. энергия Юнит, W21, ТП101 (0131)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0131';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W21=$mu[0];
	 // W22 Эл. энергия Юнит,W22, ТП101 (0132)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0132';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W22=$mu[0];

	 if ($arr["otch"]==1) $Wrd58=2.5*0.8;
	 if ($arr["otch"]==2) $Wrd58=2.5*0.8*8;
	 if ($arr["otch"]==4) $Wrd58=2.5*0.8*8*21;
	 $Wrmu=$Wrmu1+$Wrmu2+$Wrd58;
	 fwrite ($fp,'Wсум.РМУ6('.$Wrmu.')=W1('.$Wrmu1.')+W2('.$Wrmu2.')+Wр Д58('.$Wrd58.')<br>');
	 fwrite ($fp,'W1 - показания счетчика РМУ-6 силовая нагрузка (ШУЭ-4(РМУ-6 ООО <Деталь>) акт.) = '.$Wrmu1.'<br>');
	 fwrite ($fp,'W2 - показания счетчика РМУ-6 осветительная нагрузка (ШУЭ-5(РМУ-6 ООО <Деталь>) акт.) = '.$Wrmu2.'<br>');
	 fwrite ($fp,'Wр Д58 = '.$Wrd58.'<br><br>');

	 // Wc5 = Wчтп + Wскл. + Wосв.ц1 + Wтд + Wтепл
	 if ($arr["otch"]==1) $Wcc5=35*0.8+2.5*0.5+3.8*0.8+4.6*0.8+25*0.8;
	 if ($arr["otch"]==2) $Wcc5=(35*0.8+2.5*0.5+4.6*0.8+25*0.8)*8+3.8*0.8*15;
	 if ($arr["otch"]==4) $Wcc5=((35*0.8+2.5*0.5+4.6*0.8+25*0.8)*8+3.8*0.8*15)*21;

	 // Wтепл только в период отопительного сезона
	 if ($today[mon]>9 && $today[mon]<6)
	    {
	     if ($arr["otch"]==1) $Wtpl=5*0.5;
	     if ($arr["otch"]==2) $Wtpl=(5*0.5)*8;
	     if ($arr["otch"]==4) $Wtpl=((5*0.5)*8)*21;
	    }

	 // Wскл	 
	 if ($arr["otch"]==1) $Wskl=2.5*0.5;
	 if ($arr["otch"]==2) $Wskl=(2.5*0.5)*8;
	 if ($arr["otch"]==4) $Wskl=(2.5*0.5)*8*21;

	 $Wk10=0;
	 $Wea=$Wf17+$Wf7;
	 fwrite ($fp,'Wэ-а('.$Wea.') = Wф17('.$Wf17.')+Wф7('.$Wf7.')<br>');
	 fwrite ($fp,'Wф17 - расход по счетчику "Э-А" 1эт. ф17 (ТП-4) = '.$Wf17.'<br>');
	 fwrite ($fp,'Wф7  - расход по счетчику "Э-А" 1эт. ф7 (ТП-4)  = '.$Wf7.'<br><br>');
	 
	 $Wcc5=$Wcc5+$Wskl+$Wtpl;
	 $Wc5=$W12-$Wk13-$Wrmu-$Wea-$Wnas-$Wk10-$Wrzu-$Wcc5;

	 fwrite ($fp,'Wц5('.$Wc5.') = W12(РУ-2)('.$W12.')-Wстол('.$Wk13.')-Wсум.рму6('.$Wrmu.')-Wэ-а('.$Wea.')-Wнасос('.$Wnas.')-Wк10('.$Wk10.')-Wрзу('.$Wrzu.') - (Wчтп + Wосв.ц1 + Wтд + Wтепл)('.$Wcc5.')<br>');
	 fwrite ($fp,'W12(РУ-2) - расход по счетчику в РУ-2 Ф12(ТП-4) = '.$W12.'<br>');
	 fwrite ($fp,'Wстол - расход по счетчику в подвале столовой = '.$Wk13.'<br>');
	 fwrite ($fp,'Wсум.рму = '.$Wrmu.'<br>');
	 fwrite ($fp,'Wчтп + Wосв.ц1 + Wтд + Wтепл = '.$Wcc5.'<br>');
	 fwrite ($fp,'Wнас - насосная (ТП-4) = '.$Wnas.'<br>');
	 fwrite ($fp,'Wэ-а - расход Э-А по счетчикам (ТП-4) = '.$Wf7.'+'.$Wf17.'<br>');
	 fwrite ($fp,'Wк10 - проливочный стенд (?)<br>');
	 fwrite ($fp,'Wнасос - насосная (ТП-4) = '.$Wnas.'<br>');
	 fwrite ($fp,'Wрзу - ремонтно-заготовительный уч-к = '.$Wrzu.'<br><br>');

	 fwrite ($fp,'Wсум=Wкорп1.осв('.$Wkosv.')+Wкорп1.сил('.$Wksil.')+Wпроп('.$Wprop.')+Wц5('.$Wc5.')+Wскл.('.$Wskl.')+W21('.$W21.')+W22('.$W22.')<br>');
	 fwrite ($fp,'Wкорп1.осв - осветительная нагрузка корпус1 = '.$Wkosv.'<br>');
	 fwrite ($fp,'Wкорп1.сил - силовая нагрузка корпус1 = '.$Wksil.'<br>');
	 fwrite ($fp,'Wпроп - участок лакировки и покраски (Wвент+Wсил1+Wсил2+Wосв) = '.$Wprop.'<br>');
	 fwrite ($fp,'Wskl - расход энергии склада тары,спирта = '.$Wskl.'<br>');
	 fwrite ($fp,'W21 - расход уч-ка 17 по счетчику ф21 (Эл. энергия Юнит, W21, ТП101) = '.$W21.'<br>');
	 fwrite ($fp,'W22 - расход уч-ка 17 по счетчику ф22 (Эл. энергия Юнит, W22, ТП101) = '.$W22.'<br><br>');

	 $data0[$x][7]=$Wk1+$Wc5+$Wskl+$W21+$W22;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==26)	// сенсор
	{
	 // Wсум=W15 + W19 - Wтеле - Wэ-а - Wотк-чтп - Wд62 - Wнар.осв.
	 // W15 Эл. энергия, Корпус 6, W15, ТП101 (0127)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0127';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W15=$mu[0];
	 // W19 Эл. энергия Сенсор, W19, ТП101 (0113)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0113';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W19=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8814';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wtele2=$mu[0];	 
	 // $Wtea = $Wэ-а + $Wотк + $Wрд62 + $Wосв
	 if ($arr["otch"]==1) $Wtea=(16.9+10.1+4.23)+0.5;
	 if ($arr["otch"]==2) $Wtea=(16.9+10.1+4.23)*8+0.5*15.9;
	 if ($arr["otch"]==4) $Wtea=(16.9+10.1+4.23)*8*21+0.5*15.9*30;	 

	 fwrite ($fp,'Wсум=W15('.$W15.')+W19('.$W19.')-Wтеле('.$Wtele.')-(Wтэа+Wотк-чтп.+Wд62+Wнар.осв.)('.$Wtea.')<br>');
	 fwrite ($fp,'W15 - расход по сч. ф15 ТП-101 (W15 Эл. энергия, Корпус 6, W15, ТП101) = '.$Wkosv.'<br>');
	 fwrite ($fp,'W19 - расход по сч. ф19 ТП-101 (W19 Эл. энергия Сенсор, W19, ТП101) = '.$Wksil.'<br>');
	 fwrite ($fp,'Wтеле2 - расход по вышке Теле-2 '.$Wtele2.'<br>');
	 fwrite ($fp,'Wтэа - расход энергии оборудования Э-А = '.$Wtea.'<br>');
	 fwrite ($fp,'Wотк-чтп - расход энергии ОТК <br>');
	 fwrite ($fp,'WрД62 - расход энергии склада Д-62 <br>');
	 fwrite ($fp,'Wнар.осв. - расход на наружное освещение <br><br>');
	 $data0[$x][7]=$W15+$W19-$Wtele2-$Wtea;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==24)	// экспресс-анализ
	{
	 // Wр = W1 + W2 + W3 + W4 + W5 + Wприт + Wэа
	 // Эл. энергия корпус №12, W 2a, ТП-102 (0214)
	 // Эл. энергия корпус №12 этаж1, W1a, ТП102 (0212)
	 // Эл. энергия корпус №12 этаж1, W1a, КНТП4 (0211)
	 // Эл. энергия корпус №12, этаж2, W2a, КНТП-4 (0213)
	 // Эл. энергия корпус №12, эл. котёл W24a, ТП-101 (0215)
	 // W1t5 = W1 + W2 + W3 + W4 + W5
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0211';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0212';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0213';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0214';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0215';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W5=$mu[0];	 

	 //$query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8814';
	 //$mt = mysql_query ($query2,$i);
	 //if ($mt) $mu = mysql_fetch_row ($mt);
	 //if ($mu == true) $W1=$mu[0];	 

         $W1t5=$W1+$W2+$W3+$W4+$W5;

	 // Wприт + Wэа
	 if ($arr["otch"]==1) { $Wprt=17.5*0.8; $Wtea=16.9; }
	 if ($arr["otch"]==2) { $Wprt=(17.5*0.8)*8; $Wtea=16.9*8; }
	 if ($arr["otch"]==4) { $Wprt=(17.5*0.8)*8*21; $Wtea=16.9*8*21;}

	 fwrite ($fp,'Wсум=W1('.$W1.')+W2('.$W2.')+W3('.$W3.')+W4('.$W4.')+W5('.$W5.')+Wприт.('.$Wprt.')+Wэ-а('.$Wtea.')<br>');
	 fwrite ($fp,'W1 - расход энергии (Эл. энергия корпус №12, W 2a, ТП-102) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - расход энергии (Эл. энергия корпус №12 этаж1, W1a, ТП102) = '.$W2.'<br>');
	 fwrite ($fp,'W3 - расход энергии (Эл. энергия корпус №12 этаж1, W1a, КНТП4) '.$W3.'<br>');
	 fwrite ($fp,'W4 - расход энергии (Эл. энергия корпус №12, этаж2, W2a, КНТП-4) '.$W4.'<br>');
	 fwrite ($fp,'W5 - расход энергии (Эл. энергия корпус №12, эл. котёл W24a, ТП-101) '.$W5.'<br>');
	 fwrite ($fp,'Wприт. - расход при работе приточной камеры = '.$Wprt.'<br>');
	 fwrite ($fp,'Wтэа - расход энергии оборудования Э-А = '.$Wtea.'<br><br>');
	 
	 $data0[$x][7]=$W1t5+$Wprt;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==23)	// гео-мастер
	{
	 // Wр = W1 + W2
	 // W1 Эл. энергия Гео-Мастер, W9, ТП101 (0122)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0122';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // W2 расход энергии в корпусе пенополистирольной тары
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8815';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 

	 fwrite ($fp,'Wсум=W1('.$W1.')+W2('.$W2.')<br>');
	 fwrite ($fp,'W1 - расход энергии (W1 Эл. энергия Гео-Мастер, W9, ТП101) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - расход энергии в корпусе пенополистирольной тары = '.$W2.'<br>');
	 $data0[$x][7]=$W1+$W2;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==27)	// ЭлВенСа-Сервис
	{
	 // Wр = W1 + W2 + W3
	 // Эл. энергия W13, ТП101 (0128) принадлежит к корпусу №21
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0128';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // W2,W3 у потребителя (я не знаю)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8816';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8817';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 

	 fwrite ($fp,'Wсум=W1('.$W1.')+W2('.$W2.')+W3('.$W3.')<br>');
	 fwrite ($fp,'W1 - расход энергии (Эл. энергия W13, ТП101) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - расход энергии Элвенса-Сервис = '.$W2.'<br>');
	 fwrite ($fp,'W3 - расход энергии Элвенса-Сервис = '.$W3.'<br>');
	 $data0[$x][7]=$W1+$W2+$W3;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==38)	// ЭлВенСа-Сервис
	{
	 // Wр = W1 (по счетчику) есть только один счетчик в корпусе №9
	 // Эл. энергия корпус №9, W14, ТП101 (0126) принадлежит к корпусу №9
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8818';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 

	 fwrite ($fp,'Wсум=W1('.$W1.')<br>');
	 fwrite ($fp,'W1 - расход энергии Сервис-Транс = '.$W1.'<br>');
	 $data0[$x][7]=$W1;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==29)	// ЧЗСМ
	{
	 // ЧЗСМ(яч.2)акт
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1201';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // ЧЗСМ(яч.2)реак.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1202';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 // ЧЗСМ(яч-15)акт
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1203';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 
	 // ЧЗСМ(яч-15)реак.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1204';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];	 

	 fwrite ($fp,'Wсум=W1('.$W1.')+W3('.$W3.')<br>');
	 fwrite ($fp,'W1 - показания счетчика на выходе (ЧЗСМ(яч.2)акт) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - показания счетчика на выходе (ЧЗСМ(яч.2)реак.) = '.$W2.'<br>');
	 fwrite ($fp,'W3 - показания счетчика на выходе (ЧЗСМ(яч-15)акт) = '.$W3.'<br>');
	 fwrite ($fp,'W4 - показания счетчика на выходе (ЧЗСМ(яч-15)реак.) = '.$W4.'<br>');
	 $data0[$x][7]=$W1+W3;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==28)	// ЧТКЗ
	{
	 // ТКР(яч.11)акт.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1207';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // ТКР(яч.11)реак.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1208';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 // ТКР(яч.6)акт.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1205';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 
	 // ТКР(яч.6)реак.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1206';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];	 

	 fwrite ($fp,'Wсум=W1('.$W1.')+W3('.$W3.')<br>');
	 fwrite ($fp,'W1 - показания счетчика на выходе (ТКР(яч.11)акт.) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - показания счетчика на выходе (ТКР(яч.11)реак.) = '.$W2.'<br>');
	 fwrite ($fp,'W3 - показания счетчика на выходе (ТКР(яч.6)акт.) = '.$W3.'<br>');
	 fwrite ($fp,'W4 - показания счетчика на выходе (ТКР(яч.6)реак.) = '.$W4.'<br>');
	 $data0[$x][7]=$W1+W3;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==34)	// Храм
	{
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1214';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 

	 fwrite ($fp,'Wсум=W1('.$W1.')<br>');
	 fwrite ($fp,'W1 - расход энергии на входе в Храм (Храм) = '.$W1.'<br>');
	 $data0[$x][7]=$W1;
	}
 // Wпот = Wрасч * ((Wф14-13+Wф14-31)-(Wф14-13+Wф14-31))/(Wф14-13+Wф14-31)
 // Wсум = Wпот + Wсум
 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8801';
 $mt = mysql_query ($query2,$i); 
 if ($mt) $mu = mysql_fetch_row ($mt);
 if ($mu == true) $W1413=$mu[0];
 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8802';
 $mt = mysql_query ($query2,$i); 
 if ($mt) $mu = mysql_fetch_row ($mt);
 if ($mu == true) $W1431=$mu[0];
 if ($arr["otch"]==2) 
    {   $W1413=$W1413/30; $W1431=$W1431/30;     }
 if ($arr["otch"]==1) 
    {   $W1413=$W1413/(24*30); $W1431=$W1431/(24*30);     }

 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1401';
 $mt = mysql_query ($query2,$i); 
 if ($mt) $mu = mysql_fetch_row ($mt);
 if ($mu == true) $W1431c=$mu[0];
 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1301';
 $mt = mysql_query ($query2,$i); 
 if ($mt) $mu = mysql_fetch_row ($mt);
 if ($mu == true) $W1413c=$mu[0];
 if ($arr["otch"]==2) 
    {   $W1413c=$W1413c/24; $W1431c=$W1431c/24;     }
 if ($arr["otch"]==1) 
    {   $W1413c=$W1413c/(24*30); $W1431c=$W1431c/(24*30);     }
 if ($W1413+$W1431>0) $Wpot=(($W1413+$W1431)-($W1413c+$W1431c))/($W1413+$W1431); // $Wpot
 else $Wpot=0;

 fwrite ($fp,'Wсум=Wрасч('.$data0[$x][7].')+Wпот('.$data0[$x][7]*$Wpot.')<br>');
 fwrite ($fp,'Wpot = ((W1413+W1431)-(W1413c+W1431c))/(W1413+W1431) * Wрасч<br>');
 fwrite ($fp,'W1413 - показания счетчика №13 ГПП14 (Мечел) = '.$W1413.'<br>');
 fwrite ($fp,'W1431 - показания счетчика №31 ГПП14 (Мечел) = '.$W1431.'<br>');
 fwrite ($fp,'W1413c - показания счетчика №13 ЧТП (Ввод 1 (Ф14-13) акт.(п)) = '.$W1413c.'<br>');
 fwrite ($fp,'W1431c - показания счетчика №31 ЧТП (Ввод-2(Ф14-31)акт.(п)) = '.$W1431c.'<br>');

 $data0[$x][7]=$data0[$x][7]*$Wpot+$data0[$x][7];
 fwrite ($fp,'<b>'.$dat[$x].'</b>'.' Wсум=<b>'.$data0[$x][7].'</b><br>');
 $k=1000; // не надо по корпусам
}
?>