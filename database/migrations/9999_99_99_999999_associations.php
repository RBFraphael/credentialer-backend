<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("password_recovery_tokens", function(Blueprint $table){
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();
        });

        Schema::table("clients", function(Blueprint $table){
            $table->foreign("logo_file_id")->references("id")->on("files")->cascadeOnDelete();
        });

        Schema::table("user_clients", function(Blueprint $table){
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("client_id")->references("id")->on("clients")->cascadeOnDelete();
        });

        Schema::table("projects", function(Blueprint $table){
            $table->foreign("client_id")->references("id")->on("clients")->cascadeOnDelete();
        });

        Schema::table("credentials", function(Blueprint $table){
            $table->foreign("project_id")->references("id")->on("projects")->cascadeOnDelete();
        });

        Schema::table("credential_files", function(Blueprint $table){
            $table->foreign("credential_id")->references("id")->on("credentials")->cascadeOnDelete();
            $table->foreign("file_id")->references("id")->on("files")->cascadeOnDelete();
        });

        // Schema::table("", function(Blueprint $table){
        //     $table->foreign("")->references("id")->on("");
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
