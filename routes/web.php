<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('index'));

Route::get('/index.html', fn () => view('index'));
Route::get('/dashboard.html', fn () => view('dashboard'));
Route::get('/resident-management.html', fn () => view('resident-management'));
Route::get('/blotter-management.html', fn () => view('blotter-management'));
Route::get('/event-management.html', fn () => view('event-management'));
Route::get('/certificate-document-management.html', fn () => view('certificate-document-management'));
Route::get('/officials-management.html', fn () => view('officials-management'));
Route::get('/logs-history.html', fn () => view('logs-history'));

// Friendly non-.html aliases if you type routes manually.
Route::get('/dashboard', fn () => view('dashboard'));
Route::get('/resident-management', fn () => view('resident-management'));
Route::get('/blotter-management', fn () => view('blotter-management'));
Route::get('/event-management', fn () => view('event-management'));
Route::get('/certificate-document-management', fn () => view('certificate-document-management'));
Route::get('/officials-management', fn () => view('officials-management'));
Route::get('/logs-history', fn () => view('logs-history'));
