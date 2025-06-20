<?php

namespace controller;

use model\Annonce;
use model\Annonceur;

class addItem{

    function addItemView($twig, $menu, $chemin, $cat, $dpt){
        echo $twig->render("add.html.twig", array(
            "breadcrumb" => $menu,
            "chemin" => $chemin,
            "categories" => $cat,
            "departements" => $dpt
        ));
    }

    function addNewItem($twig, $menu, $chemin, $allPostVars){

        date_default_timezone_set('Europe/Paris');

        function isEmail($email) {
            return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
        }

        /*
        * On récupère tous les champs du formulaire en supprimant
        * les caractères invisibles en début et fin de chaîne.
        */
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $ville = trim($_POST['ville']);
        $departement = trim($_POST['departement']);
        $categorie = trim($_POST['categorie']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        $password = trim($_POST['psw']);
        $password_confirm = trim($_POST['confirm-psw']);

        // Tableau d'erreurs personnalisées
        $errors = array();
        $errors['nameAdvertiser'] = '';
        $errors['emailAdvertiser'] = '';
        $errors['phoneAdvertiser'] = '';
        $errors['villeAdvertiser'] = '';
        $errors['departmentAdvertiser'] = '';
        $errors['categorieAdvertiser'] = '';
        $errors['titleAdvertiser'] = '';
        $errors['descriptionAdvertiser'] = '';
        $errors['priceAdvertiser'] = '';
        $errors['passwordAdvertiser'] = '';

//        $fileInfos = $_FILES["fichier"];
//        $fileName = $fileInfos['name'];
//        $type_mime = $fileInfos['type'];
//        $taille = $fileInfos['size'];
//        $fichier_temporaire = $fileInfos['tmp_name'];
//        $code_erreur = $fileInfos['error'];


//        switch ($code_erreur){
//            case UPLOAD_ERR_OK :
//                $destination = "$chemin/upload/$fileName";
//
//                if (move_uploaded_file($fichier_temporaire, $destination)){
//                    $message  = "Transfert terminé - Fichier = $nom - ";
//                    $message .= "Taille = $taille octets - ";
//                    $message .= "Type MIME = $type_mime";
//                } else {
//                   $message = "Problème de copie sur le serveur";
//                }
//                break;
//            case UPLOAD_ERR_NO_FILE :
//                $message = "Pas de fichier saisi";
//                break;
//            case UPLOAD_ERR_INI_SIZE :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (taille > upload_max_filesize.';
//                break;
//            case UPLOAD_ERR_FORM_SIZE :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (taille > MAX_FILE_SIZE.';
//                break;
//            case UPLOAD_ERR_PARTIAL :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (problème lors du transfert';
//                break;
//            case UPLOAD_ERR_NO_TMP_DIR :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (pas de répertoire temporaire).';
//                break;
//            case UPLOAD_ERR_CANT_WRITE :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (erreur lors de l\'écriture du fichier sur disque).';
//                break;
//            case UPLOAD_ERR_EXTENSION :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (transfert stoppé par l\'extension).';
//                break;
//            default :
//                $message  = "Fichier '$fileName' non transféré ";
//                $message .= ' (erreur inconnue : $code_erreur';
//        }

        // On teste que les champs ne soient pas vides et soient de bons types
        if(empty($nom)) {
            $errors['nameAdvertiser'] = 'Veuillez entrer votre nom';
        }
        if(!isEmail($email)) {
            $errors['emailAdvertiser'] = 'Veuillez entrer une adresse mail correcte';
        }
        if(empty($phone) && !is_numeric($phone) ) {
            $errors['phoneAdvertiser'] = 'Veuillez entrer votre numéro de téléphone';
        }
        if(empty($ville)) {
            $errors['villeAdvertiser'] = 'Veuillez entrer votre ville';
        }
        if(!is_numeric($departement)) {
            $errors['departmentAdvertiser'] = 'Veuillez choisir un département';
        }
        if(!is_numeric($categorie)) {
            $errors['categorieAdvertiser'] = 'Veuillez choisir une catégorie';
        }
        if(empty($title)) {
            $errors['titleAdvertiser'] = 'Veuillez entrer un titre';
        }
        if(empty($description)) {
            $errors['descriptionAdvertiser'] = 'Veuillez entrer une description';
        }
        if(empty($price) || !is_numeric($price)) {
            $errors['priceAdvertiser'] = 'Veuillez entrer un prix';
        }
        if(empty($password) || empty($password_confirm) || $password != $password_confirm) {
            $errors['passwordAdvertiser'] = 'Les mots de passes ne sont pas identiques';
        }

        // On vire les cases vides
        $errors = array_values(array_filter($errors));

        // S'il y a des erreurs on redirige vers la page d'erreur
        if (!empty($errors)) {

            $template = $twig->render("add-error.html.twig");
            echo $template->render(array(
                                    "breadcrumb" => $menu,
                                    "chemin" => $chemin,
                                    "errors" => $errors)
                                );
        }
        // sinon on ajoute à la base et on redirige vers une page de succès
        else{
            $annonce = new Annonce();
            $annonceur = new Annonceur();

            $annonceur->email = htmlentities($allPostVars['email']);
            $annonceur->nom_annonceur = htmlentities($allPostVars['nom']);
            $annonceur->telephone = htmlentities($allPostVars['phone']);

            $annonce->ville = htmlentities($allPostVars['ville']);
            $annonce->id_departement = $allPostVars['departement'];
            $annonce->prix = htmlentities($allPostVars['price']);
            $annonce->mdp = password_hash ($allPostVars['psw'], PASSWORD_DEFAULT);
            $annonce->titre = htmlentities($allPostVars['title']);
            $annonce->description = htmlentities($allPostVars['description']);
            $annonce->id_categorie = $allPostVars['categorie'];
            $annonce->date = date('Y-m-d');


            $annonceur->save();
            $annonceur->annonce()->save($annonce);


            $template = $twig->render("add-confirm.html.twig");
            echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
        }
    }
}