<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <h2 class="h4">Liste des vos tickets déclarés</h2>
    </div>
</div>
<div class="table-settings mb-4">
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

    <table class="table user-table table-hover align-items-center" id="datatable" aria-describedby="Mes tickets">
        <thead>
            <tr>
                <th scope="col" class="border-bottom">Reférence</th>
                <th scope="col" class="border-bottom">Problème</th>
                <th scope="col" class="border-bottom">Description</th>
                <th scope="col" class="border-bottom">Etat</th>
                <th scope="col" class="border-bottom">Urgence</th>
                <th scope="col" class="border-bottom">Déclaré le</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tickets as $ticket): ?>
                <tr>
                    <td>
                        <a href="#" class="btn btn-secondary">
                            <span> Ticket_0<?= $ticket->id ?></span>
                        </a>
                    </td>
                    <td>
                        <span class="fw-normal"><?= $ticket->bug ?></span>
                    </td>
                    <td>
                        <span class="fw-normal"><?= $ticket->description ?></span>
                    </td>
                    <td>
                        <span class="badge badge-sm bg-primary">
                            <?= $ticket->getState() ?>
                        </span>
                    </td>
                    <td><span class="badge badge-sm <?= $ticket->getLevel()['color'] ?>"><?= $ticket->getLevel()['title'] ?></span></td>
                    <td><span><?= $ticket->created_at() ?></span></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>