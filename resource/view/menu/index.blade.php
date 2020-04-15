<?php
    $title = '菜单';
    $description = '列表';
    $breadcrumb[] = ['text' => $title, 'url' => '/admin'];
?>
@include('layout.breadcrumb', compact('title', 'description', 'breadcrumb'))
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('admin.menu') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/admin/menu" data-source-selector="#refresh_menu">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                            @each('menu._list', $data['_menu'], 'item')
                        </ul>
                    </div>
                </div>
                <div class="d-none" id="refresh_menu">
                    The body of the card after card refresh
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('admin.edit') }}</h3>
                    </div>
                    <form class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="asterisk col-sm-2 col-form-label">父级菜单</label>
                                <div class="input-group col-sm-10">
                                    <select class="form-control select2">
                                        <option selected="selected">ROOT</option>
                                        <option>┝&nbsp;首页</option>
                                        <option>┝&nbsp;系统菜单</option>
                                        <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┝&nbsp;用户管理</option>
                                        <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┝&nbsp;角色管理</option>
                                        <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┝&nbsp;权限管理</option>
                                        <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┝&nbsp;菜单管理</option>
                                        <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┝&nbsp;操作记录管理</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="asterisk col-sm-2 col-form-label">{{ trans('admin.title') }}</label>
                                <div class="input-group col-sm-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pencil-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="title" placeholder="{{ trans('admin.input') }} {{ trans('admin.title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="icon" class="asterisk col-sm-2 col-form-label">图标</label>
                                <div class="input-group col-sm-10">
                                    <div class="input-group-prepend iconpicker-container">
                                        <span class="input-group-text">
                                            <i class="fa fa-bars"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control icon iconpicker-element iconpicker-input" id="icon" name="icon" value="fa-bars" placeholder="输入 图标" required="1">
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <span class="help-block col-sm-10 col-form-label">
                                    <i class="fa fa-info-circle"></i>&nbsp;For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>
                                </span>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">路径</label>
                                <div class="input-group col-sm-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pencil-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="title" placeholder="{{ trans('admin.input') }} 路径">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="asterisk col-sm-2 col-form-label">角色</label>
                                <div class="input-group col-sm-10">
                                    <select class="select2" multiple="multiple" data-placeholder="选择角色">
                                        <option>管理员</option>
                                        <option>普通用户</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="asterisk col-sm-2 col-form-label">权限</label>
                                <div class="input-group col-sm-10">
                                    <select class="form-control select2">
                                        <option>所有权限</option>
                                        <option>菜单</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">{{ trans('admin.new') }}</button>
                            <button type="submit" class="btn btn-primary float-right">{{ trans('admin.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>