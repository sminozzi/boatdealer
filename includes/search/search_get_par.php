<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 				

					$year = $_GET['meta_year'];
					$con = $_GET['meta_con'];
					$price = $_GET['meta_price'];
                  
                    
					if ($price != '') {
								if($price == '1') {						 
								$priceMin =	'';
								$priceMax = 10000;
								}elseif ($price == '2') {						 
								$priceMin =	10000;
								$priceMax = 20000;
								}elseif ($price == '3') {						 
								$priceMin =	20000;
								$priceMax = 30000;
								}elseif ($price == '4') {						 
								$priceMin =	30000;
								$priceMax = 50000;
								}elseif ($price == '5') {						 
								$priceMin =	50000;
								$priceMax = 75000;
								}elseif ($price == '6') {						 
								$priceMin =	75000;
								$priceMax = 100000;
								}elseif ($price == '7') {						 
								$priceMin =	100000;
								$priceMax = 125000;
								}elseif ($price == '8') {						 
								$priceMin =	125000;
								$priceMax = 150000; 								
								}elseif ($price == '9') {						 
								$priceMin =	150000;
								$priceMax = 200000; 								
								}elseif ($price == '10') {						 
								$priceMin =	200000;
								$priceMax = 9999999999; 
								}								
							}elseif ($price == ''){
							$priceMax = 9999999999;	
							$priceMin = '';
							}
                    
                    $priceMin = (int)$priceMin;
					$priceMax = (int)$priceMax;
					if ($con == '') {$conKey = ''; $conVal =''; $conName = ''; $con= ''; }
					if ($con != '') {$conKey = 'key'; $conVal ='value'; $conName = 'boat-con'; $con= $con; }							


                    if ($year == '') {$yearKey = ''; $yearVal =''; $yearName = ''; $year= ''; }
					if ($year != '') {$yearKey = 'key'; $yearVal ='value'; $yearName = 'boat-year'; $year= $year; }							
