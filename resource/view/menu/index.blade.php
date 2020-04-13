<?php

    $title = '菜单';
    $description = '列表';
    $breadcrumb[] = ['text' => $title, 'url' => '/admin'];
?>
@include('layout.breadcrumb', compact('title', 'description', 'breadcrumb'))

<div class="row">
    <!-- Left col -->
    <section class="col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Card Refresh</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-source="/admin/menu">
                        <i class="fa fa-save"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/admin/menu" data-source-selector="#refresh_menu">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <span class="handle ui-sortable-handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <span class="text">首页</span>&nbsp;&nbsp;&nbsp;
                        <a href="/admin/auth/menu/8/edit">/admin</a>
                        <span class="float-right">
                            <a href="/admin/auth/menu/8/edit"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" data-id="8" class="tree_branch_delete"><i class="fas fa-trash"></i></a>
                        </span>
                    </li>
                    <li>
                        <span class="handle ui-sortable-handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <span class="text">系统管理</span>
                        <span class="float-right">
                            <a href="/admin/auth/menu/8/edit"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" data-id="8" class="tree_branch_delete"><i class="fas fa-trash"></i></a>
                        </span>
                    </li>
                    <li class="ml-4">
                        <span class="handle ui-sortable-handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <span class="text">菜单</span>&nbsp;&nbsp;&nbsp;
                        <a href="/admin/auth/menu/8/edit">/admin/menu</a>
                        <span class="float-right">
                            <a href="/admin/auth/menu/8/edit"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" data-id="8" class="tree_branch_delete"><i class="fas fa-trash"></i></a>
                        </span>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="d-none" id="refresh_menu">
            The body of the card after card refresh
        </div>
    </section>
</div>
<script type="text/javascript">
$(function() {
    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
    })
});
</script>