<?php
use App\Controllers\TicketController;
use App\Controllers\Auth\UserController;
use App\Controllers\CategoryController;

// Auth routes
$router->group(['middlewares' => ['guest']], [
    $router->get('/', [UserController::class, 'index']),
    $router->post('/login', [UserController::class, 'login']),
]);

$router->post('/logout', [UserController::class, 'logout'])->setMiddleware(['auth']);

// Agent and admin routes
$router->group(['middlewares' => ['auth']], [
    $router->get('/nouveau-ticket', [TicketController::class, 'create']),
    $router->post('/nouveau-ticket', [TicketController::class, 'post']),
    $router->get('/mes-tickets-declares', [TicketController::class, 'owner_ticket']),
    $router->get('/mes-tickets-assignes', [TicketController::class, 'my_tickets']),
    $router->get('/category/:label', [CategoryController::class, 'bugs']),
    $router->get('/ticket/:id', [TicketController::class, 'ticket']),
]);

// Admin routes
$router->group(['middlewares' => ['auth', 'is_admin']], [
    $router->get('/tickets-declares', [TicketController::class, 'all']),
    $router->post('/assigner', [TicketController::class, 'assign']),
    $router->post('/cloturer/:id', [TicketController::class, 'close_ticket']),
    $router->post('/supprimer-ticket/:id', [TicketController::class, 'delete']),
]);

