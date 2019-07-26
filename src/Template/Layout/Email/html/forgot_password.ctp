<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Forgot Passwod :: Spearline Labs</title>


	<style type="text/css" media="screen">
		body { padding:0 !important; margin:0 !important; display:block !important; -webkit-text-size-adjust:none; background-image:url(images/background.jpg); background-position:0 0; background-repeat:no-repeat repeat-y; font-size: 15px; font-family: "Arial, sans-serif";}
		a { color:#64972f; text-decoration:none; }

	</style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; -webkit-text-size-adjust:none; background-color: #FFF;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0"  id="the_container">
    <tr>
        <td width="33%"></td><td style="width:721px;"></td><td  width="33%"></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <table style="width:721px;" border="0" cellspacing="0" cellpadding="0" id="the_content">
                <tr>
                    <td width="50"></td>
            		<td align="center" valign="top">
                        <?=  $this->Html->image('spearline_email2.png', ['alt' => 'Spearline Labs Logo', 'fullBase' => true]); ?>
                    </td>
                    <td width="50"></td>
                </tr>
                <tr>
                    <td width="50"></td>
            		<td align="center" valign="top">
                        <p style="text-align: left; margin-top: 15px;">Hi <?= $user->name ?>,</p>
                        <p style="text-align: left;margin-top: 10px; margin-bottom: 10px;">We've received a request to reset your password. If you didn't make the request disregard this email. Otherwise you can reset your password using this link:</p>
                        <?= $this->Html->link(__("Click here to reset your password"), ["controller" => "User", "action" => "changeUserPassword", $random_string, '_full' => true], ["style"=>"height: 35px; padding-top:15px; width:100%; color:#FFF; display: block; background-color:#03A9F4; font-weight: bold; font-size:17px;"]) ?>
                    </td>
                    <td width="50"></td>
                </tr>
                <tr>
                    <td width="50"></td>
            		<td align="center" valign="top">
                        <p style="text-align: left; margin-top: 15px;margin-bottom: 25px;">Thanks, <br /> The Spearline Team</p>
                    </td>
                    <td width="50"></td>
                </tr>
                <tr>
                    <td width="50"></td>
            		<td align="center" valign="top">
                        <p style="text-align: left; color: #78909C;">THIS IS AN AUTOMATED EMAIL - PLEASE DO NOT REPLY TO THIS EMAIL</p>
                    </td>
                    <td width="50"></td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td>
    </tr>
    </table>
</body>
</html>
