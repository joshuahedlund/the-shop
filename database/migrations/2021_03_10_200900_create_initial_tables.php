<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('email');
           $table->string('password_hash');
           $table->string('password_plain');
           $table->boolean('superadmin')->default(0);
           $table->string('shop_name');
           $table->string('remember_token',100)->nullable();

           $table->timestamps();

           $table->string('card_brand');
           $table->string('card_last_four',4);
           $table->timestamp('trial_ends_at')->nullable();
           $table->string('shop_domain');
           $table->boolean('is_enabled')->default(0);
           $table->string('billing_plan');
           $table->timestamp('trial_starts_at')->nullable();
        });

        Schema::create('products', function (Blueprint $table){
            $table->increments('id');
            $table->string('product_name');
            $table->text('description');
            $table->text('style');
            $table->text('brand');

            $table->timestamps();

            $table->string('url');
            $table->string('product_type');
            $table->unsignedSmallInteger('shipping_price');
            $table->text('note');

            $table->unsignedInteger('admin_id');
            $table->index('admin_id');
        });

        Schema::create('inventory', function (Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('product_id');
            $table->index('product_id');

            $table->unsignedMediumInteger('quantity')->default(0);
            $table->text('color');
            $table->text('size');
            $table->double('weight')->default(0);
            $table->unsignedMediumInteger('price_cents')->default(0);
            $table->unsignedMediumInteger('sale_price_cents')->default(0);
            $table->unsignedMediumInteger('cost_cents')->default(0);
            $table->string('sku');
            $table->double('length')->default(0);
            $table->double('width')->default(0);
            $table->double('height')->default(0);
            $table->text('note');

            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('product_id');
            $table->index('product_id');

            $table->unsignedInteger('inventory_id');
            $table->index('inventory_id');

            $table->text('street_address');
            $table->text('apartment');
            $table->text('city');
            $table->text('state');
            $table->string('country_code');
            $table->string('zip');
            $table->string('phone_number');
            $table->text('email');
            $table->string('name');
            $table->string('order_status');
            $table->text('payment_ref')->nullable();
            $table->string('transaction_id')->nullable();
            $table->unsignedMediumInteger('payment_amt_cents')->default(0);
            $table->unsignedMediumInteger('ship_charged_cents')->default(0)->nullable();
            $table->unsignedMediumInteger('ship_cost_cents')->default(0)->nullable();
            $table->unsignedMediumInteger('subtotal_cents')->default(0)->nullable();
            $table->unsignedMediumInteger('total_cents')->default(0)->nullable();
            $table->text('shipper_name');
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('shipped_date')->nullable();
            $table->text('tracking_number');
            $table->unsignedMediumInteger('tax_total_cents')->default(0)->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('products');
        Schema::dropIfExists('users');
    }
}
