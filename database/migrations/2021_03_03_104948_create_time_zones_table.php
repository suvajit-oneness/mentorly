<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            ['name' => 'Africa/Abidjan GMT +0:00'],
            ['name' => 'Africa/Accra GMT +0:00'],
            ['name' => 'Africa/Addis_Ababa GMT +3:00'],
            ['name' => 'Africa/Algiers GMT +1:00'],
            ['name' => 'Africa/Asmara GMT +3:00'],
            ['name' => 'Africa/Asmera GMT +3:00'],
            ['name' => 'Africa/Bamako GMT +0:00'],
            ['name' => 'Africa/Bangui GMT +1:00'],
            ['name' => 'Africa/Banjul GMT +0:00'],
            ['name' => 'Africa/Bissau GMT +0:00'],
            ['name' => 'Africa/Blantyre GMT +2:00'],
            ['name' => 'Africa/Brazzaville GMT +1:00'],
            ['name' => 'Africa/Bujumbura GMT +2:00'],
            ['name' => 'Africa/Cairo GMT +2:00'],
            ['name' => 'Africa/Casablanca GMT +1:00'],
            ['name' => 'Africa/Ceuta GMT +1:00'],
            ['name' => 'Africa/Conakry GMT +0:00'],
            ['name' => 'Africa/Dakar GMT +0:00'],
            ['name' => 'Africa/Dar_es_Salaam GMT +3:00'],
            ['name' => 'Africa/Djibouti GMT +3:00'],
            ['name' => 'Africa/Douala GMT +1:00'],
            ['name' => 'Africa/El_Aaiun GMT +1:00'],
            ['name' => 'Africa/Freetown GMT +0:00'],
            ['name' => 'Africa/Gaborone GMT +2:00'],
            ['name' => 'Africa/Harare GMT +2:00'],
            ['name' => 'Africa/Johannesburg GMT +2:00'],
            ['name' => 'Africa/Juba GMT +2:00'],
            ['name' => 'Africa/Kampala GMT +3:00'],
            ['name' => 'Africa/Khartoum GMT +2:00'],
            ['name' => 'Africa/Kigali GMT +2:00'],
            ['name' => 'Africa/Kinshasa GMT +1:00'],
            ['name' => 'Africa/Lagos GMT +1:00'],
            ['name' => 'Africa/Libreville GMT +1:00'],
            ['name' => 'Africa/Lome GMT +0:00'],
            ['name' => 'Africa/Luanda GMT +1:00'],
            ['name' => 'Africa/Lubumbashi GMT +2:00'],
            ['name' => 'Africa/Lusaka GMT +2:00'],
            ['name' => 'Africa/Malabo GMT +1:00'],
            ['name' => 'Africa/Maputo GMT +2:00'],
            ['name' => 'Africa/Maseru GMT +2:00'],
            ['name' => 'Africa/Mbabane GMT +2:00'],
            ['name' => 'Africa/Mogadishu GMT +3:00'],
            ['name' => 'Africa/Monrovia GMT +0:00'],
            ['name' => 'Africa/Nairobi GMT +3:00'],
            ['name' => 'Africa/Ndjamena GMT +1:00'],
            ['name' => 'Africa/Niamey GMT +1:00'],
            ['name' => 'Africa/Nouakchott GMT +0:00'],
            ['name' => 'Africa/Ouagadougou GMT +0:00'],
            ['name' => 'Africa/Porto-Novo GMT +1:00'],
            ['name' => 'Africa/Sao_Tome GMT +0:00'],
            ['name' => 'Africa/Timbuktu GMT +0:00'],
            ['name' => 'Africa/Tripoli GMT +2:00'],
            ['name' => 'Africa/Tunis GMT +1:00'],
            ['name' => 'Africa/Windhoek GMT +2:00'],
            ['name' => 'America/Adak GMT -10:00'],
            ['name' => 'America/Anchorage GMT -9:00'],
            ['name' => 'America/Anguilla GMT -4:00'],
            ['name' => 'America/Antigua GMT -4:00'],
            ['name' => 'America/Araguaina GMT -3:00'],
            ['name' => 'America/Argentina/Buenos_Aires GMT -3:00'],
            ['name' => 'America/Argentina/Catamarca GMT -3:00'],
            ['name' => 'America/Argentina/ComodRivadavia GMT -3:00'],
            ['name' => 'America/Argentina/Cordoba GMT -3:00'],
            ['name' => 'America/Argentina/Jujuy GMT -3:00'],
            ['name' => 'America/Argentina/La_Rioja GMT -3:00'],
            ['name' => 'America/Argentina/Mendoza GMT -3:00'],
            ['name' => 'America/Argentina/Rio_Gallegos GMT -3:00'],
            ['name' => 'America/Argentina/Salta GMT -3:00'],
            ['name' => 'America/Argentina/San_Juan GMT -3:00'],
            ['name' => 'America/Argentina/San_Luis GMT -3:00'],
            ['name' => 'America/Argentina/Tucuman GMT -3:00'],
            ['name' => 'America/Argentina/Ushuaia GMT -3:00'],
            ['name' => 'America/Aruba GMT -4:00'],
        ];
        DB::table('time_zones')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_zones');
    }
}
