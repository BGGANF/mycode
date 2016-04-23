<?php 

$arr = [
		[
	 		'id' => 1,
            'name' => '默认分组',
            'parent_id' => 0,
            'sort' =>0				
		],
		[
			'id' => 2,
            'name' => '设置',
            'parent_id' => 0,
            'sort' => 0
		],
        [
            'id' => 3,
            'name' => '相关设置',
            'parent_id' => 2,
            'sort' => 0
        ],
        [
            'id' => 4,
            'name' => '设置1111',
            'parent_id' => 3,
            'sort' => 0
        ]


	];


$arr = recursion($arr);

/**
*递归  整合子孙数组
*@return $subs array
*/ 
function recursion($arr, $id = 0){
    $subs = array();    // 子孙数组
    foreach ($arr as $v) {
        if ($v['parent_id'] == $id) {
            $v['child'] = recursion($arr,$v['id']);
            $subs[] = $v;
        }
    }
    return $subs;
}


print_r($arr);



