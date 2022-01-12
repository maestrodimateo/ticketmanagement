<!DOCTYPE html>
<html lang="fr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Connexion à la plateforme</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link type="text/css" href="/assets/vendor/notyf/notyf.min.css" rel="stylesheet">
    <link type="text/css" href="/assets/css/volt.css" rel="stylesheet">
</head>

<body>
	<main>
		<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
			<div class="container">

				<div class="row justify-content-center form-bg-image">

					<div class="col-12 d-flex align-items-center justify-content-center">
						<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							<div class="text-center text-md-center mb-4 mt-md-0">
								<?php if (session('flash')): ?>
									<p class="alert alert-danger text-center"><?= session('flash') ?></p>
								<?php endif ?>
								<h1 class="mb-0 h3">Connectez-vous à votre plateforme</h1>
							</div>
							<form action="/login" class="mt-4" method="POST">
								<div class="form-group mb-4">
									<label for="email">Email</label>
									<div class="input-group">
										<span class="input-group-text" id="basic-addon1">
											<svg class="icon icon-xs text-gray-600" 
											fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
												<path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
												<path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
											</svg>
										</span>
										<input type="email" class="form-control" name="mail" placeholder="example@company.com" id="email" autofocus required>
									</div>
									<?= error('<p class = "text-danger">{mail}</p>') ?>
								</div>

								<div class="form-group">
									<div class="form-group mb-4"><label for="password">Mot de passe</label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon2">
												<svg class="icon icon-xs text-gray-600" fill="currentColor" 
													viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
														clip-rule="evenodd"></path>
												</svg>
											</span>
											<input type="password" placeholder="Password" name = "password" class="form-control" id="password" required>
										</div>
										<?= error('<p class = "text-danger">{password}</p>') ?>
									</div>
								</div>
								<div class="d-grid">
									<button type="submit" class="btn btn-gray-800">Connexion</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

    <script src="/assets/vendor/%40popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/notyf/notyf.min.js"></script>
</body>

</html>