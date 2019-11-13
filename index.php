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

<?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
?>

<body class="site siteparent">

    <div style="padding: 20px;margin-bottom:65px" id="tooppbar">
        <table width="100%">
            <tr>
                <td align="center" valign="top">
                    <img style="height:220px" src="assets/logo.png" alt="">    
                </td>

            </tr>
        </table>
    </div>
    <div style="text-align: center;">
    <a class="select" href="<?php echo $validURL; ?>rdp.php" class="button">RDP</a>
    <a class="select" href="<?php echo $validURL; ?>vnc.php" class="button">VNC</a>
        
    </div>
    <div style="margin: 50px"></div>

    <div id="bbar">
        <table width="100%">
            <tr>
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