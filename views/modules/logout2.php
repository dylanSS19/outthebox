 

<?php
echo '<script>

sessionStorage.clear();

var cookie = document.cookie.split(";");

// for (var i = 0; i < cookie.length; i++) {

    // var chip = cookie[i],
        // entry = chip.split("="),
        // name = entry[0];

    // document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
// }

window.location="landing";


</script>';

session_destroy();
session_commit();

