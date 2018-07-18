<?php

namespace App;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Userstamps
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function create(array $tabs)
    {
        foreach ($tabs as $tab) {
            Schema::table($tab, function (Blueprint $table) {
                $table->unsignedInteger('created_by')->nullable()->default(null)->after('created_at');
                $table->unsignedInteger('updated_by')->nullable()->default(null)->after('updated_at');
                $table->unsignedInteger('deleted_by')->nullable()->default(null)->after('deleted_at');
                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('updated_by')->references('id')->on('users');
                $table->foreign('deleted_by')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public static function drop(array $tabs)
    {
        foreach ($tabs as $tab) {
            Schema::table($tab, function (Blueprint $table) {
                $table->dropForeign(['created_by']);
                $table->dropForeign(['updated_by']);
                $table->dropForeign(['deleted_by']);
                $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
            });
        }
    }
}
