<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/inscription/forminscription.php';

//----------------------------------------------------------------------------------------------
echo Nav('Inscription');
$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');// Appel de la class
?>
<form method="post" id="formInscription">
		<div class="container ">

			<h2> Inscription <h2>
			<div class="form-row">
				<div class="col-md-6">
					<label for="nom"> Nom : </label>
					<input type="nom" name="nom" id="nom" class="form-control" placeholder="Smith" >
				</div>
			
				<div class="col-md-6">
					<label for="prenom"> Prenom : </label>
					<input type="prenom" name="prenom" id="prenom" class="form-control" placeholder="Jean" >
				</div>
			</div>


			<div class="form-row">
				<div class="col-md-6">
					<label for="mail"> E-mail : </label>
					<input type="mail" name="mail" id="mail" class="form-control" placeholder="nom@exemple.com" > 
				</div>
			
				<div class="col-md-6">
					<label for="tel"> Télephone : </label>
					<input type="tel" name="tel" id="tel" class="form-control" placeholder="06 23 56 84 12 (optionel)" >
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-6">
					<label for="login"> Login : </label>
					<input type="login" name="login" id="login" class="form-control" placeholder="NomPrenom75" > 
				</div>
			
				<div class="col-md-6">
					<label for="password"> Mot de passe : </label>
					<input type="password" name="password" id="password" class="form-control" placeholder="6 caratère minimum">
				</div>
			</div>
            <div class="mb-3 text-center">
                <button class="btn btn-primary" name="submit" id="buttonInscription" type="button"> Valider l'inscription </button>
            </div>

			
		</div>
		<div class="Messages"></div>
</form>
<?php
echo Footer();
?>

<script>
    $(document).ready(function(){
        $("#buttonInscription").click(function() {
            var Nomuser = $("input[name=nom]").val();
            var PrenomUser = $("input[name=prenom]").val();
            var mail = $("input[name=mail]").val();
            var tel = $("input[name=tel]").val();
            var login = $("input[name=login]").val();
            var pwd = $("input[name=password]").val();

            var form_data = new FormData();
            form_data.append('nom',Nomuser);
            form_data.append('prenom',PrenomUser) ;
            form_data.append('mail', mail);
            form_data.append('tel',tel);
            form_data.append('login',login);
            form_data.append('password',pwd);
            
            $.ajax({
                type: "post",
                dataType : 'json',
                url: "getinscription.php",
                cache: false,
                contentType: false,
                processData: false,
                data:form_data,
                success: function(data, statut){
                    console.log(data.check)
                    // Contenue en cas de réussite
                        $(".Messages").children().remove();
                        if (data.check.errorMessage){
                            
                            $('.Messages').append(`
                                <div class="alert alert-danger text-center mt-4" role="alert">
                                    Veuillez remplir les champs obligatoire!
                                </div>
                            `);
                        }else{
                        
                            if(data.check.mailExist){
                                $('.Messages').append(`
                                    <div class="alert alert-danger text-center mt-4" role="alert">
                                        L'adresse mail est déjà prise !
                                    </div>
                                `);
                            }
                            if(data.check.loginExist){
                                $('.Messages').append(`
                                    <div class="alert alert-danger text-center mt-4" role="alert">
                                        Le login est déjà pris !
                                    </div>
                                `);
                            }
                            if(data.check.inscriptionOk){
                                $('.Messages').append(`
                                    <div class="alert alert-success text-center mt-4" role="alert">
                                       	Vous êtes bien inscris! Rendez-vous <a href="formconnexion.php">ici</a> pour accéder à votre compte
                                    </div>
                                `);
                                $('#formInscription')[0].reset();
                            }
                        }   
                        
                }
            });
        });
    });
</script>
