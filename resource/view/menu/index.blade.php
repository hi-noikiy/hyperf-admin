<?php

$title = '菜单';
$description = '列表';
$breadcrumb[] = ['text' => $title, 'url' => '/admin'];
?>
@include('layout.breadcrumb', compact('title', 'description', 'breadcrumb'))


