<?php
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => 1,
		"iTotalRecords" => 100,
		"iTotalDisplayRecords" => 10,
		"aaData" => array()
	);
	
	while ( $i <= 100 )
	{

		$output['aaData'][] = ['engine' => 'test'.$i, 'browser' => 'test'.$i, 'platform'=> 'test'.$i, 'version'=> 'test'.$i, 'grade'=> 'test'.$i];
		$i++;
	}
	
	echo json_encode( $output );
?>
