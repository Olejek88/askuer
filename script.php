<?php
include("config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$arend_num=0; $korp_num=0; $energy_num=0; $object_num=0;
//--------------------------------------------------------------------	
// �������� ����� ���������� �����������, �������������� � �������� �������
$query = 'SELECT caption FROM buyers';
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
for ($z=1;$z<=1200;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) $arend_num++;
}
$query = 'SELECT * FROM korp';
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
for ($z=1;$z<=1200;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) $korp_num++;
}
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
for ($z=1;$z<=1200;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) $energy_num++;
}
$query = 'SELECT * FROM obj';
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
for ($z=1;$z<=2000;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) $object_num++;
}
print '<b>�������� ������</b><br>';
print '�����������: '; print $arend_num; print '<br>';
print '��������: '; print $korp_num; print '<br>';
print '��������������: '; print $energy_num; print '<br>';
print '��������: '; print $object_num; print '<br>';
//--------------------------------------------------------------------	
$rs_temp=0; 	// ��������� ����������� ��� ��������� ������� ����
$cold=0;	// ����������������� ������������� �������
$gradusdays=0;	// ������������ ������������� �������
$period=0;	// ����������������� ������������� �������
$Rtepl=0;	// ����������� ������������� ������������� ����������� �����������
$Qpot[0]=0; 	// ������ ������� ����� ����������� ����������� ���������
$Qras[0]=0; 	// ������ ��������� ������ � ������� �������������
$Qvoda[0]=0;	// ��������� ����������� �����
$Qtepl[0]=0;	// ��������� ����������� �����
$Qpara[0]=0;	// ��������� ����������� ����, �������, ���� � ���������
$Qelec[0]=0;	// ��������� ����������� �������������
$QT=0;		// ��������� ��������� ����������� ����� 
$QV=0;		// ��������� ��������� ����������� ���� 
$QP=0;		// ��������� ��������� ����������� ����, �������, ���� � ���������
$QE=0;		// ��������� ��������� ����������� �������������
$QTkor=0;	// ��������� ��������� ����������� ����� ��������
$QVkor=0;	// ��������� ��������� ����������� ���� ��������
$QPkor=0;	// ��������� ��������� ����������� ����, �������, ���� � ��������� ��������
$QEkor=0;	// ��������� ��������� ����������� ������������� ��������
$QTk[0]=0;	// ��������� ��������� ����������� ����� ��������� (������)
$QVk[0]=0;	// ��������� ��������� ����������� ���� ��������� (������)
$QPk[0]=0;	// ��������� ��������� ����������� ����, �������, ���� � ��������� �������� ��������� (������)
$QEk[0]=0;	// ��������� ��������� ����������� ������������� ��������� (������)
//--------------------------------------------------------------------	
//$query = 'SELECT rs_temp,cold_period FROM territory';
//$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
//for ($z=1;$z<=10;$z++)
//{
// $ui = mysql_fetch_row ($e);
// if ($ui == true)
//	{
//	 $rs_temp=$ui[0];
//	 $cold=$ui[1];
//	}
//}
//print '����������� �����: '; print $rs_temp; print '<br>';
//print '����������������� ������������� �������: '; print $cold; print '<br>';
//print '<hr>';
//-------------------------------------------------------
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
	{        
	 //-------------------------------------------------------
	 if ($ui[2]=='1')	// ����� � ���������������� ����
		{
		 print '<h2>����� </h2>';
		 // ����� ����������� �����
	         // ��� ������� ������� ���� ���������
		 $index=0;
		 $query = 'SELECT * FROM obj WHERE type=2';
		 $r = mysql_query ($query,$i);
		 for ($x=1;$x<=12000;$x++)
			{
			 $uo = mysql_fetch_row ($r);
			 if ($uo == true)
			   {
			    include("eval/objects.php");
			    include("eval/teplo.php");
			    $Qtepl[$index]=$Qras[$index];
			    if ($Qtepl[$index]<0) $Qtepl[$index]=0;
			    $QT=$QT+$Qtepl[$index];
			    print '<b>'; print $uo[1]; print '</b>'; print '  Q='; print $Qtepl[$index]; print '(Qras='; print $Qras[$index]; print ',Qpot='; print $Qpot[$index]; print ')<br>';
			    $index++;
		  	   }
			}
		 print '����� ����������� �����: <b>'; print $QT; print '</b>';
		 //-------------------------------------------------------
		 // ����� ����������� ����� �� ��������
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ���������, ������������� �������
			     $index=0; $QTkor=0;
			     $query = 'SELECT * FROM obj WHERE type=2 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i);
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    include("eval/objects.php");
				    include("eval/teplo.php");
				    $Qtepl[$index]=$Qras[$index];
				    $QTkor=$QTkor+$Qtepl[$index];
				    $index++;
			  	   }	
				}
			     $QTk[$index_korp]=$QTkor;
			     print '<br>����� ����������� �� <b>'; print $up[2]; print '</b>: '; print $QTkor;

			     // ��� ������� ������� ���� ���������, ������������� ������� ������� �����������
			     $index=0;
			     $query = 'SELECT id,name FROM obj WHERE type=\'2\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    print '<br>'; print $uo[1]; print ' ('; print $Qtepl[$index]; print '/'; print $QTkor; print ')'; print ' K2 = '; 
				    if ($QTkor>0) print $Qtepl[$index]/$QTkor; else print "0";
				    if ($QTkor>0) $query = 'UPDATE obj SET K1=\''.$Qtepl[$index]/$QTkor.'\',K2=\''.$Qtepl[$index]/$QTkor.'\' WHERE id=\''.$uo[0].'\'';
					else $query = 'UPDATE obj SET K1=\'0\',K2=\'0\' WHERE id=\''.$uo[0].'\'';
				    $g = mysql_query ($query,$i);
				    $index++;
				   }
				}
			     $index_korp++;
			    }
			}
                 $index_korp=0; 
		 print '<br><hr>';
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ������
			     $query = 'SELECT * FROM objects WHERE type=\'1\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    print '<b>'; print $uo[1]; print ' </b>K2 = '; print $QTk[$index_korp]/$QT; print '<br>';
				    $query = 'UPDATE objects SET K1=\''.$QTk[$index_korp]/$QT.'\',K2=\''.$QTk[$index_korp]/$QT.'\' WHERE id=\''.$uo[0].'\'';
				    $g = mysql_query ($query,$i);				    
			  	   }	
			    }
			 $index_korp++;
			}
		}
	 //-------------------------------------------------------
	 if ($ui[2]=='2')	// �������-�������� ����
		{
		 print '<br><h2>�������-�������� ����: </h2>';
	         // ��� ������� ������� ���� ��������� ��� �������
		 $index=0;
		 $query = 'SELECT * FROM obj WHERE type!=1';
		 $r = mysql_query ($query,$i);
		 for ($x=1;$x<=12000;$x++)
			{
			 $uo = mysql_fetch_row ($r);
			 if ($uo == true)
			   {
			    include("eval/objects.php");
			    include("eval/voda.php");
			    $QV=$QV+$Qvoda[$index];
			    $index++;
		  	   }
			}
		 print '����� ����������� ����: '; print $QV;
		 //-------------------------------------------------------		 
		 // ����� ����������� ���� �� ��������
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ��������� ��� �������, ������������� �������
			     $index=0; $QVkor=0;
			     $query = 'SELECT * FROM obj WHERE type!=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i);
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    include("eval/objects.php");
				    include("eval/voda.php");
				    $QVkor=$QVkor+$Qvoda[$index];
				    $index++;
			  	   }	
				}
			     $QVk[$index_korp]=$QVkor;
			     print '<br>����� ����������� �� <b>'; print $up[2]; print '</b>: '; print $QVkor;
			     // ��� ������� ������� ���� ��������� ��� �������, ������������� ������� ������� �����������
			     $index=0;
			     $query = 'SELECT id,name FROM obj WHERE type!=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    print '<br>'; print $uo[1]; print ' ('; print $Qvoda[$index]; print '/'; print $QVkor; print ')'; print ' K2 = '; if ($QVkor>0) print $Qvoda[$index]/$QVkor; else print '0';
				    if ($QVkor>0) $query = 'UPDATE obj SET K3='.$Qvoda[$index]/$QVkor.' WHERE id='.$uo[0];
				    else $query = 'UPDATE obj SET K3=0 WHERE id='.$uo[0];
				    $g = mysql_query ($query,$i);
				    $index++;
				   }
				}
			     $index_korp++;
			    }
			}
                 $index_korp=0;	print '<br><hr>';
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ������
			     $query = 'SELECT * FROM obj WHERE type=\'1\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    print '<b>'; print $uo[1]; print ' </b>K3 = '; print $QVk[$index_korp]/$QV; print '<br>';
				    $query = 'UPDATE obj SET K3='.$QVk[$index_korp]/$QV.' WHERE id=\''.$uo[0].'\'';
				    $g = mysql_query ($query,$i);
			  	   }	
			    }
			 $index_korp++;
			}
		}
	 //-------------------------------------------------------
	 if ($ui[2]=='3' || $ui[2]=='4' || $ui[2]=='5' || $ui[2]=='6')	// ���, ������, ��� � ��������
		{
		 print '<br><h2>���, ������, ��� � ��������: </h2>';
		 $res=$ui[2];
	         // ��� ������� ������� ���� �������
		 $index=0; $QP=0;
		 if ($res==3) $query = 'SELECT SUM(Qpara) FROM objects WHERE type=3 AND Qpara>0';
		 if ($res==4) $query = 'SELECT SUM(Qgaza) FROM obj WHERE type=3 AND Qgaza>0';
		 if ($res==5) $query = 'SELECT SUM(Qszh)  FROM obj WHERE type=3 AND Qszh>0';
		 if ($res==6) $query = 'SELECT SUM(Qkisl) FROM obj WHERE type=3 AND Qkisl>0';
		 $r = mysql_query ($query,$i);
		 $uo = mysql_fetch_row ($r);
		 if ($uo == true)
		   {
		    include("eval/objects.php");
		    include("eval/par.php");
		    $QP=$QP+$Qpara[$index];
		    $index++;
	  	   }
		 if ($res==3) { print '<br>����� ����������� ����: '; print $QP; }
		 if ($res==4) { print '<br>����� ����������� ����: '; print $QP; }
		 if ($res==5) { print '<br>����� ����������� �������: '; print $QP; }
		 if ($res==6) { print '<br>����� ����������� ���������: '; print $QP; }
		 //-------------------------------------------------------		 
		 // ����� ����������� �� ��������
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� �������, ������������� �������
			     $index=0; $QPkor=0;
			     if ($res==3) $query = 'SELECT SUM(Qpara) FROM objects WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qpara>0';
			     if ($res==4) $query = 'SELECT SUM(Qgaza) FROM obj WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qgaza>0';
			     if ($res==5) $query = 'SELECT SUM(Qszh)  FROM obj WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qszh>0';
		  	     if ($res==6) $query = 'SELECT SUM(Qkisl) FROM obj WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qkisl>0';
			     $r = mysql_query ($query,$i);
			     $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    include("eval/objects.php");
				    include("eval/par.php");
				    $QPkor=$QPkor+$Qpara[$index];
			  	   }	
			     $QPk[$index_korp]=$QPkor;
			     print '<br>����� ����������� �� <b>'; print $up[2]; print '</b>: '; print $QPkor;
			     // ��� ������� ������� ���� �������, ������������� ������� ������� �����������
			     $index=0;
			     if ($res==3) $query = 'SELECT id,name,Qpara FROM objects WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qpara>0';
			     if ($res==4) $query = 'SELECT id,name,Qgaza FROM obj WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qgaza>0';
			     if ($res==5) $query = 'SELECT id,name,Qszh  FROM obj WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qszh>0';
		  	     if ($res==6) $query = 'SELECT id,name,Qkisl FROM obj WHERE type=3 AND idkorp=\''.$up[1].'\' AND Qkisl>0';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=2000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    print '<br>'; print $uo[1]; print ' ('; print $uo[2]; print '/'; print $QPkor; print ')'; 
				    if ($res==3) $query = 'UPDATE objects SET K4=\''.$uo[2]/$QPk[$index_korp].'\' WHERE id='.$uo[0];
				    if ($res==4) $query = 'UPDATE obj SET K5=\''.$uo[2]/$QPk[$index_korp].'\' WHERE id='.$uo[0];
				    if ($res==5) $query = 'UPDATE obj SET K6=\''.$uo[2]/$QPk[$index_korp].'\' WHERE id='.$uo[0];
		  		    if ($res==6) $query = 'UPDATE obj SET K7=\''.$uo[2]/$QPk[$index_korp].'\' WHERE id='.$uo[0];
				    $g = mysql_query ($query,$i);
				    $index++;
				   }
				}
			     $index_korp++;
			    }
			}
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ������
			     $query = 'SELECT * FROM objects WHERE type=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    if ($QP>0) $st=$QPk[$index_korp]/$QP; else $st=0;
				    print '<br><b>'; print $uo[1]; print ' </b>('; print $QPk[$index_korp]; print '/'; print $QP; print ')'; print ' K = '; print $st;
				    if ($res==3) $query = 'UPDATE objects SET K4=\''.$st.'\' WHERE id=\''.$uo[0].'\'';
				    if ($res==4) $query = 'UPDATE obj SET K5=\''.$st.'\' WHERE id=\''.$uo[0].'\'';
				    if ($res==5) $query = 'UPDATE obj SET K6=\''.$st.'\' WHERE id=\''.$uo[0].'\'';
		  		    if ($res==6) $query = 'UPDATE obj SET K7=\''.$st.'\' WHERE id='.$uo[0];
				    $g = mysql_query ($query,$i);
			  	   }	
			    }
		    	 $index_korp++;
			}
		}
	 //-------------------------------------------------------
	 if ($ui[2]=='7')	// �������������
		{
		 print '<hr><br><h2>�������������</h2>';
	         // ��� ������� ������� ���� ��������� ��� �������
		 $index=0; $QE=0;
		 $query = 'SELECT * FROM objects WHERE type!=1';
		 $r = mysql_query ($query,$i);
		 for ($x=1;$x<=12000;$x++)
			{
			 $uo = mysql_fetch_row ($r);
			 if ($uo == true)
			   {
			    include("eval/objects.php");
			    include("eval/elect.php");
			    $QE=$QE+$Qelec[$index];
			    $index++;
		  	   }
			}
		 print '����� ����������� �������������: '; print $QE;
		 //-------------------------------------------------------		 
		 // ����� ����������� ������������� �� ��������
                 $index_korp=0; $QEkor=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ��������� ��� �������, ������������� �������
			     $index=0; $QEkor=0;
			     $query = 'SELECT * FROM objects WHERE type!=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i);
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    include("eval/objects.php");
				    include("eval/elect.php");
				    $QEkor=$QEkor+$Qelec[$index];
				    $index++;
			  	   }	
				}
			     $QEk[$index_korp]=$QEkor;
			     print '<br>����� ����������� �� ������� '; print $up[2]; print ': '; print $QEkor;
			     // ��� ������� ������� ���� ��������� ��� �������, ������������� ������� ������� �����������
			     $index=0;
			     $query = 'SELECT id FROM objects WHERE type!=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    if ($QEkor>0) $st=$Qelec[$index]/$QEkor; else $st=0;
				    print '<br>'; print $uo[1]; print ' ('; print $Qelec[$index]; print '/'; print $QEkor; print ')'; print ' K2 = '; print $st;
				    $query = 'UPDATE objects SET K8=\''.$st.'\' WHERE id=\''.$uo[0].'\'';
				    $g = mysql_query ($query,$i);
				    $index++;
				   }
				}
			     $index_korp++;
			    }
			}
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // ��� ������� ������� ���� ������
			     $query = 'SELECT * FROM objects WHERE type=\'1\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    print '<br>'; print $uo[1]; print ' ('; print $QEk[$index_korp]; print '/'; print $QE; print ')'; print ' K8 = '; print $QEk[$index_korp]/$QE;
				    $query = 'UPDATE objects SET K8=\''.$QEk[$index_korp]/$QE.'\' WHERE id='.$uo[0];
				    $g = mysql_query ($query,$i);
			  	   }	
			    }
		    	 $index_korp++;
			}
		}
	 //-------------------------------------------------------
	}
}
?>