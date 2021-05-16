<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/connexion/formconnexion.php';

//----------------------------------------------------------------------------------------------
echo Nav('Connexion');
$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');// Appel de la class
?>
<form method="post" id="formConnexion">
		<div class="container ">

			<h2> Connectez-vous <h2>

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
                <button class="btn btn-primary" name="submit" id="buttonConn" type="button"> Accéder à mon compte </button>
            </div>

			
		</div>
		<div class="Messages"></div>
</form>
<?php
echo Footer();
?>

<script>
    $(document).ready(function(){
        $("#buttonConn").click(function() {
            var login = $("input[name=login]").val();
            var pwd = $("input[name=password]").val();

            var form_data = new FormData();

            form_data.append('login',login);
            form_data.append('password',pwd);
            
            $.ajax({
                type: "post",
                dataType : 'json',
                url: "getconnexion.php",
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
                                    Veuillez remplir tous les champs!
                                </div>
                            `);
                        }else{
                        
                            if(!data.check.UserExist){
                                $('.Messages').append(`
                                    <div class="alert alert-danger text-center mt-4" role="alert">
                                        Adresse mail ou mot de passe incorrect!
                                    </div>
                                `);
                            }
                            
                            if(data.check.ConnexionOk){

                               window.location.replace("pageProfile.php");
                            }
                        }   
                        
                }
            });
        });
    });
</script>
