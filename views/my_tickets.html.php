<?php use App\Models\Ticket; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4" data-page = "my_tickets" id="page">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Liste des vos tickets assignés</h2>
    </div>
</div>
<div class="table-settings mb-4">
    <?php if (session('flash')): ?>
        <p class="alert alert-success text-center"><?= session('flash') ?></p>
    <?php endif ?>
    <div class="row justify-content-between align-items-center">
        <div class="col-9 col-lg-8 d-md-flex">
            <select class="form-select fmxw-200 d-none d-md-inline" aria-label="Message select example 2">
                <option selected="selected">Tout</option>
                <option value="2">Cloturé</option>
                <option value="3">En cours</option>
            </select>
        </div>
    </div>
</div>
<div class="card card-body shadow border-0 table-responsive mb-5">
    <div class="d-flex mb-3"><select class="form-select fmxw-200" aria-label="Message select example">
            <option selected="selected" disabled>Actions groupés</option>
            <option value="1">Desélectionner</option>
            <option value="2">Supprimer</option>
        </select> <button class="btn btn-sm px-3 btn-secondary ms-3">Valider</button>
    </div>

    <table class="table user-table table-hover align-items-center" id="datatable" aria-describedby="Mes tickets">
        <thead>
            <tr>
                <th scope="col" class="border-bottom"></th>
                <th scope="col" class="border-bottom">Reférence</th>
                <th scope="col" class="border-bottom">Libellé</th>
                <th scope="col" class="border-bottom">Etat</th>
                <th scope="col" class="border-bottom">Urgence</th>
                <th scope="col" class="border-bottom">Déclaré le</th>
                <th scope="col" class="border-bottom">Action</th>
            </tr>
        </thead>
        <tbody id="table-id">
            <?php foreach($assigned_tickets as $ticket): ?>
                <tr>
                    <td>
                        <div class="form-check dashboard-check">
                            <?php if ($ticket->state != Ticket::CLOSED ): ?>
                                <input class="form-check-input" type="checkbox" value="" id="userCheck2">    
                            <?php endif ?>
                            <label class="form-check-label" for="userCheck2"></label>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-id="<?= $ticket->id ?>">
                            <?= $ticket->reference() ?>
                        </button>
                    </td>
                    <td><span class="fw-normal"><?= $ticket->bug ?></span></td>
                    <td>
                        <span class="badge badge-sm bg-primary">
                        <?= $ticket->getState() ?>
                        </span>
                    </td>
                    <td><span class="badge badge-sm <?= $ticket->getLevel()['color'] ?>"><?= $ticket->getLevel()['title'] ?></span></td>
                    <td><span><?= $ticket->created_at() ?></span></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                    </path>
                                </svg>
                                <span class="visually-hidden">Liste déroulante</span>
                            </button>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                <?php if ($ticket->state != Ticket::CLOSED ): ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Desélectionner
                                    </a>
                                <?php endif ?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <svg class="dropdown-icon text-danger me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?= includes('includes/_modal') ?>