<?php
	include("../../../db_con.php");
	date_default_timezone_set("UTC"); 
	$curryear = date('Y');

	$year_set = mysqli_query($connection, "SELECT year(docu_tr_date_create) AS YR FROM t_document_track");
	while($row = mysqli_fetch_assoc($year_set))
	{
		$ReqYear = $row["YR"];

	}
	$ReqYear;

	if($curryear == $ReqYear)
	{
			$code_ret = mysqli_query($connection, "SELECT MAX(docu_tr_ID) FROM t_document_track");
			$getrow = mysqli_fetch_array($code_ret);
			$lastcount = $getrow[0];
			$finalno = $lastcount + 1;
			$modified = str_pad($finalno,5,"0",STR_PAD_LEFT);
		    $ticketno = $curryear.''.$modified;

		    //echo $ticketno;
	}
	else if($curryear != $ReqYear)
	{
			
			$lastcount = 0;
			$finalno = $lastcount + 1;
			$modified = str_pad($finalno,5,"0",STR_PAD_LEFT);
		    $ticketno = $curryear.''.$modified;
		    
		    //echo $ticketno;
	}
	
?>