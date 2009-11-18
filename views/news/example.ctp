<?php
// vim: set ts=4 sts=4 sw=4 si noet:

// construct first grid with minimal required options

$gridId = 'news';

$url = Router::url(array(
	'controller' => 'news',
	'action' => 'get_news',
	'ext' => 'json',
	)
);

echo $jqgrid->grid($gridId);

echo $jqgrid->script($gridId, array(
	'url' => $url,
	)
);

?>

<p />

<?php

// construct second grid with some addition options

$gridId = 'news2';

echo $jqgrid->grid($gridId, array(
	'modelName' => 'News',
	'exportToExcel' => true, 
	'filterToolbar' => true,
	'filterMode' => 'like', // valid values are 'like'|'exact'
	'exportOptions' => array(
		'type' => 'csv',
		'filename' => 'news.csv',
		)
	)
);

// create the javascript to initialize the grid with some additional config:
// - 'width', 
// - date formatter within the colModel section 
// - callback handler for loadComplete event
// - display User.created_by to demonstrate relationship and Containable use
echo $jqgrid->script($gridId, array(
	'url' => $url,
	'width' => 500,
	'colModel' => array(
			array(
				'width' => 50,
				'index' => 'News.id',
				'name' => 'News.id',
				'label' => 'Id',
			),
			array(
				'index' => 'News.title',
				'name' => 'News.title',
				'label' => 'Title',
			),
			array(
				'index' => 'News.body',
				'name' => 'News.body',
				'label' => 'Body',
			),
			array(
				'index' => 'News.created',
				'name' => 'News.created',
				'label' => 'Created',
				'formatter' => 'date',
				'formatoptions' => array(
					'srcformat' => 'Y-m-d H:i:s',
					'newformat' => 'd-M-Y H:i:s',
					),
			),
			array(
				'index' => 'User.login',
				'name' => 'User.login',
				'label' => 'Created By',
			),
		),
//	'loadComplete' => '<script>function() { console.log("grid #' . $gridId . ' loaded."); }</script>',
	)
);
