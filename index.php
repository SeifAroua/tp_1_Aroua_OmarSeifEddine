<!DOCTYPE html>
<html>
<body>
    <h2>Salted Password</h2>
    <?php
    // Fonction pour valider et chiffrer le mot de passe
    function validationEtChiffrementDuMotDePasse($motdepasse){
        // Vérifie la longueur du mot de passe
        if (strlen($motdepasse) < 6 || strlen($motdepasse) > 10) {
            return "Attention le mot de passe n'est pas valide, la valeur doit avoir entre 6 et 10 caractères!";
        }
        // Sel 
        $salt = "7hd16af9";

        // Crée le mot de passe salé en ajoutant le sel aux extrémités du mot de passe
        $motdepassesalted = $salt . $motdepasse . $salt;

        // Hache le mot de passe salé pour le stockage sécurisé
        $motPasseEncrypte = password_hash($motdepassesalted, PASSWORD_DEFAULT);

        // Stocke le mot de passe haché dans une variable
        $motdepassestocker = $motPasseEncrypte;

        // Vérifie si le mot de passe salé entré correspond au mot de passe stocké
        if (password_verify($motdepassesalted, $motdepassestocker)) {
            return "le mot de passe est valide!";
        } else {
            return "le mot de passe n'est pas valide!";
        } 
    }
    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupère le mot de passe depuis le formulaire
        $password = $_POST["password"];

        // Appelle la fonction pour valider et chiffrer le mot de passe
        $message = validationEtChiffrementDuMotDePasse($password);

        // Affiche le message résultant
        echo "<p>$message</p>";
    }
    ?>
    <form method="post">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" autocomplete="off" required>
        <br>
        <br>
        <input type="submit" value="Tester le mot de passe">
    </form>
</body>
</html>
