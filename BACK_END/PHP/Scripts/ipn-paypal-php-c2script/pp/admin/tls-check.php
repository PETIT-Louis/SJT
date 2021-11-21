<?php
/*
* Ce fichier, une fois lanc� permet de v�rifier si votre site se connecte bien � PayPal pour les IPN
* Cette page doit afficher: PayPal_Connection_OK
* Si la page affiche pas PayPal_Connection_OK, les erreurs suivantes peuvent �tre mentionn�es: HTTPS ou HTTP/1.1 ou TLS 1.2 (SHA-256)
* Pour obtenir le message PayPal_Connection_OK, vous devez avoir HTTPS, HTTP/1.1 et TLS 1.2 (SHA-256)/OpenSSL en version 1 ou sup�rieur
*/
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://tlstest.paypal.com/"); 
curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__,2) . '/cert/tls.pem');
// Some environments may be capable of TLS 1.2 but it is not in their list of defaults so need the SSL version option to be set.
// Certains environnements peuvent �tre compatibles avec TLS 1.2 mais ils ne figurent pas dans leur liste de param�tres par d�faut, donc l'option de version SSL doit �tre d�finie. 
curl_setopt($ch, CURLOPT_SSLVERSION, 6);//TLSv1_2 (6)
curl_exec($ch);
echo "\n";
if ($err = curl_error($ch)) {
	var_dump($err);
	echo "DEBUG INFORMATION:\n###########\n";
	echo "CURL VERSION:\n";
	echo json_encode(curl_version(), JSON_PRETTY_PRINT);
}