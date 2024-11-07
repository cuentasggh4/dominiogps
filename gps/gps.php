<?php
    if(isset($_GET['loc']))
    {
        $fp = fopen ("current_loc.txt", "w+");
        fwrite ($fp, $_GET['loc']."-".date('Y/m/d-H:i:s'));
        fclose ($fp);

        $fp = fopen ("all_loc.txt", "a+");
        fwrite ($fp, $_GET['loc']."-".date('Y/m/d-H:i:s')."\n");
        fclose ($fp);

        print "1";

        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>WiCardTech - GPS Locator</title>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, follow">

    <link rel="icon" type="image/png" href="icon.png">

    <style>
    </style>
</head>
<body>

	Last Update: <b id='lupdate'></b><span id='up'>Updating...</span>

    <br />

    <iframe style="width:100%;height:90vh;border:0;" id="map" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>

	<script src="jquery.js"></script>

   	<script type="text/javascript">
function update()
{
    $('#up').html('Updating...');

    
	$.get("current_loc.txt", function(d, s)
    {
        if(s == 'success')
        {
            var t = '-', loc = '', x, y, ind;
            
            if(d.length > 20)
            {
                ind = d.indexOf(',');
                
                y = d.substring(0, ind);
                x = d.substring(ind+1, d.indexOf('-'));
                t = d.substring(d.indexOf('-')+1);
                
                loc =  "https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d20825.9384569845!2d";
                loc += x;
                loc += "!3d";
                loc += y;
                loc += "!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m0!4m3!3m2!1d";
                loc += y;
                loc += "!2d";
                loc += x;
                loc += "!5e0!3m2!1sen!2s!4v1532349265755!5m2!1sen!2s";
                
                $('#up').html('');
            }
            else
                $('#up').html('No data');
            
            $('#lupdate').html(t);
            $('#map').attr('src', loc);
        }
        else
            $('#up').html('');
    });

    setTimeout(update, 20000);
}

setTimeout(update, 3000);
    </script>

</body>
</html>

