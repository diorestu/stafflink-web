<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $tableName = config('request-analytics.database.table', 'request_analytics');
        $connection = config('request-analytics.database.connection');
        
        // We'll add indexes via raw SQL with IF NOT EXISTS checks
        $indexes = [
            'request_analytics_visited_at_index' => ['visited_at'],
            'request_analytics_session_id_index' => ['session_id'],
            'request_analytics_path_index' => ['path'],
            'request_analytics_user_id_index' => ['user_id'],
            'request_analytics_request_category_index' => ['request_category'],
            'request_analytics_visited_at_session_id_index' => ['visited_at', 'session_id'],
            'request_analytics_path_visited_at_index' => ['path', 'visited_at'],
            'request_analytics_browser_visited_at_index' => ['browser', 'visited_at'],
            'request_analytics_operating_system_visited_at_index' => ['operating_system', 'visited_at'],
            'request_analytics_country_visited_at_index' => ['country', 'visited_at'],
        ];
        
        foreach ($indexes as $indexName => $columns) {
            try {
                $columnsList = implode(',', $columns);
                DB::connection($connection)->statement("ALTER TABLE $tableName ADD INDEX $indexName ($columnsList)");
            } catch (\Exception $e) {
                // Index might already exist, skip
            }
        }
    }

    public function down()
    {
        $tableName = config('request-analytics.database.table', 'request_analytics');
        $connection = config('request-analytics.database.connection');
        
        Schema::connection($connection)->table($tableName, function (Blueprint $table) {
            $table->dropIndex(['visited_at']);
            $table->dropIndex(['session_id']);
            $table->dropIndex(['path']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['request_category']);
            $table->dropIndex(['visited_at', 'session_id']);
            $table->dropIndex(['path', 'visited_at']);
            $table->dropIndex(['browser', 'visited_at']);
            $table->dropIndex(['operating_system', 'visited_at']);
            $table->dropIndex(['country', 'visited_at']);
        });
    }
};