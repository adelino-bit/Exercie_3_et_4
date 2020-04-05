<?php
require_once "functions.php";

    $message = '';
    $nbrChamps = '';
    if (isset($_POST['valider'])){
        $nbrChamps = $_POST['nbre'];
        if (!is_chaine_numeric($nbrChamps)){
            $message = '*Veuillez saisir un entier !';
            $nbrChamps = 0;
        }elseif (is_empty($nbrChamps)) {
            $message = '*Champ obligatoire';
        }
    }

    $T_mots = [];
    $errors = [];
    $motsAvecM = [];

    if (isset($_POST['Resultat'])){
        $nbrChamps =$_POST['nbre'];
            for ($i=0;$i<$nbrChamps;$i++){
                $mot = $_POST['mot_'.($i)];
                $T_mots[] = $mot;
                if (long_chaine($mot)>20){
                    $errors[$i][] = 'Le mot ne doit pas dépasser 20 caractères';
                }
                if (!is_chaine_alpha($mot)){
                    $errors[$i][] = 'Seules les lettres sont permises';
                }
                if (is_car_present_in_chaine(supp_spc_avant_apres($mot),' ')){
                    $errors[$i][] = 'Un seul mot';
                }
                if (isset($errors[$i]) && empty($errors[$i])){
                    unset($errors[$i]);
                }
                if(is_empty($mot)){
                    $errors[$i][] = 'Champ vide';
                }
            }
            if (empty($errors)){
                foreach ($T_mots as $m){
                    if (is_car_present_in_chaine('M',$m)){
                        $motsAvecM[] = $m;
                    }
                }
            }

    }

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 3</title>
</head>
<body>
<form action="" method="POST">
    <div >
        <div>
            <label for="nbre"> Saissez le nombre de champs</label>
            <input type="text" autocomplete="off" value="<?= $nbrChamps ?>"  name="nbre" id="nbre" >
            <p  style='color:red'><?= $message ?></p>
        </div>
        <div>
            <button type="submit" name="valider" >Valider</button>
            <button type="submit" name="annuler" >Annuler</button>
        </div>
    </div>
    <div>
        <?php for ($i=0;$i<$nbrChamps;$i++){ ?>
        <div>
            <label for="">Mot N°<?= $i+1 ?></label>
            <span style='color:red'><?= isset($errors[$i]) ? '( '. print_error($errors[$i]) .' )' : '' ?></span>
            <input type="text" autocomplete="off" value="<?= isset($T_mots[$i]) ? $T_mots[$i] : '' ?>" name="mot_<?= $i ?>">
        </div>
        <?php } ?>
    </div>
    <?php if ($nbrChamps && empty($message)){ ?>
    <div>
        <button type="submit" name="Resultat" >Résultats</button>
    </div>
    <?php } ?>
</form>

<?php if (empty($errors) && isset($_POST['Resultat'])){ ?>
    <div">
        <div>
            <p style="color:darkolivegreen;font-weight:bold">Vous avez saisi <?= $nbrChamps ?> Mot(s) dont <span><?= count($motsAvecM) ?> avec la lettre M</span></p>
        </div>
    </div>
<?php } ?>

</body>
</html>