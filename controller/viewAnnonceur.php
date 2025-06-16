<?php
/**
 * Created by PhpStorm.
 * User: ponicorn
 * Date: 26/01/15
 * Time: 00:25
 */

namespace controller;
use model\Annonce;
use model\Annonceur;
use model\Photo;

class viewAnnonceur {
    protected $annonceur; // Ajout de la propriété

    public function __construct(){
    }

    function afficherAnnonceur($twig, $menu, $chemin, $n, $cat) {
        $this->annonceur = Annonceur::find($n);
        if(!isset($this->annonceur)){
            echo "404";
            return;
        }
        $tmp = Annonce::where('id_annonceur','=',$n)->get();

        $annonces = [];
        foreach ($tmp as $a) {
            $a->nb_photo = Photo::where('id_annonce', '=', $a->id_annonce)->count();
            if($a->nb_photo>0){
                $a->url_photo = Photo::select('url_photo')
                    ->where('id_annonce', '=', $a->id_annonce)
                    ->first()->url_photo;
            }else{
                $a->url_photo = $chemin.'/img/noimg.png';
            }
            $annonces[] = $a;
        }
        echo $twig->render("annonceur.html.twig", array(
            'nom' => $this->annonceur,
            "chemin" => $chemin,
            "annonces" => $annonces,
            "categories" => $cat
        ));
    }
}