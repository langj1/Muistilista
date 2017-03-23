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

  $routes->get('/muistilista', function() {
    HelloWorldController::mistilista();
  });

  $routes->get('/lisaa', function() {
    HelloWorldController::lisaa();
  });
