// Looks like a lot of repetitive code, cuz it is.
// However, I anticipate having to make customizations
// later piece by piece, so this seems prudent.

function loadmid() {
    $.getJSON(
        "/hack/load.php", {
            firstname: $("#infirst").val(),
            lastname: $("#inlast").val()
        },
        function(data) {
			$("#mid").val(data.mid);
			checkbday();
			checkalert();
        }
    );
}

function checkval($mid, $field, $out) {
    $.getJSON(
        "/hack/load.php", {
            mid: $mid,
            field: $field
        },
        function(data) {
            $out.val(data.value);
        }
    );
}

function checkbday() {
	checkval(
			$("#mid").val(),
			"bday",
			$("#tabbday .out")
			);
}

function checkalert() {
	checkval(
			$("#mid").val(),
			"alertmsg",
			$("#tabalert .out")
			);
}

function checkmlang() {
	checkval(
			$("#mid").val(),
			"mlang",
			$("#tabmlang .out")
			);
}

function checkclang() {
	checkval(
			$("#mid").val(),
			"clang",
			$("#tabclang .out")
			);
}

function checkrnotes() {
	checkval(
			$("#mid").val(),
			"rNotes",
			$("#tabrnotes .out")
			);
}

function setval($mid, $field, $value, $out) {
    $.ajax(
        "/hack/save.php", {
            data: {
                mid: $mid,
                field: $field,
                value: $value
            },
            type: "GET",
            dataType: "json"
        }
    ).done(
			function(data) {checkval($mid, $field, $out); $("#out").val(data.error); }
		)
}

function setbday() {
	setval(
			$("#mid").val(),
			"bday",
			$("#tabbday .in").val(),
			$("#tabbday .out")
			);
}

function setalert() {
	setval(
			$("#mid").val(),
			"alertmsg",
			$("#tabalert .in").val(),
			$("#tabalert .out")
			);
}


function setmlang() {
	setval(
			$("#mid").val(),
			"mlang",
			$("#tabmlang .in").val(),
			$("#tabmlang .out")
			);
}

function setclang() {
	setval(
			$("#mid").val(),
			"clang",
			$("#tabclang .in").val(),
			$("#tabclang .out")
			);
}

function setrnotes() {
	setval(
			$("#mid").val(),
			"rNotes",
			$("#tabrnotes .in").val(),
			$("#tabrnotes .out")
			);
}

function deleteclient() {
    $.ajax(
        "/hack/delete.php", {
            data: {
                mid: $("#mid").val(),
            },
            type: "GET",
            dataType: "json"
        }
    ).done(
        function(data) {
            $("#out").val(data.error);
        }
    );
}
