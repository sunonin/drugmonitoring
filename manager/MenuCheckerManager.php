<?php

  function menuChecker($pointer) 
  {
    $menu = [
    	'dashboard'        => false, 
    	'suspects'         => false,
      'lgu_information'         => false,
      'reports'          => false,
      'masterlist'       => false,
      'statistics_status'       => false,
      'statistics_population'       => false,
      'statistics_age'       => false


    ];

    if (array_key_exists($pointer, $menu)) {
    	$menu[$pointer] = true;
    }


    return $menu;
  }


