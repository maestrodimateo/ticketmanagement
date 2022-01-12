<div class="justify-content-center m-3" data-page = "new_ticket" id="page">
    <div class="d-flex align-items-center justify-content-center">
        <div class="bg-white shadow border-0 rounded border-light p-4 w-50 ">
            <?php if (session('flash')): ?>
                <p class="alert alert-success text-center"><?= session('flash') ?></p>
            <?php endif ?>
            <div class="text-center text-md-center mb-4 mt-md-0">
                <h1 class="mb-0 h3">Déclarer un ticket</h1>
            </div>
            <form action="/nouveau-ticket" method="POST" name="new_ticket">
                <!-- Catégorie de panne -->
                <div class="form-group mb-4"><label for="title">Type de panne</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag">
                                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line>
                            </svg>
                        </span>
                        <select name="category" id="caution" class="form-control" required>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->label ?>"><?= $category->label ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <?= error('<span class = "text-danger">{category}</span>') ?>
                </div>

                <!-- La panne en question -->
                <div class="form-group mb-4"><label for="bug">De quelle panne s'agit-il ?</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag">
                                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line>
                            </svg>
                        </span>
                        <select name="bug" id="bug" class="form-control" required>
                            <?php foreach($bugs as $bug): ?>
                                <option value="<?= $bug->label ?>"><?= $bug->label ?></option>
                            <?php endforeach ?>
                            <option value="Autre...">Autre...</option>
                        </select>
                    </div>
                    <?= error('<span class = "text-danger">{bug}</span>') ?>
                </div>

                <!-- La description du ticket si choisi autre-->
                <div class="form-group d-none" id="description_block">
                    <div class="form-group mb-4">
                        <label for="description">Décrivez la panne s'il vous plaît</label>
                        <textarea class="form-control" rows = "5" name="description" id="description"
                            placeholder="Décrivez la nature de votre problème"></textarea>
                            <?= error('<span class = "text-danger">{description}</span>') ?>
                    </div>
                </div>

                <!-- Le niveau d'urgence du ticket -->
                <div class="form-group mb-4"><label for="caution">Niveau d'urgence</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <svg class="icon icon-xs text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                                <circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </span>
                        <select name="emergency_level" id="emergency_level" class="form-control" required>
                            <option value="1">Faible</option>
                            <option value="2">Moyen</option>
                            <option value="3">Elevé</option>
                        </select>
                    </div>
                    <?= error('<span class = "text-danger">{emergency_level}</span>') ?>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-gray-800">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>