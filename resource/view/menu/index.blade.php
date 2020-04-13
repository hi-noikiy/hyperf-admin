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
                <h3 class="card-title">{{ trans("admin.menu") }}</h3>
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
                   @each('menu._list', $data['_menu'], 'item')
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