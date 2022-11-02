<?php
namespace App\Controllers;

use App\core\View;
use App\Helpers\Mail;
use App\Form\ContactForm;
use App\Helpers\StringHelper;
use App\Form\Validator\ContactValidator;
use App\Repository\SocialNetworkRepository;


class HomeController{

    public function index($urlParam){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $contactForm = (new ContactForm)->build();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = ContactValidator::checkForm($contactForm, $_POST);

			// send errors
			if ($validation && count($validation) > 0) {
				return View::render('home.html.php', [
                    "socials" => $socialnetworks,
                    "form" => $contactForm,
                    "validation" => $validation
                ]);
			}

            // send email
            $mail = new Mail();
            $mail->sendTo("seb.blog.openclassrooms@gmail.com");
            $mail->subject("Message de contact");
            $mail->message("<h1>Bonjour Admin, Vous avez un nouveau message</h1>
                <p>De : " . StringHelper::sanitize($_POST['firstname']). " " . StringHelper::sanitize($_POST['lastname']) . "</p>
                <p>Envoyé le : " .date('d/m/Y'). "</p>
                <p>Contenu : " . StringHelper::sanitize($_POST['message']) . "</p>"
            );

            if (!$mail->send()) {
                return View::render('home.html.php', [
                    "socials" => $socialnetworks,
                    "socials" => $socialnetworks,
                    "form" => $contactForm,
                    "validation" => [
                        "Votre email n'a pas été envoyé, veuillez re-essayer ulterieurement"
                    ]
                ]);
            }

            $success = "votre message a bien été envoyé";
        }


        return View::render('home.html.php', [
            "socials" => $socialnetworks,
            "form" => $contactForm,
            "success" => isset($success) ? $success :  ""
        ]);
    }

    public function resume(){

        $file = '/public/uploads/fichier.pdf'; 
            
        header('Content-type: application/pdf'); 
        header('Content-Disposition: attached; filename="sebastien_flouvat_cv"'); 
        header('Content-Transfer-Encoding: binary'); 
        header('Accept-Ranges: bytes');    
    }
}