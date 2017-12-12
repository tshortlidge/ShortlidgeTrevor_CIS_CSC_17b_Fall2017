/*
	File: hitMove.js 
*/

/*global a, p1*/

function hitMove(){
	p1.hit();

    //show player cards face and value after hit
	// document.getElementById("01").innerHTML = JSON.stringify(p1.prntHand());
	document.getElementById("score_01").innerHTML = p1.getTotScore();

    //show palyer cards images after hit
	var handArray = JSON.parse(JSON.stringify(p1.prntHand()));
    for(var i = 0; i < handArray.length; i++){
	document.getElementById("img"+i).src = handArray[i]+".jpg";
	document.getElementById("img"+i).style.visibility = "visible";
}
    
    //get the balance and the bet 
	balance = p1.getBalance();
	bet = p1.getBet();
	if(p1.getTotScore() == 21) {
		document.getElementById("result").innerHTML = "You BJ!";

		//add the bet to balance
		p1.addAmt(bet);
	    document.getElementById('balance').innerHTML='$' + p1.getBalance();	


	} else if(p1.getTotScore() > 21) {
		document.getElementById("result").innerHTML = "You BUST!";

		//remove the bet from balance
		p1.removeAmt(bet);
		document.getElementById('balance').innerHTML='$' + p1.getBalance();
	}
}