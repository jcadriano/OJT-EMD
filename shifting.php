<!-- Defines the operator's shift, if the time is >= 6:00 AM OR <= 18:00 (6:00 PM) then the operator's shift is day shift. Else, the operator's shift is night shift -->
<?php
    date_default_timezone_set("Asia/Manila");
    // echo date("H:i:s");
    if ((date('H:i') >= '6:00') || (date('H:i') < '18:00')) {
        $shift = "Day Shift";
        echo "<p>" . $shift . "</p>";
        // echo "<img src='../images/sun.png' alt='$shift' style='width: 5vw;'>";
    } else {
        $shift = "Night Shift";
        echo "<p>" . $shift . "</p>";
        // echo "<img src='../images/night.png' alt='$shift' style='width: 5vw;'>";
    }
?>

<input type="hidden" id="shift" name="shift" value="<?php echo $shift; ?>">

<!-- This script is for changing the <th> colors of the Shift field -->
<script type="text/javascript">
    var shift = document.getElementById('shift').value;
    var shiftContainer = document.getElementById('shifting');
    if (shift == 'Day Shift') {
        shiftContainer.style.backgroundColor="#FDDB54";
        shiftContainer.style.color="#000000";
    } else {
        shiftContainer.style.backgroundColor="black";
        shiftContainer.style.color="#FFFFFF";
    }
</script>