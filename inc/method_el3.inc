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
	 // W4 + W5 + W8 + W16 + W3 + W10 + W11 + W6 + W12 + W23
	 // нет W23 (счетчик ф23)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0115';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0116';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W5=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0121';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W8=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0125';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W16=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0114';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0123';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W10=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0124';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W11=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1102';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W6=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1103';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8803';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W23=$mu[0];
	 if ($arr["otch"]==2) $W23=$W23/24; if ($arr["otch"]==4) $W23=$W23/(24*30);	 

	 $Wp1=$W4 + $W5 + $W8 + $W16 + $W3 + $W10 + $W11 + $W6 + $W12 + $W23;

	 // нет W3* (освещение на 2-ом этаже корпуса №1)(свободные площади)
	 // нет W10* (силовые нагрузки 2-ом этаже корпуса №1)(свободные площади)
	 // нет W11* (счетчик ОАСУП 2-ом этаже корпуса №1)
	 // Wхим.лаб отсутствует в методике
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8804';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3z=$mu[0];
	 if ($arr["otch"]==2) $W3z=$W3z/24; if ($arr["otch"]==4) $W3z=$W3z/(24*30);

	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8805';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W10z=$mu[0];
	 if ($arr["otch"]==2) $W10z=$W10z/24; if ($arr["otch"]==4) $W10z=$W10z/(24*30);	 

	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8806';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W11z=$mu[0];
	 if ($arr["otch"]==2) $W11z=$W11z/24; if ($arr["otch"]==4) $W11z=$W11z/(24*30);	

	 if ($arr["otch"]==1) $Wpk1=11.1*0.6 + 17.45*0.8 + 22.5*0.8 + 14.8*0.8 + 19*0.8 + 0.25*0.8;
	 if ($arr["otch"]==2) $Wpk1=11.1*0.6*8 + 17.45*0.8*8 + 22.5*0.8*8 + 14.8*0.8*24 + 19*0.8*$t1 +0.25*0.8*24;
	 if ($arr["otch"]==4) $Wpk1=21 * (11.1*0.6*8 + 17.45*0.8*8 + 22.5*0.8*8 + 14.8*0.8*24 + 19*0.8*$t1 +0.25*0.8*24);
	 $Wpk1=$Wpk1+$W3z+$W10z+$W11z;

	 $Wp1tp=$Wp1-$Wpk1;
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
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8809';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wskl=$mu[0]; // Wскл
	 if ($arr["otch"]==2) $Wskl=$Wskl/24; if ($arr["otch"]==4) $Wskl=$Wskl/(24*30);
         $Wp2=$W1py2-$Wpea-$Wskl;
	 // От КНТП-250
	 // Wр3тп250 =7.1 * 0.9
	 if ($arr["otch"]==1) $Wp3=7.1*0.9;
	 if ($arr["otch"]==2) $Wp3=7.1*0.9*8;
	 if ($arr["otch"]==4) $Wp3=7.1*0.9*8*21;
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

	 // От КНТП-4
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
		 
	 // От ШР-1-19	 
	 if ($arr["otch"]==1) $Wd62=0.75*0.8;
	 if ($arr["otch"]==2) $Wd62=0.75*0.8*8;
	 if ($arr["otch"]==4) $Wd62=0.75*0.8*8*21;
	 $data0[$x]= $Wp1 + $Wp2 + $Wp3 + $Wp5 + $Wp4 + $Wd62;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==25)	// юнит
	{
	 // Wсум=Wкор1осв + Wкор1сил + Wпроп + Wц5 + Wскл. + W21 + W22 + Wпот.
	 // Wпроп=Wвент + Wсил + Wосв1 + Wосв2
	 if ($arr["otch"]==1) $Wk1=7.6*0.6+20*0.8+(20*0.8+25*0.5+6*0.5+1.1*0.8);
	 if ($arr["otch"]==2) $Wk1=7.6*0.6*8+20*0.8*8+(20*0.8*8+25*0.5*9.2+6*0.5*24+1.1*0.8);
	 if ($arr["otch"]==4) $Wk1=7.6*0.6*8*21+20*0.8*8*21+(20*0.8*8*30+25*0.5*8*9.2*21+6*0.5*24*30+1.1*0.8*8*21);
	 if ($arr["otch"]==1) { $Wprop=(20*0.8+25*0.5+6*0.5+1.1*0.8); $Wkosv=7.6*0.6; $Wksil=20*0.8;}
	 if ($arr["otch"]==2) { $Wprop=(20*0.8*8+25*0.5*9.2+6*0.5*24+1.1*0.8); $Wkosv=8*7.6*0.6; $Wksil=8*20*0.8;}
	 if ($arr["otch"]==4) { $Wprop=(20*0.8*8*30+25*0.5*8*9.2*21+6*0.5*24*30+1.1*0.8*8*21); $Wkosv=7.6*0.6*8*21; $Wksil=20*0.8*8*21;}

	 // Wц5=W12 - Wстол - Wсум.рму6 - Wэ-а - Wнасос - Wчтп - Wк10 - Wрзу - Wосв.ц1 - Wтд - Wтепл
	 // ТП 4(яч.12)акт. (1209)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1209';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 // КНТП250(столовая подвал) акт.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1116';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wk13=$mu[0];
	 // ШУЭ-4(РМУ-6 ООО <Деталь>)акт. (1111)
	 // ШУЭ-5(РМУ-6 ООО <Деталь>) акт.(1112)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1111';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wrmu1=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1112';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wrmu2=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1216';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wnas=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1209';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8812';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wf17=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8813';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wf7=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8810';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wrzu=$mu[0];
	 // W21 Эл. энергия Юнит, W21, ТП101 (0131)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0131';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W21=$mu[0];
	 // W22 Эл. энергия Юнит,W22, ТП101 (0132)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0132';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W22=$mu[0];

	 if ($arr["otch"]==1) $Wrd58=2.5*0.8;
	 if ($arr["otch"]==2) $Wrd58=2.5*0.8*8;
	 if ($arr["otch"]==4) $Wrd58=2.5*0.8*8*21;
	 $Wrmu=$Wrmu1+$Wrmu2+$Wrd58;

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
	 
	 $Wcc5=$Wcc5+$Wskl+$Wtpl;
	 $Wc5=$W12-$Wk13-$Wrmu-$Wea-$Wnas-$Wk10-$Wrzu-$Wcc5;

	 $data0[$x]=$Wk1+$Wc5+$Wskl+$W21+$W22;
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
	 $data0[$x]=$W15+$W19-$Wtele2-$Wtea;
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
	 $data0[$x]=$W1t5+$Wprt;
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
	 $data0[$x]=$W1+$W2;
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
	 $data0[$x]=$W1+$W2+$W3;
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

	 $data0[$x]=$W1;
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

 $data0[$x]=$data0[$x]*$Wpot+$data0[$x];
 $k=1000; // не надо по корпусам
}
?>