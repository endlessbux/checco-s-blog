<?php
	require('util/utils.php');
	echo start('Registrazione | Checco', 'registrazione-specs.php');

	$user	=	'';
	$pass	=	'';
	$check	=	false;
	$usererr	=	'';
	$userbord	=	'';
	$passerr	=	'';
	$passbord	=	'';
	$checkerr	=	'';
	$checkcol	=	'';

	if(isset($_POST['sent'])){
		$user	=	$_POST['user'];
		$pass	=	$_POST['pass'];
		$check	=	$_POST['acconsento'];

		if(strlen($user)<6 || strlen($pass)<6 || !$check){
			if(strlen($user)<6){
				$usererr	=	'<small class="form-text text-muted" err="user-login">Il nome utente deve avere <strong>almeno 6 caratteri</strong>.</small>';
				$userbord	=	' border border-danger';
			}
			if(strlen($pass)<6){
				$passerr	=	'<small class="form-text text-muted" err="pass-login">La password deve avere <strong>almeno 6 caratteri</strong>.</small>';
				$passbord	=	' border border-danger';
			}
			if(!$check){
				$checkerr	=	'<small class="form-text text-muted" err="personal-data-checkbox">Questo campo è <strong>obbligatorio</strong></small>';
				$checkcol	=	' text-danger';
			}
		}else{
			$mysqli	=	db_connection();

			$sql	=	"SELECT * FROM utenti WHERE user='".$mysqli->real_escape_string($user)."'";
			$result	=	$mysqli->query($sql);
			if($result->num_rows<1){
				$options = [
				    'cost' => 8,
				    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
				];
				$sql	=	"INSERT INTO utenti (user, pass, salt) VALUES ('".$mysqli->real_escape_string($user)."','".$mysqli->real_escape_string(password_hash($salt.$pass,PASSWORD_BCRYPT,$options))."','".$mysqli->real_escape_string($options['salt'])."')";
				echo $sql;
			}else{
				$usererr	=	'<small class="form-text text-muted" err="user-login">Nome utente già in uso.</small>';
				$userbord	=	' border border-danger';
			}
		}
	}


	$form	=	'<div class="v-wrap">
					<div class="v-middle">
						<form class="form-signin" method="post" action="'.$_SERVER['PHP_SELF'].'">
							<div class="text-center mb-4">
								<h1 class="h3 mb-3 font-weight-normal">Registrazione</h1>
								<p>Sei già registrato? <a href="login.php">Accedi</a></p>
							</div>'.$usererr.'
							<div class="form-label-group">
								<input id="user-login" type="text" name="user" class="form-control'.$userbord.'" placeholder="Nome utente" value="'.$user.'">
								<label for="user-login">Nome utente</label>
							</div>'.$passerr.'
							<div class="input-group">
								<div class="form-label-group input-group-prepend btn-append">
									<input id="pass-login" type="password" name="pass" class="form-control'.$passbord.'" placeholder="Password" value="'.$pass.'">
									<label for="pass-login">Password</label>
								</div>
								<div class="form-label-group input-group-append">
									<a class="btn btn-dark rounded-right text-white pw-toggle" toggle="#pass-login">
										<i id="toggle-icon" class="fas fa-eye"></i>
									</a>
								</div>
							</div>
							<div class="checkbox mb-3">'.$checkerr.'
								<label class="'.$checkcol.'">
									<input class="required-checkbox" id="personal-data-checkbox" type="checkbox" name="acconsento" value="personal-data"> Acconsento al trattamento dei dati personali
								</label>
							</div>
							<button class="btn btn-lg btn-primary btn-block" type="submit" name="sent">Accedi</button>
						</form>
					</div>
				</div>';

	echo $form;
	echo fin();
?>
