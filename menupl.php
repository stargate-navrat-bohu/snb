



<a href='hlavni.php?page=planety&vyber=1' id=a onMouseOver=Rozsvitit('a') onMouseOut=Zhasnout('a')>Základní stavby</a>&nbsp;&nbsp;
<a href='hlavni.php?page=planety&vyber=2' id=b onMouseOver=Rozsvitit('b') onMouseOut=Zhasnout('b')>Doplòkové stavby</a>&nbsp;&nbsp;
<a href='hlavni.php?page=planety3' id=c onMouseOver=Rozsvitit('c') onMouseOut=Zhasnout('c')>Seznam planet</a>&nbsp;&nbsp;
<a href='hlavni.php?page=planety4' id=d onMouseOver=Rozsvitit('d') onMouseOut=Zhasnout('d')>Osidlování planet</a>&nbsp;&nbsp;
<a href='hlavni.php?page=planety&vyber=5' id=f onMouseOver=Rozsvitit('f') onMouseOut=Zhasnout('f')>Banka</a>&nbsp;&nbsp;


<?


if(($zaznam1[rasa]!=11 and $zaznam1[rasa]!=0 and $zaznam1[status]==1) or ($zaznam1[rasa]!=11 and $zaznam1[rasa]!=0 and $zaznam1[status]==5)){
	echo "<a href='hlavni.php?page=planety&vyber=3' id=e onMouseOver=Rozsvitit('e') onMouseOut=Zhasnout('e')>Centrální planety</a>";
}

?>

