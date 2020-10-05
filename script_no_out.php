<?php
include("config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$arend_num=0; $korp_num=0; $energy_num=0; $object_num=0;
//--------------------------------------------------------------------	
// получаем общее количество арендаторов, энергорусурсов и корпусов системы
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
//--------------------------------------------------------------------	
$rs_temp=0; 	// расчетная температура для холодного времени года
$cold=0;	// продолжительность отопительного периода
$gradusdays=0;	// градусосутки отопительного периода
$period=0;	// продолжительность отопительного периода
$Rtepl=0;	// приведенное сопротивление теплопередаче ограждающих конструкций
$Qpot[0]=0; 	// потери теплоты через ограждающие конструкции помещений
$Qras[0]=0; 	// расчет теплового потока и расхода теплоносителя
$Qvoda[0]=0;	// расчетное потребление тепла
$Qtepl[0]=0;	// расчетное потребление тепла
$Qpara[0]=0;	// расчетное потребление пара, воздуха, газа и кислорода
$Qelec[0]=0;	// расчетное потребление электричества
$QT=0;		// суммарное расчетное потребление тепла 
$QV=0;		// суммарное расчетное потребление воды 
$QP=0;		// суммарное расчетное потребление пара, воздуха, газа и кислорода
$QE=0;		// суммарное расчетное потребление электричества
$QTkor=0;	// суммарное расчетное потребление тепла корпусом
$QVkor=0;	// суммарное расчетное потребление воды корпусом
$QPkor=0;	// суммарное расчетное потребление пара, воздуха, газа и кислорода корпусом
$QEkor=0;	// суммарное расчетное потребление электричества корпусом
$QTk[0]=0;	// суммарное расчетное потребление тепла корпусами (массив)
$QVk[0]=0;	// суммарное расчетное потребление воды корпусами (массив)
$QPk[0]=0;	// суммарное расчетное потребление пара, воздуха, газа и кислорода корпусом корпусами (массив)
$QEk[0]=0;	// суммарное расчетное потребление электричества корпусами (массив)
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
//-------------------------------------------------------
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
	{        
	 //-------------------------------------------------------
	 if ($ui[2]=='1')	// тепло и теплофикационная вода
		{
		 // Общее потребление тепла
	         // Для каждого объекта типа помещение
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
			    $index++;
		  	   }
			}
		 //-------------------------------------------------------
		 // Общее потребление тепла по корпусам
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // Для каждого объекта типа помещение, принадлежащих корпусу
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

			     // Для каждого объекта типа помещение, принадлежащих корпусу считаем коэффициент
			     $index=0;
			     $query = 'SELECT id,name FROM obj WHERE type=\'2\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    //if ($QTkor>0) print $Qtepl[$index]/$QTkor; else print "0";
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
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // Для каждого объекта типа корпус
			     $query = 'SELECT * FROM objects WHERE type=\'1\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    $query = 'UPDATE objects SET K1=\''.$QTk[$index_korp]/$QT.'\',K2=\''.$QTk[$index_korp]/$QT.'\' WHERE id=\''.$uo[0].'\'';
				    $g = mysql_query ($query,$i);				    
			  	   }	
			    }
			 $index_korp++;
			}
		}
	 //-------------------------------------------------------
	 if ($ui[2]=='2')	// пожарно-питьевая вода
		{
	         // Для каждого объекта типа помещение или агрегат
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
		 //-------------------------------------------------------		 
		 // Общее потребление воды по корпусам
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // Для каждого объекта типа помещение или агрегат, принадлежащих корпусу
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
			     // Для каждого объекта типа помещение или агрегат, принадлежащих корпусу считаем коэффициент
			     $index=0;
			     $query = 'SELECT id,name FROM obj WHERE type!=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    if ($QVkor>0) $query = 'UPDATE obj SET K3='.$Qvoda[$index]/$QVkor.' WHERE id='.$uo[0];
				    else $query = 'UPDATE obj SET K3=0 WHERE id='.$uo[0];
				    $g = mysql_query ($query,$i);
				    $index++;
				   }
				}
			     $index_korp++;
			    }
			}
                 $index_korp=0;	//print '<br><hr>';
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // Для каждого объекта типа корпус
			     $query = 'SELECT * FROM obj WHERE type=\'1\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    $query = 'UPDATE obj SET K3='.$QVk[$index_korp]/$QV.' WHERE id=\''.$uo[0].'\'';
				    $g = mysql_query ($query,$i);
			  	   }	
			    }
			 $index_korp++;
			}
		}
	 //-------------------------------------------------------
	 if ($ui[2]=='3' || $ui[2]=='4' || $ui[2]=='5' || $ui[2]=='6')	// пар, воздух, газ и кислород
		{
		 $res=$ui[2];
	         // Для каждого объекта типа агрегат
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
		 //-------------------------------------------------------		 
		 // Общее потребление по корпусам
                 $index_korp=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // Для каждого объекта типа агрегат, принадлежащих корпусу
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
			     // Для каждого объекта типа агрегат, принадлежащих корпусу считаем коэффициент
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
		     	     // Для каждого объекта типа корпус
			     $query = 'SELECT * FROM objects WHERE type=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
				    if ($QP>0) $st=$QPk[$index_korp]/$QP; else $st=0;
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
	 if ($ui[2]=='7')	// электричество
		{
	         // Для каждого объекта типа помещение или агрегат
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
		 //-------------------------------------------------------		 
		 // Общее потребление электричества по корпусам
                 $index_korp=0; $QEkor=0;
		 $query = 'SELECT * FROM korp';
		 $t = mysql_query ($query,$i);
		 for ($c=1;$c<=100;$c++)
			{
			 $up = mysql_fetch_row ($t);
			 if ($up == true)
			    {
		     	     // Для каждого объекта типа помещение или агрегат, принадлежащих корпусу
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
			     // Для каждого объекта типа помещение или агрегат, принадлежащих корпусу считаем коэффициент
			     $index=0;
			     $query = 'SELECT id FROM objects WHERE type!=1 AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); 
			     for ($x=1;$x<=12000;$x++)
				{
				 $uo = mysql_fetch_row ($r);
				 if ($uo == true)
				   {
				    if ($QEkor>0) $st=$Qelec[$index]/$QEkor; else $st=0;
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
		     	     // Для каждого объекта типа корпус
			     $query = 'SELECT * FROM objects WHERE type=\'1\' AND idkorp=\''.$up[1].'\'';
			     $r = mysql_query ($query,$i); $uo = mysql_fetch_row ($r);
			     if ($uo == true)
				   {
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