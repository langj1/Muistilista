<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/lisaa', function() {
    HelloWorldController::lisaa();
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


