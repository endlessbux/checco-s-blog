<?php
	require('util/utils.php');
	echo start('Login | Checco', 'login-specs.php');


	$user	=	'';
	$pass	=	'';
	$usererr	=	'';
	$userbord	=	'';
	$passerr	=	'';
	$passbord	=	'';

	if(isset($_POST['sent'])){
		$user	=	$_POST['user'];
		$pass	=	$_POST['pass'];

		if(strlen($user)<1 || strlen($pass)<1){
			if(strlen($user)<1){
				$usererr	=	'<small class="form-text text-muted" err="user-login">Manca il <strong>nome utente</strong>.</small>';
				$userbord	=	' border border-danger';
			}
			if(strlen($pass)<1){
				$passerr	=	'<small class="form-text text-muted" err="pass-login">Manca la <strong>password</strong>.</small>';
				$passbord	=	' border border-danger';
			}
		}else{
			$mysqli	=	db_connection();
		}
	}

	$form	=	'<div class="v-wrap">
					<div class="v-middle">
						<form class="form-signin" method="post" action="'.$_SERVER['PHP_SELF'].'">
							<div class="text-center mb-4">
								<h1 class="h3 mb-3 font-weight-normal">Login</h1>
								<p>Non hai un account? <a href="registrazione.php">Registrati</a></p>
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
							<div class="checkbox mb-3">
								<label>
									<input type="checkbox" name="ricordami" value="remember-me"> Ricordami
								</label>
							</div>
							<button class="btn btn-lg btn-primary btn-block" type="submit" name="sent">Accedi</button>
						</form>
					</div>
				</div>';

	echo $form;
	echo fin();
?>
