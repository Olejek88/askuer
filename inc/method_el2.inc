<?php
if ($source==8)
{
    $query2='';         // ������
    $today=getdate ();  // ������� �����
    $period=0; 		// ����� ����
    if ($today[mon]==12 || $today[mon]==1  || $today[mon]==2)  { $period=1; $t1=15.9; }
    if ($today[mon]==3  || $today[mon]==4  || $today[mon]==5)  { $period=2; $t1=9.9; }
    if ($today[mon]==6  || $today[mon]==7  || $today[mon]==8)  { $period=3; $t1=7.8; }
    if ($today[mon]==9  || $today[mon]==10 || $today[mon]==11) { $period=4; $t1=13.7; }

    if ($arr["otch"]==1) $datts='date='.$year.$month.$day.'0'.$tm.'0000';
    if ($arr["otch"]==2) $datts='(date='.$year.$month.$day.'000000 OR date='.$year.$month.$day.'120000)';
    if ($arr["otch"]==4) $datts='(date='.$year.$month.'01000000 OR date='.$year.$month.'01120000)';
    
    $Wp1=0; $Wp2=0; $Wp3=0; $Wp5=0; $Wp4=0; $Wd62=0;
    // �������� �������, ��������� �������� ���� ������ ���������
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==19)	// ������
	{
	 // W����=W�1��101 + W�2��102 + W�3����250 + W�4��4 + W�5��5 + W��62
               // W�1��101 = -W����.1 - W���� -W��.��� - W��.����-� + W4 + W5 + W8 + W16 + W3 + W10 + W11 + W6 + W12 + W23
             	     //       W����.1 = W3* + W3** + W10* + W10** + W11* + W11** + W���.���.
	                  // W�2��102 = W1_��2 - W��-� - W�10 - W���. - ������
	 // �� ��-101
	 fwrite ($fp,"<br>�� ��-101 <br>");
	 // W4 + W5 + W8 + W16 + W3 + W10 + W11 + W6 + W12 + W23
	 // ��� W23 (������� �23)
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
	 fwrite ($fp,'W�1=W4('.$W4.')+W5('.$W5.')+W8('.$W8.')+W16('.$W16.')+W3('.$W3.')+W10('.$W10.')+W11('.$W11.')+W6('.$W6.')+W12('.$W12.')+W23(?)'.'<br>');
	 fwrite ($fp,'W4 - ��������� �������� �4 ������6 (��. ������� ������, W4, ��101) = '.$W4.'<br>');
	 fwrite ($fp,'W5 - ��������� �������� �5 ������6 (��. ������� ������, W5, ��101) = '.$W5.'<br>');
	 fwrite ($fp,'W8 - ������� �������� ����. ��������� ����14 (��. ������� W8, ��101) = '.$W8.'<br>');
	 fwrite ($fp,'W16 - ������� �������� ��������� ��� ����14  (��. ������� ������ �1, W16, ��101) = '.$W16.'<br>');
	 fwrite ($fp,'W3 - ��������� �������� �� �3 (��. �������, W3, ��101) = '.$W3.'<br>');
	 fwrite ($fp,'W10 - ��������� �������� �10 ���� 14 (��. ������� ������ �1, W10, ��101) = '.$W10.'<br>');
	 fwrite ($fp,'W11 - ��������� �������� �11 ������6 (��. ������� ������ �1, W11, ��101) = '.$W11.'<br>');
	 fwrite ($fp,'W6 - ��������� �������� �6 �������� (�� 101(�6 ��� <�������>)���.) = '.$W6.'<br>');
	 fwrite ($fp,'W12 - ��������� �������� �12 (�� 101(� 12 ��� <�������>)���.) = '.$W12.'<br>');
	 fwrite ($fp,'W23 - ��������� �������� �23 (�23 ��������� ��.�������� �23) = '.$W23.'<br>');
	 fwrite ($fp,'W���.���. - �������� ��������� = '.$Wnarosv.'<br>');

	 // ��� W3* (��������� �� 2-�� ����� ������� �1)(��������� �������)
	 // ��� W10* (������� �������� 2-�� ����� ������� �1)(��������� �������)
	 // ��� W11* (������� ����� 2-�� ����� ������� �1)
	 // W���.��� ����������� � ��������
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
         fwrite ($fp,'W����.1 = W3* + W3** + W10* + W10** + W11* + W11** + W���.���. + W���� + W��.��� + W��.����-� ='.$Wrasch1.'<br>');
	 fwrite ($fp,'W3* - ��������� �� 2-� ����� ������� 1(��������� ������� ���) = '.$W3z.'<br>');
	 fwrite ($fp,'W10* - ������� �������� �� 2-� ����� (��������� ������� ���) = '.$W10z.'<br>');
	 fwrite ($fp,'W11* - ������ �� �������� ����� �� 2-� ����� (���) = '.$W11z.'<br>');
	 fwrite ($fp,'W3** - ������ �� ��������� 3 ���� (�-�, ���) = '.$W3zz.'<br>');
	 fwrite ($fp,'W10** - ������� �������� �� 3-� ����� (�-�, ���) = '.$W10zz.'<br>');
	 fwrite ($fp,'W11** - ������� �������� �� 3-� ����� - ������ ����� (���) = '.$W11zz.'<br>');
	 fwrite ($fp,'W���� - ������ ������� �� ��������� = '.$Wproh.'<br>');
	 fwrite ($fp,'W���.���. - ���. ����������� = '.$Whlab.'<br>');
	 fwrite ($fp,'W���.���.�-� - ��������� ��� �������� ������� = '.$Wnarea.'<br>');

	 $Wpk1=$Wrasch1+$Wproh+$Wnarosv+$Wnarea;

	 $Wp1tp=$Wp1-$Wpk1;
	 fwrite ($fp,'W�1��-101 ('.$Wp1tp.')=W�1('.$Wp1.')-W����.1('.$Wpk1.')<br>');

	 fwrite ($fp,'<br>�� ��-102 <br>');
	 // �� ��-102
	 // W�2��102 = W1_��2 - W��-� - W�10 - W���. - �������
	 // W1_��2 1215 (��. ������� ������ 10&12) 
	 // Wp�-� = W�1 + W�2 (�12 ����1, W1a,��102 + �12,W2a,��-102)(0214+0212) 
	 // W�10 = ��. ������� ������ �10, W2a*, ��102 (0217)
	 // ������ ���� � ������� �4 � ������ "����������", ���.��� ������ �5
	 // �� 102(��.1)���
	 // ���-2(���-4)���. ���-1(���-4)���. ���-3(���-4)���.
	 // �� 102 (�12 ��� <�������>)���.
	 // �� 102(�10 ��� <�������>)���.
	 // ��-102(�9 ��� <�������>)���.
	 // �� 102(�4 ��� <�������>)���.

	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND (device=0214 OR device=0212)';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wpea=$mu[0];	 // Wp�-�

	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0217';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wk10=$mu[0];	 // W�10
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1211';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1py2=$mu[0]; // W1_��2
	 $query2='SELECT SUM(value) FROM data WHERE type=4 AND '.$datts.' AND source='.$sour.' AND device=8809';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wskl=$mu[0]; // W���
	 if ($arr["otch"]==2) $Wskl=$Wskl/24; if ($arr["otch"]==1) $Wskl=$Wskl/(24*30);
         $Wp2=$W1py2-$Wpea-$Wskl;

	 fwrite ($fp,'W�2��102 ('.$Wp2.')= W1_��2('.$W1py2.') - W��-�('.$Wpea.')-W�10('.$Wk10.')-W���.(?)-W����(?)<br>');
	 fwrite ($fp,'W1_��2 - ��-102, ����� 1 � ��2 (�� 102(��.1)���) = '.$W1py2.'<br>');
	 fwrite ($fp,'W��-� - W�1+W�2 (��. ������� �12 ����1, W1a,��102 + �12,W2a,��-102) = '.$Wpea.'<br>');
	 fwrite ($fp,'W�10 - ������ �� ������� 10 (�����,����) (��. ������� ������ �10, W2a*, ��102) = '.$Wk10.'<br>');
	 fwrite ($fp,'W���. - ������ ������ ������, ������  = '.$Wskl.'<br>');
	 fwrite ($fp,'W���� - ������ ���� 3 � 4 � �������4 � � ������ "����������" ��������� ���� � ������� 5 (?) = 0<br>');

	 fwrite ($fp,'<br>�� ����-250<br>');
	 // �� ����-250
	 // W�3��250 =7.1 * 0.9
	 if ($arr["otch"]==1) $Wp3=7.1*0.9;
	 if ($arr["otch"]==2) $Wp3=7.1*0.9*8;
	 if ($arr["otch"]==4) $Wp3=7.1*0.9*8*21;
	 fwrite ($fp,'W�3��102 = '.$Wp3.' - ������ �� ��� ��<br>');

	 fwrite ($fp,'<br>�� ����-5 (��-5)<br>');
	 // �� ����-5 (��-5)
	 // W�5 ��-5 = W10(��2) - W���� - W����.������
	 // W10(��2) = �� 5(��10)��� (1210)
	 // W���� = W���� + W���1 + W���2 + W��� - ������� ��������
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1210';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W10=$mu[0];

	 if ($arr["otch"]==1) $Wprop=20*0.8+25*0.5+6*0.5+1.1*0.8;
	 if ($arr["otch"]==2) $Wprop=20*0.8*8+25*0.5*9.2+6*0.5*24+1.1*0.8*8;
	 if ($arr["otch"]==4) $Wprop=21*(20*0.8*8+25*0.5*9.2+1.1*0.8*8)+6*0.5*24*30;
	 $Wp5=$W10-$Wprop;
	 fwrite ($fp,'W�5 ��-5 ('.$Wp5.') = W10(��2) ('.$W10.') - (W���� + W����.������) ('.$Wprop.')<br>');
	 fwrite ($fp,'W10(��2) - ������ ����-5, ��.10 ��-2 = '.$W10.'<br>');
	 fwrite ($fp,'W���� - ������ �������� ���� 5 <br>');

	 // �� ����-4
	 fwrite ($fp,'<br>�� ����-4<br>');
	 // W�4 ��-4 = W1 + W2 + W��� + W� �-58 + W���. - W��� - W���
	 // ���-4(���-6 ��� <������>)���. (1111)
	 // ���-5(���-6 ��� <������>) ���.(1112)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1111';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1112';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];
	 // $Wkntp4 = W� �-58 - W��� + W�����
	 if ($arr["otch"]==1) $Wkntp4= 2.5*0.8-6.5+3.8*0.8+4.6*0.8;
	 if ($arr["otch"]==2) $Wkntp4= 2.5*0.8*8-6.5*8+3.8*0.8*15+4.6*0.8*8;
	 if ($arr["otch"]==4) $Wkntp4= 21*(2.5*0.8*8-6.5*8+3.8*0.8*15+4.6*0.8*8);
	 $Wp4=$W1+$W2+$Wkntp4;
	 fwrite ($fp,'W�4 ��-4 ('.$Wp4.') = W1 ('.$W1.') + W2 ('.$W2.') + (W��� + W� �-58 + W���. - W��� - W���) ('.$Wkntp4.')<br>');
	 fwrite ($fp,'W1 - ��������� ���-6 ������� �������� (���-4(���-6 ��� <������>)���.) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - ��������� ���-6 ������������� �������� (���-5(���-6 ��� <������>)���.) = '.$W2.'<br>');
	 fwrite ($fp,'W��� - �������� ��������������� ������� <br>');
	 fwrite ($fp,'W� �-58 - ������ �������������� ������ �-58 <br>');
		 
	 // �� ��-1-19	 
	 fwrite ($fp,'<br>�� ��-1-19<br>');
	 if ($arr["otch"]==1) $Wd62=0.75*0.8;
	 if ($arr["otch"]==2) $Wd62=0.75*0.8*8;
	 if ($arr["otch"]==4) $Wd62=0.75*0.8*8*21;
	 fwrite ($fp,'W��62='.$Wd62.' -  ����� �-62<br>');

	 $data0[$x][7]= $Wp1 + $Wp2 + $Wp3 + $Wp5 + $Wp4 + $Wd62;
	 fwrite ($fp,'<b>'.$dat[$x].'</b>'.' Wsum=<b>'.$data0[$x][7].'</b>='.$Wp1.' - '.$Wpk1.' + '.$Wp2.' + '.$Wp3.' + '.$Wp5.' + '.$Wp4.' + '.$Wd62.'<br>');
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==25)	// ����
	{
	 // W���=W���1��� + W���1��� + W���� + W�5 + W���. + W21 + W22 + W���.
	 // W����=W���� + W��� + W���1 + W���2
	 if ($arr["otch"]==1) $Wk1=7.6*0.6+20*0.8+(20*0.8+25*0.5+6*0.5+1.1*0.8);
	 if ($arr["otch"]==2) $Wk1=7.6*0.6*8+20*0.8*8+(20*0.8*8+25*0.5*9.2+6*0.5*24+1.1*0.8);
	 if ($arr["otch"]==4) $Wk1=7.6*0.6*8*21+20*0.8*8*21+(20*0.8*8*30+25*0.5*8*9.2*21+6*0.5*24*30+1.1*0.8*8*21);
	 if ($arr["otch"]==1) { $Wkosv=7.6*0.6; $Wksil=20*0.8; $Wvent=20*0.8; $Wsil1=25*0.5; $Wsil2=6*0.5; $Wosv=1.1*0.8; }
	 if ($arr["otch"]==2) { $Wkosv=8*7.6*0.6; $Wksil=8*20*0.8; $Wvent=20*0.8*8; $Wsil1=25*0.5*9.2; $Wsil2=6*0.5*24; $Wosv=1.1*0.8*8; }
	 if ($arr["otch"]==4) { $Wkosv=7.6*0.6*8*21; $Wksil=20*0.8*8*21; $Wvent=20*0.8*8*21; $Wsil1=25*0.5*9.2*21; $Wsil2=6*0.5*24*31; $Wosv=1.1*0.8*8*21;}
	 $Wprop=$Wvent+$Wsil1+$Wsil2+$Wosv;
	 fwrite ($fp,'W����('.$Wprop.')=W����('.$Wvent.') + W���1('.$Wsil1.') + W���2('.$Wsil2.') + W���('.$Wosv.')<br>');
	 fwrite ($fp,'W���� - ���. ���� � �� � t � T, � ���.����=20 ���,��=0,8 = '.$Wvent.'<br>');
	 fwrite ($fp,'W���1 - ����1 � �� � t � T,����1=25 ���,��=0,5,t=9,2� = '.$Wsil1.'<br>');
	 fwrite ($fp,'W���2 - ����2 � �� � t � T,����1=6 ���,��=0,5,24� = '.$Wsil2.'<br><br>');
	 fwrite ($fp,'W���  - ����.��� � �� � t ��,����.���=1,1,��=0,8 = '.$Wosv.'<br><br>');

	 // W�5=W12 - W���� - W���.���6 - W�-� - W����� - W��� - W�10 - W��� - W���.�1 - W�� - W����
	 // �� 4(��.12)���. (1209)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1209';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W12=$mu[0];
	 // ����250(�������� ������) ���.
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1116';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wk13=$mu[0];
	 // ���-4(���-6 ��� <������>)���. (1111)
	 // ���-5(���-6 ��� <������>) ���.(1112)
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
	 // W21 ��. ������� ����, W21, ��101 (0131)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0131';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W21=$mu[0];
	 // W22 ��. ������� ����,W22, ��101 (0132)
	 $query2='SELECT value FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0132';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W22=$mu[0];

	 if ($arr["otch"]==1) $Wrd58=2.5*0.8;
	 if ($arr["otch"]==2) $Wrd58=2.5*0.8*8;
	 if ($arr["otch"]==4) $Wrd58=2.5*0.8*8*21;
	 $Wrmu=$Wrmu1+$Wrmu2+$Wrd58;
	 fwrite ($fp,'W���.���6('.$Wrmu.')=W1('.$Wrmu1.')+W2('.$Wrmu2.')+W� �58('.$Wrd58.')<br>');
	 fwrite ($fp,'W1 - ��������� �������� ���-6 ������� �������� (���-4(���-6 ��� <������>) ���.) = '.$Wrmu1.'<br>');
	 fwrite ($fp,'W2 - ��������� �������� ���-6 ������������� �������� (���-5(���-6 ��� <������>) ���.) = '.$Wrmu2.'<br>');
	 fwrite ($fp,'W� �58 = '.$Wrd58.'<br><br>');

	 // Wc5 = W��� + W���. + W���.�1 + W�� + W����
	 if ($arr["otch"]==1) $Wcc5=35*0.8+2.5*0.5+3.8*0.8+4.6*0.8+25*0.8;
	 if ($arr["otch"]==2) $Wcc5=(35*0.8+2.5*0.5+4.6*0.8+25*0.8)*8+3.8*0.8*15;
	 if ($arr["otch"]==4) $Wcc5=((35*0.8+2.5*0.5+4.6*0.8+25*0.8)*8+3.8*0.8*15)*21;

	 // W���� ������ � ������ ������������� ������
	 if ($today[mon]>9 && $today[mon]<6)
	    {
	     if ($arr["otch"]==1) $Wtpl=5*0.5;
	     if ($arr["otch"]==2) $Wtpl=(5*0.5)*8;
	     if ($arr["otch"]==4) $Wtpl=((5*0.5)*8)*21;
	    }

	 // W���	 
	 if ($arr["otch"]==1) $Wskl=2.5*0.5;
	 if ($arr["otch"]==2) $Wskl=(2.5*0.5)*8;
	 if ($arr["otch"]==4) $Wskl=(2.5*0.5)*8*21;

	 $Wk10=0;
	 $Wea=$Wf17+$Wf7;
	 fwrite ($fp,'W�-�('.$Wea.') = W�17('.$Wf17.')+W�7('.$Wf7.')<br>');
	 fwrite ($fp,'W�17 - ������ �� �������� "�-�" 1��. �17 (��-4) = '.$Wf17.'<br>');
	 fwrite ($fp,'W�7  - ������ �� �������� "�-�" 1��. �7 (��-4)  = '.$Wf7.'<br><br>');
	 
	 $Wcc5=$Wcc5+$Wskl+$Wtpl;
	 $Wc5=$W12-$Wk13-$Wrmu-$Wea-$Wnas-$Wk10-$Wrzu-$Wcc5;

	 fwrite ($fp,'W�5('.$Wc5.') = W12(��-2)('.$W12.')-W����('.$Wk13.')-W���.���6('.$Wrmu.')-W�-�('.$Wea.')-W�����('.$Wnas.')-W�10('.$Wk10.')-W���('.$Wrzu.') - (W��� + W���.�1 + W�� + W����)('.$Wcc5.')<br>');
	 fwrite ($fp,'W12(��-2) - ������ �� �������� � ��-2 �12(��-4) = '.$W12.'<br>');
	 fwrite ($fp,'W���� - ������ �� �������� � ������� �������� = '.$Wk13.'<br>');
	 fwrite ($fp,'W���.��� = '.$Wrmu.'<br>');
	 fwrite ($fp,'W��� + W���.�1 + W�� + W���� = '.$Wcc5.'<br>');
	 fwrite ($fp,'W��� - �������� (��-4) = '.$Wnas.'<br>');
	 fwrite ($fp,'W�-� - ������ �-� �� ��������� (��-4) = '.$Wf7.'+'.$Wf17.'<br>');
	 fwrite ($fp,'W�10 - ����������� ����� (?)<br>');
	 fwrite ($fp,'W����� - �������� (��-4) = '.$Wnas.'<br>');
	 fwrite ($fp,'W��� - ��������-��������������� ��-� = '.$Wrzu.'<br><br>');

	 fwrite ($fp,'W���=W����1.���('.$Wkosv.')+W����1.���('.$Wksil.')+W����('.$Wprop.')+W�5('.$Wc5.')+W���.('.$Wskl.')+W21('.$W21.')+W22('.$W22.')<br>');
	 fwrite ($fp,'W����1.��� - ������������� �������� ������1 = '.$Wkosv.'<br>');
	 fwrite ($fp,'W����1.��� - ������� �������� ������1 = '.$Wksil.'<br>');
	 fwrite ($fp,'W���� - ������� ��������� � �������� (W����+W���1+W���2+W���) = '.$Wprop.'<br>');
	 fwrite ($fp,'Wskl - ������ ������� ������ ����,������ = '.$Wskl.'<br>');
	 fwrite ($fp,'W21 - ������ ��-�� 17 �� �������� �21 (��. ������� ����, W21, ��101) = '.$W21.'<br>');
	 fwrite ($fp,'W22 - ������ ��-�� 17 �� �������� �22 (��. ������� ����, W22, ��101) = '.$W22.'<br><br>');

	 $data0[$x][7]=$Wk1+$Wc5+$Wskl+$W21+$W22;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==26)	// ������
	{
	 // W���=W15 + W19 - W���� - W�-� - W���-��� - W�62 - W���.���.
	 // W15 ��. �������, ������ 6, W15, ��101 (0127)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0127';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W15=$mu[0];
	 // W19 ��. ������� ������, W19, ��101 (0113)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0113';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W19=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8814';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $Wtele2=$mu[0];	 
	 // $Wtea = $W�-� + $W��� + $W��62 + $W���
	 if ($arr["otch"]==1) $Wtea=(16.9+10.1+4.23)+0.5;
	 if ($arr["otch"]==2) $Wtea=(16.9+10.1+4.23)*8+0.5*15.9;
	 if ($arr["otch"]==4) $Wtea=(16.9+10.1+4.23)*8*21+0.5*15.9*30;	 

	 fwrite ($fp,'W���=W15('.$W15.')+W19('.$W19.')-W����('.$Wtele.')-(W���+W���-���.+W�62+W���.���.)('.$Wtea.')<br>');
	 fwrite ($fp,'W15 - ������ �� ��. �15 ��-101 (W15 ��. �������, ������ 6, W15, ��101) = '.$Wkosv.'<br>');
	 fwrite ($fp,'W19 - ������ �� ��. �19 ��-101 (W19 ��. ������� ������, W19, ��101) = '.$Wksil.'<br>');
	 fwrite ($fp,'W����2 - ������ �� ����� ����-2 '.$Wtele2.'<br>');
	 fwrite ($fp,'W��� - ������ ������� ������������ �-� = '.$Wtea.'<br>');
	 fwrite ($fp,'W���-��� - ������ ������� ��� <br>');
	 fwrite ($fp,'W��62 - ������ ������� ������ �-62 <br>');
	 fwrite ($fp,'W���.���. - ������ �� �������� ��������� <br><br>');
	 $data0[$x][7]=$W15+$W19-$Wtele2-$Wtea;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==24)	// ��������-������
	{
	 // W� = W1 + W2 + W3 + W4 + W5 + W���� + W��
	 // ��. ������� ������ �12, W 2a, ��-102 (0214)
	 // ��. ������� ������ �12 ����1, W1a, ��102 (0212)
	 // ��. ������� ������ �12 ����1, W1a, ����4 (0211)
	 // ��. ������� ������ �12, ����2, W2a, ����-4 (0213)
	 // ��. ������� ������ �12, ��. ���� W24a, ��-101 (0215)
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

	 // W���� + W��
	 if ($arr["otch"]==1) { $Wprt=17.5*0.8; $Wtea=16.9; }
	 if ($arr["otch"]==2) { $Wprt=(17.5*0.8)*8; $Wtea=16.9*8; }
	 if ($arr["otch"]==4) { $Wprt=(17.5*0.8)*8*21; $Wtea=16.9*8*21;}

	 fwrite ($fp,'W���=W1('.$W1.')+W2('.$W2.')+W3('.$W3.')+W4('.$W4.')+W5('.$W5.')+W����.('.$Wprt.')+W�-�('.$Wtea.')<br>');
	 fwrite ($fp,'W1 - ������ ������� (��. ������� ������ �12, W 2a, ��-102) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - ������ ������� (��. ������� ������ �12 ����1, W1a, ��102) = '.$W2.'<br>');
	 fwrite ($fp,'W3 - ������ ������� (��. ������� ������ �12 ����1, W1a, ����4) '.$W3.'<br>');
	 fwrite ($fp,'W4 - ������ ������� (��. ������� ������ �12, ����2, W2a, ����-4) '.$W4.'<br>');
	 fwrite ($fp,'W5 - ������ ������� (��. ������� ������ �12, ��. ���� W24a, ��-101) '.$W5.'<br>');
	 fwrite ($fp,'W����. - ������ ��� ������ ��������� ������ = '.$Wprt.'<br>');
	 fwrite ($fp,'W��� - ������ ������� ������������ �-� = '.$Wtea.'<br><br>');
	 
	 $data0[$x][7]=$W1t5+$Wprt;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==23)	// ���-������
	{
	 // W� = W1 + W2
	 // W1 ��. ������� ���-������, W9, ��101 (0122)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0122';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // W2 ������ ������� � ������� ������������������ ����
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8815';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 

	 fwrite ($fp,'W���=W1('.$W1.')+W2('.$W2.')<br>');
	 fwrite ($fp,'W1 - ������ ������� (W1 ��. ������� ���-������, W9, ��101) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - ������ ������� � ������� ������������������ ���� = '.$W2.'<br>');
	 $data0[$x][7]=$W1+$W2;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==27)	// �������-������
	{
	 // W� = W1 + W2 + W3
	 // ��. ������� W13, ��101 (0128) ����������� � ������� �21
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=0128';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // W2,W3 � ����������� (� �� ����)
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8816';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8817';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 

	 fwrite ($fp,'W���=W1('.$W1.')+W2('.$W2.')+W3('.$W3.')<br>');
	 fwrite ($fp,'W1 - ������ ������� (��. ������� W13, ��101) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - ������ ������� �������-������ = '.$W2.'<br>');
	 fwrite ($fp,'W3 - ������ ������� �������-������ = '.$W3.'<br>');
	 $data0[$x][7]=$W1+$W2+$W3;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==38)	// �������-������
	{
	 // W� = W1 (�� ��������) ���� ������ ���� ������� � ������� �9
	 // ��. ������� ������ �9, W14, ��101 (0126) ����������� � ������� �9
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=8818';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 

	 fwrite ($fp,'W���=W1('.$W1.')<br>');
	 fwrite ($fp,'W1 - ������ ������� ������-����� = '.$W1.'<br>');
	 $data0[$x][7]=$W1;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==29)	// ����
	{
	 // ����(��.2)���
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1201';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // ����(��.2)����.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1202';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 // ����(��-15)���
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1203';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 
	 // ����(��-15)����.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1204';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];	 

	 fwrite ($fp,'W���=W1('.$W1.')+W3('.$W3.')<br>');
	 fwrite ($fp,'W1 - ��������� �������� �� ������ (����(��.2)���) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - ��������� �������� �� ������ (����(��.2)����.) = '.$W2.'<br>');
	 fwrite ($fp,'W3 - ��������� �������� �� ������ (����(��-15)���) = '.$W3.'<br>');
	 fwrite ($fp,'W4 - ��������� �������� �� ������ (����(��-15)����.) = '.$W4.'<br>');
	 $data0[$x][7]=$W1+W3;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==28)	// ����
	{
	 // ���(��.11)���.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1207';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 
	 // ���(��.11)����.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1208';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W2=$mu[0];	 
	 // ���(��.6)���.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1205';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W3=$mu[0];	 
	 // ���(��.6)����.
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1206';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W4=$mu[0];	 

	 fwrite ($fp,'W���=W1('.$W1.')+W3('.$W3.')<br>');
	 fwrite ($fp,'W1 - ��������� �������� �� ������ (���(��.11)���.) = '.$W1.'<br>');
	 fwrite ($fp,'W2 - ��������� �������� �� ������ (���(��.11)����.) = '.$W2.'<br>');
	 fwrite ($fp,'W3 - ��������� �������� �� ������ (���(��.6)���.) = '.$W3.'<br>');
	 fwrite ($fp,'W4 - ��������� �������� �� ������ (���(��.6)����.) = '.$W4.'<br>');
	 $data0[$x][7]=$W1+W3;
	}
    //-------------------------------------------------------------------------
    if ($arr["idbuy"]==34)	// ����
	{
	 $query2='SELECT SUM(value) FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND source='.$sour.' AND device=1214';
	 $mt = mysql_query ($query2,$i);
	 if ($mt) $mu = mysql_fetch_row ($mt);
	 if ($mu == true) $W1=$mu[0];	 

	 fwrite ($fp,'W���=W1('.$W1.')<br>');
	 fwrite ($fp,'W1 - ������ ������� �� ����� � ���� (����) = '.$W1.'<br>');
	 $data0[$x][7]=$W1;
	}
 // W��� = W���� * ((W�14-13+W�14-31)-(W�14-13+W�14-31))/(W�14-13+W�14-31)
 // W��� = W��� + W���
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

 fwrite ($fp,'W���=W����('.$data0[$x][7].')+W���('.$data0[$x][7]*$Wpot.')<br>');
 fwrite ($fp,'Wpot = ((W1413+W1431)-(W1413c+W1431c))/(W1413+W1431) * W����<br>');
 fwrite ($fp,'W1413 - ��������� �������� �13 ���14 (�����) = '.$W1413.'<br>');
 fwrite ($fp,'W1431 - ��������� �������� �31 ���14 (�����) = '.$W1431.'<br>');
 fwrite ($fp,'W1413c - ��������� �������� �13 ��� (���� 1 (�14-13) ���.(�)) = '.$W1413c.'<br>');
 fwrite ($fp,'W1431c - ��������� �������� �31 ��� (����-2(�14-31)���.(�)) = '.$W1431c.'<br>');

 $data0[$x][7]=$data0[$x][7]*$Wpot+$data0[$x][7];
 fwrite ($fp,'<b>'.$dat[$x].'</b>'.' W���=<b>'.$data0[$x][7].'</b><br>');
 $k=1000; // �� ���� �� ��������
}
?>