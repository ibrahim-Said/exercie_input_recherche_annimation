<?php
use \app\Session;
use \app\Autoloader;
use \app\Validator;
use \app\Form;
require('../app/Autoloader.php');
Autoloader::register();
$form=new Form($_POST);
$valide=new Validator($_POST);
$session=Session::getinstance();
$errors=array();
if($_POST){
    $valide->isAlpha('Prenom','votre champ prenom est invalide');
    $valide->isAlpha('Nom','votre champ nom est invalide');
    $valide->isEmail('Email','votre champ email est invalide');
    $valide->isTel('Telephone','votre champ telephone est invalide');
    $valide->isAlpha('Message','votre champ message est invalide');
    if($valide->isValide()){
        $msg='je suis'.$_POST['Prenom'].' '.$_POST['Nom'].' mon email est :'.$_POST['Email'].' je vous contact pour vous informer que :'.$_POST['Message'].' Tel:'.$_POST['Telephone'];
        mail('reciver@gmail.com','subject',$msg);
        $session->setFlush('success','votre message a ete envoyer avec succé merci !');
        header('location:contact.php');
        exit();
    }else{
        $errors=$valide->getErrors();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> page contact</title>
</head>
<link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.css">
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Contactez-nous</h2>
            <br>
            <?php
            //var_dump($errors);
            if($errors):
                ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php
                        foreach ($errors as $k):
                            ?>
                            <li>
                                <?=$k;?>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
            <?php
            endif;
            ?>
            <?php
            if($session->hasFlush()):
                foreach ($session->getFlush() as $k=>$v):
                    ?>
                    <div class="alert alert-<?=$k;?>">
                        <?=$v;?>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
            <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <?=$form->input('text','Prenom');?>
                </div>
                <div class="col-md-6">
                    <?=$form->input('text','Nom');?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?=$form->input('email','Email');?>
                </div>
                <div class="col-md-6">
                    <?=$form->input('Tel','Telephone');?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=$form->input('textarea','Message');?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?=$form->submit('Envoyer');?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
