<?php
/*
* Supprime les anciennes donn�es enregistr�es dans la base de donn�es lors de la venue sur la page bouton-de-paiement.php
* On part du principe qu'un lien peut �tre valide pendant 1 journ�e environ, en g�n�rale, l'utilisateur clic puis paye et valide la transaction
* Pour �viter l'insertion d'une ligne dans la table pp_transaction lors de la venu sur la page du bouton, il est pr�f�rable de faire un syst�me du genre: enregistrement d'une nouvelle ligne dans la base de donn�es, seulement quand l'utilisateur clic sur le bouton de paiement
* Ce fichier peut �tre lanc� automatiquement en tache cron chaque 24h
*/
$jours=2;//si 3 (par exemple): toutes les valeurs "date" > 3 jours seront supprim�es
//connexion � la base de donn�es:
$mysqli = mysqli_connect("localhost", "root", "pass", "base");
if(!$mysqli) {
	echo "Connexion non �tablie.";
	exit;
}
if(mysqli_query($mysqli,"DELETE FROM pp_transactions WHERE date<".(time()-($jours*86400)))) echo "OK";
else echo "KO: ".mysqli_error($mysqli);
