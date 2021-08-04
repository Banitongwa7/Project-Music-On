<?php
    $connect=new PDO("mysql:host=localhost;dbname=MaBase","root","");
    session_start();

    if (isset($_POST["news"]))
    {

    $data=array(':email_abonne' => $_POST["champnews"]);
    $query = "INSERT INTO abonne_newsletter (email_abonne) 
    SELECT * FROM (SELECT :email_abonne) as temp 
    WHERE NOT EXISTS (SELECT email_abonne FROM abonne_newsletter WHERE email_abonne = :email_abonne) LIMIT 1";
    $statement = $connect->prepare($query);
    $statement->execute($data);

    }

    function getName($connect, $user_id)
    {
        $query="SELECT * FROM Utilisateur WHERE Id_user=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($user_id));
        $fetch_data=$statement->fetch();
        return $fetch_data['nom_user'].' '.$fetch_data['prenom_user'];
    }

    function get_date(){
        return date("Y-m-d").' '.date("H:i:s",STRTOTIME(date('h:i:sa')));
    }

    function get_number($connect)
    {
        $query="SELECT id_musique FROM musique";
        $statement=$connect->prepare($query);
        $statement->execute();
        return intval($statement->rowCount());
    }

    function delete_id($connect, $id)
    {
        $query="delete from musique where id_musique=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($id));
    }
?>
