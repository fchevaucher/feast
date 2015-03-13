function loadmid() {
    $.getJSON(
        "/hack/load.php", {
            firstname: $("#infirst").val(),
            lastname: $("#inlast").val()
        },
        function(data) {
            $("#out").val(data.mid);
			$(".mid").val(data.mid);
        }
    );
}

function loadfield() {
    $.getJSON(
        "/hack/load.php", {
            mid: $("#inmid").val(),
            field: $("#infield").val()
        },
        function(data) {
            $("#out").val(data.value);
        }
    );
}

function applychange() {
    $.ajax(
        "/hack/save.php", {
            data: {
                mid: $("#inmidset").val(),
                field: $("#infieldset").val(),
                value: $("#inval").val()
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

function deleteclient() {
    $.ajax(
        "/hack/delete.php", {
            data: {
                mid: $("#inmidset").val(),
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
