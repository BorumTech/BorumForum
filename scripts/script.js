function handleVoting() {

	let votedup = false;
	let voteddown = false;
	const voteUpBtn = document.getElementById('vote-up-btn');
	const voteDownBtn = document.getElementById('vote-down-btn');
	if (!(votedup || voteddown)) { // If the user has not voted
		voteUpBtn.onclick = () => { // and they vote up
			loadXMLDoc("up"); 
			votedup = true; 
		};
		voteDownBtn.onclick = () => { // and they vote down
			loadXMLDoc("down"); 
			voteddown = true;
		};
		console.log("Worked");
	} 
	while (votedup) { // If the user has voted up
		voteUpBtn.onclick = () => {
			loadXMLDoc("down");
			console.log(votedup, voteddown);
		};
		voteddown = false;
	}
	while (voteddown) {
		voteDownBtn.onclick = () => {
			loadXMLDoc("up");
		};
		votedup = false;
	}
}

