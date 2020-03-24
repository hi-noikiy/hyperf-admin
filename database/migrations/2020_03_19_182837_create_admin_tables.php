<?php declare(strict_types=1);

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

/**
 * Create rbac tables
 */
class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up(): void
    {
        /**
         * admin_user
         */
        Schema::create('admin_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->tinyInteger('status')->default(1)->comment('状态: -1删除 0禁用 1正常');
            $table->timestamps();
        });

        /**
         * admin_role
         */
        Schema::create('admin_role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        /**
         * admin_permission
         */
        Schema::create('admin_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->string('http_method')->nullable();
            $table->text('http_path')->nullable();
            $table->timestamps();
        });

        /**
         * admin_menu
         */
        Schema::create('admin_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri', 50)->nullable();
            $table->string('permission')->nullable();

            $table->timestamps();
        });

        /**
         * admin_role_user
         */
        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        /**
         * admin_role_permission
         */
        Schema::create('admin_role_permission', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        /**
         * admin_user_permission
         */
        Schema::create('admin_user_permission', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
        });

        /**
         * admin_role_menu
         */
        Schema::create('admin_role_menu', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
        });

        /**
         * admin_operation_log
         */
        Schema::create('admin_operation_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip');
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_user');
        Schema::dropIfExists('admin_role');
        Schema::dropIfExists('admin_permission');
        Schema::dropIfExists('admin_menu');
        Schema::dropIfExists('admin_user_permission');
        Schema::dropIfExists('admin_role_user');
        Schema::dropIfExists('admin_role_permission');
        Schema::dropIfExists('admin_role_menu');
        Schema::dropIfExists('admin_operation_log');
    }
}
