<?php




use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('completedDate');
            $table->string('requestedDate');
            $table->string('state');
            $table->integer('uId');

            $table->double('realOrganicQuantity');
            $table->double('realPlasticQuantity');
            $table->double('realPaperQuantity');
            $table->double('realGlassQuantity');
            $table->double('realMetalQuantity');
            $table->double('realElectronicQuantity');

            $table->double('expectedOrganicQuantity');
            $table->double('expectedPlasticQuantity');
            $table->double('expectedPaperQuantity');
            $table->double('expectedGlassQuantity');
            $table->double('expectedMetalQuantity');
            $table->double('expectedElectronicQuantity');

            $table->integer('areaId');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_requests');
    }
}
