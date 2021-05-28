<?php
ini_set("include_path", '/home/bistrita/php:' . ini_get("include_path") );

include('Mail.php');
include('Mail/mime.php');

$text = 'Text version of email';
$html = '<html><body>HTML version of email</body></html>';
$file = 'docs/Factura1.pdf';
$hdrs = array(
              'From'    => 'Bistrita Web Design<alex@bistrita-webdesign.ro>',
              'To'      => 'alex@bistrita-webdesign.ro',
              'Subject' => 'Factura1'
              );

$mime = new Mail_mime();

$mime->setTXTBody($text);
$mime->setHTMLBody($html);

$mime->addAttachment($file,'application/octet-stream');

$body = $mime->get();
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail', $params);
$mail->send('alex@bistrita-webdesign.ro', $hdrs, $body); 

?>