<meta charset='UTF-8'></head>
【重置初始化陣列】F5鍵
<?php






function Print_array($Load_array){//顯示陣列
	$Column=1;
	$Array_length=count($Load_array[0]);
	foreach($Load_array as $Value1){
		foreach($Value1 as $Value2){
			if($Value2==="*") echo"<b>",$Value2,"</b>";
			else echo$Value2;

			if($Column%$Array_length==0) echo"<br>";
		$Column++;
		}
	}
}


echo"<h3>初始陣列</h3>";
	for($Column=0;$Column<10;$Column++){
		for($Row=0;$Row<10;$Row++){
		$Chess_Board[$Column][$Row]=rand(0,9);
		}
	}



Print_array($Chess_Board);
echo"<HR><h3>連消判斷</h3>";


//行列 ＞ Row橫 Column直

	function Determine($Chess_Board_A,$Chess_Board){//判斷連消
		for($Column=0;$Column<count($Chess_Board_A);$Column++){
			for($Row=0;$Row<count($Chess_Board_A[0]);$Row++){
				if($Row>1){
					if($Chess_Board[$Column][$Row]===$Chess_Board[$Column][$Row-1]&&$Chess_Board[$Column][$Row]===$Chess_Board[$Column][$Row-2]){
					
						if($Chess_Board[$Column][$Row-1]!=='*'&&$Chess_Board[$Column][$Row-2]!=='*')
						echo"<H3>連消位置[",$Column,"][",$Row-1,"]：數值【",$Chess_Board[$Column][$Row-1],"】</h3>";

					$Chess_Board_A[$Column][$Row]='*';
					$Chess_Board_A[$Column][$Row-1]='*';
					$Chess_Board_A[$Column][$Row-2]='*';
					}
				}

				if($Column>1){
					if($Chess_Board[$Column][$Row]===$Chess_Board[$Column-1][$Row]&&$Chess_Board[$Column][$Row]===$Chess_Board[$Column-2][$Row]){

						if($Chess_Board[$Column-1][$Row]!=='*'&&$Chess_Board[$Column-2][$Row]!=='*')
						echo"<H3>連消位置[",$Column-1,"][",$Row,"]：數值【",$Chess_Board[$Column-1][$Row],"】</h3>";
					
					$Chess_Board_A[$Column][$Row]='*';
					$Chess_Board_A[$Column-1][$Row]='*';
					$Chess_Board_A[$Column-2][$Row]='*';
					}
				}

			}
		}
	return $Chess_Board_A;
	}

$Chess_Board_A=$Chess_Board;
$Chess_Board_A=Determine($Chess_Board_A,$Chess_Board);
Print_array($Chess_Board_A);


echo"<hr>";


	function swap(&$X,&$Y){
	$Temp=$X;
	$X=$Y;
	$Y=$Temp;
	}

	function insertion_sort($Sort,$Chess_Board_A){//升冪歸遞
		if($Sort=='asc'||empty($Sort)){
			for($Row=0;$Row<count($Chess_Board_A[0]);$Row++){
				for($I=count($Chess_Board_A)-2; $I>=0; $I--){
				$Temp=$Chess_Board_A[$I][$Row];
					for($J=$I+1; $J<count($Chess_Board_A) && $Chess_Board_A[$J][$Row]==="*"; $J++){
					$Chess_Board_A[$J-1][$Row]=$Chess_Board_A[$J][$Row];
					$Chess_Board_A[$J][$Row]=$Temp;
					}
				}
			}
		}
		else if($Sort=='desc'){//降冪歸遞
			for($Row=0;$Row<count($Chess_Board_A[0]);$Row++){
				for($I=1; $I<count($Chess_Board_A); $I++){
					$Temp=$Chess_Board_A[$I][$Row];
					for($J=$I-1; $J>=0 && $Chess_Board_A[$J][$Row]==="*"; $J--){
					$Chess_Board_A[$J+1][$Row]=$Chess_Board_A[$J][$Row];
					}
					$Chess_Board_A[$J+1][$Row]=$Temp;
				}
			}
		}
	return $Chess_Board_A;
	}

echo"<h3>升冪歸遞</h3>";
Print_array(insertion_sort($Sort="asc",$Chess_Board_A));
echo"<hr>";


echo"<h3>降冪歸遞</h3>";
Print_array(insertion_sort($Sort="desc",$Chess_Board_A));
echo"<hr>";





$Chess_Board_A=array( 
	array('*','*','*','*','*','*','*','*','*','*'), 
	array('*','*','*','*','*','*','*','*','*','*'), 
	array('*','*','*','*','*','*','*','*','*','*'), 
	array(7,9,1,8,'*','*',0,'*','*',6), 
	array(6,2,9,6,'*','*',6,5,2,7),
	array(8,7,6,0,6,4,4,2,7,2),
	array(4,4,3,0,2,3,9,3,8,8),
	array(2,5,5,9,6,7,6,9,3,0),
	array(1,3,7,8,3,4,2,8,6,8),
	array(1,1,2,5,2,5,8,1,8,3),
	array(9,7,7,1,2,7,2,7,0,2)
	); 

echo"<h3>模擬增加一列【固定陣列】</h3>";
Print_array($Chess_Board_A);
echo"<hr>";
echo"<h3>模擬增加一排球上去【固定陣列】</h3>";



	function Cast_a_row($Chess_Board){//升冪歸遞
		$Row=0;
		$Column=0;
		while($Row<count($Chess_Board[0])){
			do{
				if(is_numeric($Chess_Board[$Column][$Row])){
				$Chess_Board[$Column-1][$Row]=rand(0,9);
				$Column=0;
				//echo"<H3>Chess_Board[",$Column,"][",$Row,"]==",$Chess_Board[$Column][$Row],"</h3>";
				break;
			}
			$Column++;
			//echo$Chess_Board[$Column][$Row],"<br>";
			}while($Column<10);
		$Row++;
		}
		return $Chess_Board;
	}



Print_array(Cast_a_row($Chess_Board_A));
echo"<hr>";


	for($Column=0;$Column<count($Chess_Board_A);$Column++){
		for($Row=0;$Row<count($Chess_Board_A[0]);$Row++){
			if($Column<4)
			$Chess_Board_A[$Column][$Row]="*";
			else if(($Column>3 && $Column<8)  &&  ($Row==1 || $Row==3 || $Row==6))
			$Chess_Board_A[$Column][$Row]="*";
			else
			$Chess_Board_A[$Column][$Row]=rand(0,9);
			
		}
	}

echo"<h3>模擬堆疊排列【隨機陣列>>步驟1：增加一行數字前】</h3>";
Print_array($Chess_Board_A);
echo"<hr>";
echo"<h3>模擬堆疊排列【隨機陣列>>步驟2：增加一行數字後】</h3>";
$Chess_Board_A=Cast_a_row($Chess_Board_A);
Print_array($Chess_Board_A);
echo"<hr>";


$Chess_Board_B=$Chess_Board_A;

echo"<hr>";
echo"<h3>模擬堆疊排列【隨機陣列>>步驟3：增加一行數字後再進行連消判斷】</h3>";
$Chess_Board_A=Determine($Chess_Board_A,$Chess_Board_B);////判斷連消
Print_array($Chess_Board_A);
echo"<hr>";
echo"<h3>模擬堆疊排列【隨機陣列>>步驟3-A：判斷連消後歸遞＃升冪】</h3>";
Print_array(insertion_sort($Sort="asc",$Chess_Board_A));
echo"<hr>";
echo"<h3>模擬堆疊排列【隨機陣列>>步驟3-B：判斷連消後歸遞＃降冪】</h3>";
Print_array(insertion_sort($Sort="desc",$Chess_Board_A));



//$contact=array(
//'gao'=>array('ID'=>1,'name'=>'高某','company'=>'A公司','addr'=>'北京市','phonenumber'=>'(010)98765432','email'=>'gao@mail.com'),
//'li'=>array('ID'=>2,'name'=>'李某','company'=>'B公司','addr'=>'上海市','phonenumber'=>'(021)98765432','email'=>'li@mail.com'),
//'ma'=>array('ID'=>3,'name'=>'馬某','company'=>'C公司','addr'=>'重慶市','phonenumber'=>'(023)98765432','email'=>'ma@mail.com'),
//'fan'=>array('ID'=>4,'name'=>'範某','company'=>'D公司','addr'=>'天津市','phonenumber'=>'(022)98765432','email'=>'fan@mail.com')
//);
//while(list($Key,$Value)=each($contact)){//鍵//值//陣
//	while(list($Name,$Info)=each($Value)){//
//		echo $Name.':'.$Info.'<br>';
//	}
//	echo"<hr>";
//}
?>
<head>
<style type='text/css'>
body{
background-color:000;
font-size:1.5em;
color:#FFF;
}

b{ 
color:red;
}



</head>
