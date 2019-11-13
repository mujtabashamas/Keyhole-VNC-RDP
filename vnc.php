<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Threehunt</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/def.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/jquery.min.js"></script>
</head>

<body class="site siteparent">

<?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/keyhole/";

    if (isset($_GET["id"]) && !empty($_GET["id"])){
        $id = $_GET["id"];
    } else {
        $id = 1;
    }

    $vnc_url = $url . "/api/vnc/read_one.php?id=" . $id;
    $contents = file_get_contents($vnc_url);
    $vnc = json_decode($contents);
    $ip = $vnc->ip;
    $mime = $vnc->mime;
    $image_data = $vnc->image_data;
    $org = $vnc->org;
    $city = $vnc->city;
    $timestamp = $vnc->timestamp;
    $formattedDate = date( "Y/m/d", strtotime($timestamp));

    if($id == 1){
        $prev = $id;
        $next = $id + 1;
    } else {    
        $prev = $id - 1;
        $next = $id + 1;
    }
?>

    <div style="padding: 20px" id="tooppbar">
        <table width="100%">
            <tr>
                <td align="left" valign="top" width="10%" nowrap="nowrap"><a href="<?php echo $url; ?>vnc.php?id=<?php echo $prev;?>"
                        class="button">Previous KeyHole</a></td>
                <td align="center" valign="top">
                    <a href="<?php echo $url; ?>vnc.php?id=<?php echo rand(1,200);?>" class="button">Random KeyHole</a>
                </td>
                <td align="right" valign="top" width="10%" nowrap="nowrap"><a href="<?php echo $url; ?>vnc.php?id=<?php echo $next; ?>"
                        class="button">Next KeyHole</a>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="10%" nowrap="nowrap">
                    <p>IP: <?php echo $ip;?></p>
                    <p>Protocol: VNC</p>
                    <p>Org: <?php echo $org; ?></p>
                    <p>City: <?php echo $city; ?></p>
                    <p>Timestamp: <?php echo $formattedDate; ?></p>
                </td>
                <td align="center" valign="top">
                    <p style="margin: 10px;font-weight: bold;font-size: 18px;">Keyhole IP <?php echo $ip;?></p>
                    <a href="<?php echo $url; ?>rdp.php" class="button">RDP</a>
                    <a href="<?php echo $url; ?>vnc.php" class="button">VNC</a>
                </td>
            </tr>
        </table>
    </div>
    <div style="text-align: center;margin: 30px;">
        <?php echo '<img  src="data:' .$mime.';base64,'.$image_data.'"/>' ?>;
    </div>
    <div style="margin: 50px"></div>

    <div id="bbar">
        <table width="100%">
            <tr>
            <img style="height:150px;margin-left:45%" src="assets/logo.png"/><br>
                <a style="text-decoration: none; color:white;margin-left:45%" href="https://cyberse.de/impressum/">Imprint</a>
                <a style="text-decoration: none; color:white;margin-left:2%" href="https://cyberse.de/datenschutzerklaerung/">Data Protection</a>
                <td style="text-align: center;">
                Powered by Threehunt © 2019 | a cyberse.de and a blacksudo.co project
                </td>
            </tr>
        </table>

    </div>
</body>

</html>