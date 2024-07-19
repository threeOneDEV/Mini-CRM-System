<?php

namespace controllers\offers;

use models\Comment;
use models\Contact;
use models\Offer;

class OfferController{
    public function index(){
        $offerModel = new Offer;
        $contactModel = new Contact;
        $commentModel = new Comment;
        $offers = $offerModel->getAllOffers();
        $contacts = $contactModel->getAllContacts();
        $comments = $commentModel->getAllComments();
        include('app/views/offers/index.php');
    }

    public function store($params){
        $offerModel = new Offer;
        $commentModel = new Comment;
        $contactModel = new Contact;
        $users_id = $params['id_first'];
        $contacts_id = $params['id_second'];

        if(isset($_POST['button_make_offer'])){
            $offerModel->add($_POST, $users_id,$contacts_id);         
            $data['description'] = 'СДЕЛАНО КОММЕРЧЕСКОЕ ПРЕДЛОЖЕНИЕ';
            $commentModel->add($data,$users_id,$contacts_id);
            header('Location: /contacts');
        }

        if(isset($_POST['button_submit_comment'])){
            $commentModel = new Comment;
            $commentModel->add($_POST,$users_id,$contacts_id);
            header('Location: /offers');
        }
    }
}