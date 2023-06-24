<?php

namespace Database\Seeders;

use App\Models\DataBankTransfer;
use Illuminate\Database\Seeder;

class DataBank extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $databank = new DataBankTransfer();
        $databank->name = 'Nicolás Pérez Garay';
        $databank->run = '19.812.524-5';
        $databank->email = 'nperez@ing.ucsc.cl';
        $databank->bank = 'Banco de Chile';
        $databank->account_type = 'Cuenta Vista';
        $databank->account_number = '113456789';
        $databank->paymentmethod_fk ='1';
        $databank->selected='1';
        $databank->save();

        $databank = new DataBankTransfer();
        $databank->name = 'Javiera Matus Morales';
        $databank->run = '19.812.524-5';
        $databank->email = 'jmatus@ing.ucsc.cl';
        $databank->bank = 'Banco de Chile';
        $databank->account_type = 'Cuenta Vista';
        $databank->account_number = '11223349';
        $databank->paymentmethod_fk ='1';
        $databank->selected='0';
        $databank->save();

        $databank = new DataBankTransfer();
        $databank->name = 'Franco Paredes ';
        $databank->run = '19.812.524-5';
        $databank->email = 'fparedes@ing.ucsc.cl';
        $databank->bank = 'Banco Estado';
        $databank->account_type = 'Cuenta Vista';
        $databank->account_number = '43214321';
        $databank->paymentmethod_fk ='1';
        $databank->selected='0';
        $databank->save();

    }
}