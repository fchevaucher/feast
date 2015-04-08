<?php include "../gsession.php" ?>
<html>
<head>
	<title>Awful hack</title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="/hack/js/my.js"></script>
	<script src="/hack/js/simpletabs.js"></script>
	<link rel="stylesheet" type="text/css" href="/hack/js/simpletabs.css"> 
	<style>
	input, button {
		display: block;
		margin: 5px 5px 10px 5px;
	}

	button {
		padding: 5px;
		font-family: sans-serif;
	}
	
	p {
		max-width: 500px;
		font-size: 0.75em;
	}
	</style>
</head>
<body>

	<h3>Dan's Hacks</h3>
	<h4>Please be careful.</h4>

	<div id="midblock">
		<h5>MID</h5>
		<input id="mid" type="text" size=10>
	</div>

	<div class="simpleTabs">
		<ul class="simpleTabsNavigation">
			<li><a href="#">Start</a></li>
			<li><a href="#">Load MID</a></li>
			<li><a href="#">Birthday</a></li>
			<li><a href="#">Alert</a></li>
			<li><a href="#">Mother Language</a></li>
			<li><a href="#">Contact Language</a></li>
			<li><a href="#">Referral notes</a></li>
			<li><a href="#">Delete</a></li>
		</ul>

		<div class="simpleTabsContent">
			<p>
				Enter in client name, hit load MID, and you can
				manually check or enter a new birthday or alert.
			</p>
			<p>
				Checking will always show the value as it is in the database.
				Setting will display some information at the bottom of the screen (for debugging!).
				Checking and setting will always affect the client with the MID currently shown, so
				make sure you've got the right one before getting wild.
			</p>
			<p>
				Let me know asap if anything blows up. It shouldn't, but I can never be sure how all
				the code I didn't write is going to behave. If everything goes well I can add in a couple
				more options.
			</p>
			<p>
				And before anyone asks, a "hack" is just a rough-and-ready kind
				of job. Nothing nefarious.
			</p>
		</div>

		<div class="simpleTabsContent">
			<div id="tabname">
				<h5>MID</h5>
				<label for="infirst">First name: </label>
				<input id="infirst" type="text">
				<label for="inlast">Last name: </label>
				<input id="inlast" type="text">
				<button onclick="loadmid()">Load MID</button>
			</div>
		</div>

		<div class="simpleTabsContent">
			<div id="tabbday">
				<h5>Birthday (yyyy-mm-dd)</h5>
				<div class="check">
					<label for="checkbday">Current birthday: </label>
					<input class="out" type="text">
					<button onclick="checkbday()">Check value</button>
				</div>
				<div class="set">
					<label for="setbday">Set to: </label>
					<input class="in" type="text">
					<button onclick="setbday()">Set value</button>
				</div>
			</div>
		</div>

		<div class="simpleTabsContent">
			<div id="tabalert">
				<h5>Alerts</h5>
				<div class="check">
					<label for="checkalert">Current alert: </label>
					<input class="out" type="text" size=50>
					<button onclick="checkalert()">Check value</button>
				</div>
				<div class="set">
					<label for="in">Set to: </label>
					<input class="in" type="text">
					<button onclick="setalert()">Set value</button>
				</div>
			</div>
		</div>

		<div class="simpleTabsContent">
			<div id="tabmlang">
				<h5>Main language</h5>
				<div class="check">
					<label for="checkmlang">Current : </label>
					<input class="out" type="text" size=50>
					<button onclick="checkmlang()">Check value</button>
				</div>
				<div class="set">
					<label for="in">Set to: </label>
					<input class="in" type="text">
					<button onclick="setmlang()">Set value</button>
				</div>
			</div>
		</div>

		<div class="simpleTabsContent">
			<div id="tabclang">
				<h5>Contact language</h5>
				<div class="check">
					<label for="checkclang">Current : </label>
					<input class="out" type="text" size=50>
					<button onclick="checkclang()">Check value</button>
				</div>
				<div class="set">
					<label for="in">Set to: </label>
					<input class="in" type="text">
					<button onclick="setclang()">Set value</button>
				</div>
			</div>
		</div>

		<div class="simpleTabsContent">
			<div id="tabrnotes">
				<h5>Referral notes</h5>
				<div class="check">
					<label for="checkrnotes">Current: </label>
					<input class="out" type="text" size=120>
					<button onclick="checkrnotes()">Check value</button>
				</div>
				<div class="set">
					<label for="in">Set to: </label>
					<input class="in" type="text" size=120>
					<button onclick="setrnotes()">Set value</button>
				</div>
			</div>
		</div>
		<div class="simpleTabsContent">
			<div id="tabdel">
				<h5>Delete</h5>
				<div class="check">
					<button onclick="deleteclient()">Delete client</button>
				</div>
			</div>
		</div>
	</div>

	<div id="outblock">
		<h5>Output</h5>
		<input id="out" type="text" size=100>
	</div>

</body>
</html>
