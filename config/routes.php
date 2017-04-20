<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/lisaa', function() {
    HelloWorldController::lisaa();
  });
  
  $routes->get('/', function() {
    UserController::login();
  });

  $routes->post('/', function() {
    UserController::handle_login();
  });

  $routes->get('/muistilista', function() {
    TehtavaController::muistilista();
  });

  $routes->post('/muistilista', function() {
    TehtavaController::store();
  });

  $routes->get('/muistilista/uusi', function() {
    TehtavaController::uusi();
  });

  $routes->get('/muistilista/:id/muokkaa', function($id) {
    TehtavaController::muokkaa($id);
  });

  $routes->post('/muistilista/:id/muokkaa', function($id) {
    TehtavaController::update($id);
  });

  $routes->post('/muistilista/:id/poista', function($id) {
    TehtavaController::poista($id);
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

