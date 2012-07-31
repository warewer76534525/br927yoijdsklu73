<?php

function news_type($type)
{
	if($type == 1)
	{
		return '<span class="label label-important">Breaking News</span>';
	}
	else if($type == 3)
	{
		return '<span class="label label-info">Pengumuman</span>';
	}
	else
	{
		return '<span class="label">Regular</span>';
	}
}

function news_type_array()
{
	return array(
			'1' => 'Breaking News',
			'2' => 'Regular',
			'3' => 'Pengumuman'
		);
}

?>