<?php 
// ��������� ��������� ������ ��������� � �������� �����
// �������-����� ������������� ������� (����) ������� ���������� �� �������
// ���� = (t� - t��.���.) z��.���
//$gradusdays=($temperature-$rs_temp) * $cold;
// ��������������� | ���������-������� | ��������� | ����������������
//if ($typeR=='1' || $typeR=='6' || $typeR=='4' || $typeR=='5')
//	{
//	 if ($gradusdays<2000) $Rtepl=1.6;
//	 if ($gradusdays<4000) $Rtepl=2.4;
//	 if ($gradusdays<6000) $Rtepl=3.0;
//	 if ($gradusdays<8000) $Rtepl=3.6;
//	 if ($gradusdays<10000) $Rtepl=4.2;
//	 if ($gradusdays>10000) $Rtepl=4.8;
//	}
// ���������������� | ���������
//if ($typeR=='2' || $typeR=='3')
//	{
//	 if ($gradusdays<2000) $Rtepl=1.4;
//	 if ($gradusdays<4000) $Rtepl=1.8;
//	 if ($gradusdays<6000) $Rtepl=2.2;
//	 if ($gradusdays<8000) $Rtepl=2.6;
//	 if ($gradusdays<10000) $Rtepl=3.0;
//	 if ($gradusdays>10000) $Rtepl=3.4;
//	}       	
// ���������� ������ �������  ����� ����������� �����������
// ����� �������� �����
//if ($door_type=='1') $b = 0.2 *$height;
//if ($door_type=='2') $b = 0.27*$height;
//if ($door_type=='3') $b = 0.34*$height;
//if ($door_type=='4') $b = 0.22*$height;
//$b=$b+($win_s*0.1 + $win_w*0.05);

// ����� ��������� ������ �������, ���, �������, ����������� ������������� ���������
//$Q1=0;
// ����������� ����� ��������������� ��������� ������
//$b1=0;
// ����������� ����� �������������� ������ ������� 
//$b2=1.07; //� ���������� ��������� ������
// ���������� ������ ���������
//$sect=$radiator_type%100;
// ��� ��������� ��-140
//if ($radiator_type>100 && $radiator_type<200)
//	{
//	 $Q1=$sect*0.16*1000;
//	 $b1=1.03;
//	}
// ��� ��������� ��-180 (��-80)
//if ($radiator_type>200 && $radiator_type<300)
//	{
//	 $Q1=$sect*0.132*1000;
//	 $b1=1.02;
//	}
//$Qpot[$index]=(($wall_square*$height) * ($temperature-$rs_temp) * (1+$b))/$Rtepl;
//$Qras[$index]= $radiators*($Q1*$b1*$b2);
// �������� �����
$Qpot[$index]=$volume;
$Qras[$index]=$volume;
?>

