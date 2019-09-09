<h2>Mot de passe oublié</h2>

<form action="" method="post">
    <label>Nom d'utilisateur</label>
    <input type="text" name="username" /><br />

    <label>Question secrète</label>
    <select name="question">
        <?php 
        $options = '';
        foreach ($selectOptions as $selectOption) {
            $options .= '<option value ="' . $selectOption . '">' . $selectOption . '</option>';
        }
        echo $options;
        ?>
    </select> <br>

    <label>Réponse</label>
    <input type="text" name="reponse" /><br />

    <input type="submit" value="Valider" />
</form>