<?php

	$category_result = [];
	$data_result = [];

	while ($cat_res = mysqli_fetch_assoc($category_query)) {
		array_push($category_result, $cat_res);
	}
	echo json_encode(['category' => category_result, 'data' => $data_result]);

?>