/*
	File: standMove.js 
*/

/* global a, p1*/

function standMove(){

a.game(p1);

//show dealer cards face and value
// document.getElementById("00").innerHTML = JSON.stringify(a.prntHand());
document.getElementById("dealerscore").innerHTML = a.getTotScore();

// show dealer cards images after player press "stand"
	var dealerArray = JSON.parse(JSON.stringify(a.prntHand()));
    for(var i = 0; i < dealerArray.length; i++){
	document.getElementById("dimg"+i).src = dealerArray[i]+".jpg";
	document.getElementById("dimg"+i).style.visibility = "visible";
}

balance = p1.getBalance();
bet = p1.getBet();

if(a.getTotScore() > 21) {
	document.getElementById("result").innerHTML = "THE HOUSE BUST! YOU WIN";

	//add the bet to balance
	p1.addAmt(bet);
	document.getElementById('balance').innerHTML='$' + p1.getBalance();	


}else {
	if(a.getTotScore() > p1.getTotScore()) {
		document.getElementById("result").innerHTML = "YOU LOST";

		//remove the bet from balance
		p1.removeAmt(bet);
		document.getElementById('balance').innerHTML='$' + p1.getBalance();

	} else if(a.getTotScore() == p1.getTotScore()) {
		document.getElementById("result").innerHTML = "PUSH!";

	} else {
		document.getElementById("result").innerHTML = "YOU WIN";

		//add the bet to balance
	    p1.addAmt(bet);
	    document.getElementById('balance').innerHTML='$' + p1.getBalance();	
	}
}
	
}