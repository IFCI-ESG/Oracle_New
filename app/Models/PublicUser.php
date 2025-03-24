<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicUser extends Model
{
    public function up()
    {
        Schema::create('public_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('pan');
            $table->string('designation');
            $table->string('cin');
            $table->text('address');
            $table->timestamps();
            $table->bigIncrements('id')->change();
        });
    }
    
}
