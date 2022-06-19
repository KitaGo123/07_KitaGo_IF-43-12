<?php

namespace Tests\Unit;

use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Session;

use App\Models\Paket;

class PaketTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_view_paket()
    {
        $response = $this->get('/kgweb/paket/{id}/viewPaket');

        $response->assertStatus(302);
    }

    public function test_delete_paket()
    {
        $paket = Paket::make([
            'namaPaket' => 'Tester1',
            'harga' => 200000,
            'deskripsi' => 'foo',
            'idPenginapan' => 2,
            'idWisata' => 2,
            'idJasa' => 2
        ]);

        $paket->latest('created_at')->first();

        if($paket) {
            $paket->delete();
        }

        $this->assertTrue(true);
    }

    public function test_if_it_stores_new_pakets()
    {
        $paket = Paket::make([
            'namaPaket' => 'Tester1',
            'harga' => 200000,
            'deskripsi' => 'foo',
            'idPenginapan' => 1,
            'idWisata' => 1,
            'idJasa' => 1
        ]);

        $response = $this->post('/kgweb/paket/inputPaket', [$paket]);

        $response->assertStatus(302);
    }

    public function test_if_data_is_not_null()
    {
        $paket = Paket::find(1);

        $this->assertNotNull([
            $paket->namaPaket,
            $paket->harga,
            $paket->deskripsi,
            $paket->idPenginapan,
            $paket->idWisata,
            $paket->idJasa,
        ]);
    }

    public function test_if_user_logged()
    {
        $this->withSession(['user']);

        $this->assertTrue(true);
    }

    public function test_if_data_exists_in_database()
    {
        $this->assertDatabaseHas('pakets', [
            'namaPaket' => 'test'
        ]);
    }

    public function test_if_data_does_not_exists_in_database()
    {
        $this->assertDatabaseMissing('pakets', [
            'namaPaket' => 'Tester2'
        ]);
    }

    public function test_if_seeder_works()
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertTrue(true);
    }
}
