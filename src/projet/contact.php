<?php
	require_once "../includeprojet/header.inc.php";
    echo head();
?>
        <div id="pageContent" class="oneCol contact">
            <main>
                <h1>Contactez-nous</h1>
                <p>Merci de compléter le formulaire suivant pour nous contacter. Tous les champs de ce formulaire sont requis.</p>
                <form id="frmContact" action="merci.php">
                    <div>
                        <div>
                            <label for="fName">Prénom</label>
                            <input type="text" name="fName" id="fName" required autofocus />
                        </div>
                        <div>
                            <label for="lName">Nom de famille</label>
                            <input type="text" name="lName" id="lName" required />
                        </div>
                        <div>
                            <label for="email">Votre e-mail</label>
                            <input type="email" name="email" id="email" required />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="message">Votre message</label>
                            <textarea name="message" id="message" required></textarea>
                        </div>
                    </div>
                    <button type="submit">Envoyer</button>
                </form>
            </main>
        </div><!--Ici se termine le #pageContent-->
        <?php
	require_once "../includeprojet/footer.inc.php";
    echo footer();
?>