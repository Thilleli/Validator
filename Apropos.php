<?php 
include_once 'function.php';
include_once './class/bdd/connexionbdd.php';

 //----------------------------------------------------------------------------------------------
	if (!empty($_SESSION['id_user'])) {
	echo Nav('Apropos'); //Menu de navigation
	

?>
	<h3>Valider ? Pour quoi faire concrètement ?</h3>
	<p>Si valider sa page web ne doit pas être un but, c'est souvent une étape primordiale pour éviter les problèmes d'affichages.</p>

	<p>En effet, en (X)HTML, les éléments ne peuvent pas contenir de listes, lesquelles ne peuvent pas contenir directement des éléments, lesquelles ne peuvent pas contenir du texte anonyme. Et cette erreur de validité HTML conduit directement au problème CSS... alors que beaucoup de gens, volontairement ou involontairement, ne se soucient pas de réaliser d'abord un site valide avant de s'occuper de sa présentation...</p>

	<p><strong>En cas de problème de rendu, toujours commencer par vérifier la validité du code (X)HTML</strong></p>

	<p>Un code invalide sera traité par chaque navigateur selon ses propres processus de traitement d'erreur, potentiellement variables de l'un à l'autre, car ils ne sont soumis actuellement à aucune spécification : à moins d'avoir une parfaite connaissance de ces processus pour chaque navigateur (ce qui est en fait illusoire actuellement, même à un très haut niveau d'expertise), on s'en remet donc en quelque-sorte au hasard pour déterminer l'arbre du document, c'est à dire la structure finale réelle de son document telle que le navigateur va l'utiliser pour le rendre à l'écran avec CSS et le manipuler avec JavaScript.</p> 
	<p>__ Les styles CSS, on l'ignore trop souvent, ne sont en effet pas appliqués au code HTML que vous avez écrit, mais au code tel qu'il a été interprété et corrigé par le navigateur, qui s'efforcera de rétablir un code valide et donc utilisable.__ Le résultat peut être très loin des attentes de l'auteur.</p>

	<p><strong>Pour les curieux, un exemple :</strong> ici, IE, FF et Opera considèrent que le paragraphe se ferme avant l'ouverture de la liste, et insèrent une balise avant le. Cette décision est logique dans la mesure où la balise de fermeture des paragraphes est optionnelle en HTML et où le document, même s'il est peut-être formellement en XHTML, est traité en tant que text/html. C'est d'ailleurs ce qui conduit ces trois navigateurs à adopter dans ce cas précis la même méthode de traitement de l'erreur, alors qu'ils auraient pu diverger.</p>

	<p>Firefox traite de même la fermeture finale de paragraphe en la transformant en vide. Opera, lui, fait directement disparaître le et ne génère rien dans l'arbre du document à ce point. Je n'ai pas vérifié quel était le choix fait par IE, mais on peut noter au passage que, dans tous ces navigateurs, il est totalement inutile de mettre une liste dans un paragraphe puisque cette structure invalide est obligatoirement neutralisée en HTML et (X)HTML traité comme tel.

	On se retrouve donc, au final, avec un premier paragraphe contenant du texte, suivi par une liste au contenu invalide, suivi par du texte anonyme (celui commençant par "Ainsi que tant d'autres hélas disparues..."), suivi éventuellement par un paragraphe vide.

	Tout à fait logiquement, le contenu de et le texte anonyme ne peuvent pas être stylés par une règle p {...} comme l'auteur le souhaitait, puisqu'ils ne sont pas dans un une fois le code corrigé par ces navigateurs.

	On a donc structuré et stylé pour rien, sauf que le navigateur et l'auteur ont dû travailler un peu plus que si le code avait été valide. C'est un très bel exemple, très simple, de la nécessité constante de ne travailler que sur des structures valides... et donc prévisibles et faisant gagner du temps , ce qui est tout l'intérêt des standards Web ;)</p>
			
<?php 
	}else{
		echo Nav('Apropos');
	
?>
	<h3>Valider ? Pour quoi faire concrètement ?</h3>
	<p>Si valider sa page web ne doit pas être un but, c'est souvent une étape primordiale pour éviter les problèmes d'affichages.</p>

	<p>En effet, en (X)HTML, les éléments ne peuvent pas contenir de listes, lesquelles ne peuvent pas contenir directement des éléments, lesquelles ne peuvent pas contenir du texte anonyme. Et cette erreur de validité HTML conduit directement au problème CSS... alors que beaucoup de gens, volontairement ou involontairement, ne se soucient pas de réaliser d'abord un site valide avant de s'occuper de sa présentation...</p>

	<p><strong>En cas de problème de rendu, toujours commencer par vérifier la validité du code (X)HTML</strong></p>

	<p>Un code invalide sera traité par chaque navigateur selon ses propres processus de traitement d'erreur, potentiellement variables de l'un à l'autre, car ils ne sont soumis actuellement à aucune spécification : à moins d'avoir une parfaite connaissance de ces processus pour chaque navigateur (ce qui est en fait illusoire actuellement, même à un très haut niveau d'expertise), on s'en remet donc en quelque-sorte au hasard pour déterminer l'arbre du document, c'est à dire la structure finale réelle de son document telle que le navigateur va l'utiliser pour le rendre à l'écran avec CSS et le manipuler avec JavaScript.</p> 
	<p>__ Les styles CSS, on l'ignore trop souvent, ne sont en effet pas appliqués au code HTML que vous avez écrit, mais au code tel qu'il a été interprété et corrigé par le navigateur, qui s'efforcera de rétablir un code valide et donc utilisable.__ Le résultat peut être très loin des attentes de l'auteur.</p>

	<p><strong>Pour les curieux, un exemple :</strong> ici, IE, FF et Opera considèrent que le paragraphe se ferme avant l'ouverture de la liste, et insèrent une balise avant le. Cette décision est logique dans la mesure où la balise de fermeture des paragraphes est optionnelle en HTML et où le document, même s'il est peut-être formellement en XHTML, est traité en tant que text/html. C'est d'ailleurs ce qui conduit ces trois navigateurs à adopter dans ce cas précis la même méthode de traitement de l'erreur, alors qu'ils auraient pu diverger.</p>

	<p>Firefox traite de même la fermeture finale de paragraphe en la transformant en vide. Opera, lui, fait directement disparaître le et ne génère rien dans l'arbre du document à ce point. Je n'ai pas vérifié quel était le choix fait par IE, mais on peut noter au passage que, dans tous ces navigateurs, il est totalement inutile de mettre une liste dans un paragraphe puisque cette structure invalide est obligatoirement neutralisée en HTML et (X)HTML traité comme tel.

	On se retrouve donc, au final, avec un premier paragraphe contenant du texte, suivi par une liste au contenu invalide, suivi par du texte anonyme (celui commençant par "Ainsi que tant d'autres hélas disparues..."), suivi éventuellement par un paragraphe vide.

	Tout à fait logiquement, le contenu de et le texte anonyme ne peuvent pas être stylés par une règle p {...} comme l'auteur le souhaitait, puisqu'ils ne sont pas dans un une fois le code corrigé par ces navigateurs.

	On a donc structuré et stylé pour rien, sauf que le navigateur et l'auteur ont dû travailler un peu plus que si le code avait été valide. C'est un très bel exemple, très simple, de la nécessité constante de ne travailler que sur des structures valides... et donc prévisibles et faisant gagner du temps , ce qui est tout l'intérêt des standards Web ;)</p>
<?php
	}echo Footer();
?>


