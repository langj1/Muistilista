<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }
  
  $routes->get('/', function() {
    UserController::login();
  });

  $routes->post('/', function() {
    UserController::handle_login();
  });

  $routes->get('/muistilista', 'check_logged_in', function() {
    TehtavaController::muistilista();
  });

  $routes->post('/muistilista', 'check_logged_in', function() {
    TehtavaController::store();
  });

  $routes->get('/muistilista/uusi', 'check_logged_in', function() {
    TehtavaController::uusi();
  });

  $routes->get('/muistilista/:id/muokkaa', 'check_logged_in', function($id) {
    TehtavaController::muokkaa($id);
  });

  $routes->post('/muistilista/:id/muokkaa', 'check_logged_in', function($id) {
    TehtavaController::update($id);
  });

  $routes->post('/muistilista/:id/poista', 'check_logged_in', function($id) {
    TehtavaController::poista($id);
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/luokat', 'check_logged_in', function(){
    LuokkaController::luokat();
  });

  $routes->get('/luokat/:nimi', 'check_logged_in', function($nimi){
    LuokkaController::luokka($nimi);
  });

