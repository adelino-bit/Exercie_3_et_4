<?php
require_once "functions.php";
$message='';
$t_Phrase=[];
$errors = [];
if(isset($_POST['valider'])){
  $phrases = $_POST['phrases'];
  if (empty($phrases)) {
    $message='la saisi est obligatoire'; 
  }
  else {
  
    $phrases= preg_split('/([^.!?]+[.!?]+)/', $phrases, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

   
 
    for($i=0;$i<long_chaine($phrases);$i++){
        if(long_chaine($phrases[$i])>200){
            $errors[]= "La phrase ".($i+1)." a plus de 200caracteres";
           
        }
        $phrases[$i]=supp_spc_avant_apres($phrases[$i]);
        $pattern = '#\s+#';
        $replacement = ' ';
        $phrases[$i]= preg_replace($pattern,$replacement,$phrases[$i]);
                                        }
        if (!empty($errors)) {
            foreach ($errors as $key ) {
                echo $key.'<br>';
            }
        }
        else { #tout est bon
            foreach($phrases as $key)
            {
                $t_Phrase[]=ucfirst($key);
              
            }
        }

    
   
    
  }

 

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercie 4</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <div>
                <label for="">Remplissez ce champs</label><br>
                <textarea name="phrases" id="" cols="40" rows="10"></textarea>
                <p  style='color:red'><?= $message ?></p>
            </div>
            <div>
                <button type="submit" name="valider" >Valider</button>
                <button type="submit" name="annuler" >Annuler</button>
            </div>
            <br><br>
            <div>

                <textarea name="" id="" cols="40" rows="10"><?php foreach($t_Phrase as $key){ echo $key; }?></textarea>
            </div>

        </div>
    </form>
</body>
</html>