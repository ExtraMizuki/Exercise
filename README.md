# Exercise
<form action="BlackJack.htm" method="get" enctype="application/x-www-form-urlencoded" name="form" id="form">
<input type="submit" name="button" class="button" id="button" value="發牌">
<input class="button" type="button" value="攤牌" onclick="Scoring(Play_Score , Makers_Score)">
</form>
<form>
<input class="button" type="button" value="刪除cookie重起新局" onclick=" DelCookie() ">
<input class="button" type="button" value="查看cookie內容" onclick="alert(document.cookie)">

</form>


<head><meta charset="UTF-8" />
<script>



var Play_Round=[];//設定紀錄玩家回合數的Array
var Makers_Round=[];//莊家

function Get_Poker_Array(){//判斷Cookie內 是否存在上一局剩餘樣本
if( GetCookie("Cookie_Poker_Array") != null){
var Cookie_Poker_Array =GetCookie("Cookie_Poker_Array");
var Get_Poker_Array = Cookie_Poker_Array.split(",");//字串輸出轉為陣列
document.write("<h3>原本機率空間樣本數<br>【"+Poker_Array+"】</h3>");
Poker_Array=Get_Poker_Array
}
return Poker_Array
}



function randomsort(a, b) {//亂數排列
return Math.random()>.5 ? -1 : 1; 
}

var Poker_Array = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52];
Get_Poker_Array();//載入前一局剩餘樣本數



var Poker_Array = Poker_Array.sort(randomsort);//利用 sort 方式進行亂數排列

document.write("<h3>此局剩餘機率空間樣本數<br>【"+Poker_Array+"】</h3>");


var Play=Poker_Array[Math.floor(Math.random()*Poker_Array.length)];//從陣列中隨機選出一個元素值＃玩家
var Makers = Poker_Array[Math.floor(Math.random()*Poker_Array.length)];//＃莊家



if(GetCookie("Cookie_Play_Round") !=null && GetCookie("Cookie_Play_Round") !=null){
var Cookie_Play_Round= GetCookie("Cookie_Play_Round");
Play_Round=Cookie_Play_Round.split(",");

var Cookie_Makers_Round= GetCookie("Cookie_Makers_Round");
Makers_Round=Cookie_Makers_Round.split(",");
}



Play_Round.push(Play);//將此局產生牌碼增添到陣列尾端
Makers_Round.push(Makers);

document.write("<h3>＊【J-Q-K點數為10分】</h3><hr>");
document.write("<h3>【莊家此局牌碼】"+Makers+"</h3>");
document.write("<h3>【玩家此局牌碼】"+Play+"</h3>");


document.write("<h2>顯示莊家牌局</h2><hr>");
var count
for(count in Makers_Round){//一種 JS迴圈寫法
document.write("<img src='BlackJack/"+Makers_Round[count]+".jpg'>莊家-");
}



document.write("<h2>顯示玩家牌局</h2><hr>");
count=0
for(count in Play_Round){
document.write("<img src='BlackJack/"+Play_Round[count]+".jpg'>玩家-");
}


function checkAdult(age){//設定用條件函數
return age != Play && age != Makers;
}

Poker_Array=Poker_Array.filter(checkAdult);//過濾所有能通過自訂函數條件的陣列元素 刪除符合條件的元素「刪除已出過牌的」後 並產生新的陣列

function Score_Compute(Value){
var Poker_JQK=[11,12,13,24,25,26,37,38,39,50,51,52];//紀錄歸類牌組中 花色是J/O/K的編號集合
var Score=0

var JQK_check=false;

for(counter=0;counter<=Poker_JQK.length;counter++){
if(Value==Poker_JQK[counter]){
JQK_check=true;
}
}

//不知為何—indexOf公用函數 有時會失去效用，待查明
//if(Poker_JQK.indexOf(Value)!= -1){//查詢此局產生的牌碼數 是否在J/Q/K 集合陣列的成員中 //若元素不再該陣列中則會返回-1

if(JQK_check===true){
Score=10	//J/Q/K的點數為10分
}else if(10>=Value && Value>=1){//梅花1-10
Score=Value
}else if(23>=Value && Value>=14){//方塊1-10
Score=Value-13
}else if(36>=Value && Value>=27){//紅心1-10
Score=Value-26
}else if(49>=Value && Value>=40){//黑桃1-10
Score=Value-39
}else{
document.write("<h3> Error if any one of the arguments is invalid </h3>");
}
return Score
}



var Makers_Score=Score_Compute(Makers);//計算分數
var Play_Score=Score_Compute(Play);



////嘗試撈取Cookie值//由值是否存在歸納是否為判斷開局
if( GetCookie("Makers_Sum_Score") != null){//嘗試撈取Cookie值//判斷是值否存在
var Cookie_Makers_Score =GetCookie("Makers_Sum_Score");
var Cookie_Play_Score= GetCookie("Play_Sum_Score");


Cookie_Makers_Score2=parseInt(Cookie_Makers_Score);//由字串轉回數字
Cookie_Play_Score2=parseInt(Cookie_Play_Score);

Play_Score=parseInt(Play_Score);
Makers_Score=parseInt(Makers_Score);

//document.write("<h3>Makers_Score=="+Makers_Score+"</h3>");
//document.write("<h3> Play_Score=="+Play_Score+"</h3>");
//document.write("<h3>Cookie_Makers_Score=="+Cookie_Makers_Score2+"</h3>");
//document.write("<h3> Cookie_Play_Score=="+Cookie_Play_Score2+"</h3>");

Makers_Score= Cookie_Makers_Score2 + Makers_Score;
Play_Score= Cookie_Play_Score2 + Play_Score;

}



document.write("<h3>莊家累計分數：【"+Makers_Score+"】</h3>");
document.write("<h3>玩家累計分數：【"+Play_Score+"】</h3>");

if(Play_Score>21){
alert("【"+Play_Score+"】點，您的數值爆了！！");
}






function Scoring(Play_Score , Makers_Score){
if(Play_Score>21){
alert("【"+Play_Score+"】點，您的數值爆了！！");
}
if(Play_Score<21 && Makers_Score>21 ){
alert("玩家【"+Play_Score+"】點/莊家【"+Makers_Score+"】點，恭喜你贏了！！");
}
else if(Play_Score<21&& Makers_Score<21&&Play_Score>Makers_Score){
alert("玩家【"+Play_Score+"】點/莊家【"+Makers_Score+"】點，恭喜你贏了！！");
}else if(Play_Score<21&& Makers_Score<21&&Play_Score<Makers_Score){
alert("玩家【"+Play_Score+"】點/莊家【"+Makers_Score+"】點，你輸掉此局！！");
}else{
alert("data erro！");
}
DelCookie();
}






var expires = new Date();//記錄數據到cookie中
expires.setTime(expires.getTime() + 3600*12);//有效時間保存 1小時
document.cookie="Makers_Sum_Score=" + Makers_Score + ";expires=" + expires.toGMTString()//累積分數
document.cookie="Play_Sum_Score=" + Play_Score + ";expires=" + expires.toGMTString()
Cookie_Poker_Array=Poker_Array.join();//陣列剩餘樣本輸出轉為字串


document.cookie="Cookie_Poker_Array=" + Poker_Array.join() + ";expires=" + expires.toGMTString()
document.cookie="Cookie_Play_Round=" + Play_Round.join() + ";expires=" + expires.toGMTString()
document.cookie="Cookie_Makers_Round=" + Makers_Round.join() + ";expires=" + expires.toGMTString()






function GetCookie(name){//讀取cookies函数	
var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
if(arr != null) return unescape(arr[2]); return null;
}







function DelCookie() {//刪除cookies
//alert("進去了");
var exp = new Date();
exp.setTime(exp.getTime() - 1);
document.cookie ="Makers_Sum_Score"+ "=" + null + "; expires=" + exp.toGMTString();
document.cookie ="Play_Sum_Score"+ "=" + null + "; expires=" + exp.toGMTString();
document.cookie ="Cookie_Poker_Array"+ "=" + null + "; expires=" + exp.toGMTString();
document.cookie ="Cookie_Play_Round"+ "=" + null + "; expires=" + exp.toGMTString();
document.cookie ="Cookie_Makers_Round"+ "=" + null + "; expires=" + exp.toGMTString();
}




</script>






</head>







<style type="text/css">
body{
background: #94c4fe;
background: -webkit-gradient(linear, left top, left bottom, color-stop(31%,#94c4fe), color-stop(100%,#d3f6fe));
background: -webkit-linear-gradient(top,#94c4fe 31%,#d3f6fe 100%);
background: -moz-linear-gradient(top,#94c4fe 31%, #d3f6fe 100%);
background: -o-linear-gradient(top,#94c4fe 31%,#d3f6fe 100%);
background: -ms-linear-gradient(top,#94c4fe 31%,#d3f6fe 100%);
background: linear-gradient(to bottom,#94c4fe 31%,#d3f6fe 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#94c4fe', endColorstr='#d3f6fe',GradientType=0 );
}


.button {
border-top: 1px solid #96d1f8;
background: #65a9d7;
background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
background: -moz-linear-gradient(top, #3e779d, #65a9d7);
background: -ms-linear-gradient(top, #3e779d, #65a9d7);
background: -o-linear-gradient(top, #3e779d, #65a9d7);
padding: 5px 10px;
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
-webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
-moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
box-shadow: rgba(0,0,0,1) 0 1px 0;
text-shadow: rgba(0,0,0,.4) 0 1px 0;
color: white;
font-size: 1em;
font-family: Helvetica, Arial, Sans-Serif;
text-decoration: none;
vertical-align: middle;
}
.button:hover {
border-top-color: #28597a;
background: #28597a;
color: #ccc;
}
.button:active {
border-top-color: #1b435e;
background: #1b435e;
}


</style>
