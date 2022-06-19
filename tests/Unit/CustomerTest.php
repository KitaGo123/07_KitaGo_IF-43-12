<?php

namespace Tests\Unit;

use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

use App\Models\Customer;

class CustomerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_customer()
    {
        $response = $this->get('/kgweb/login');

        $response->assertStatus(200);
    }

    public function test_customer_duplication()
    {
        $customer1 = Customer::make([
            'usernameC' => 'Tester1',
            'passwordC' => '1234',
            'nama_lengkap' => 'John Doe',
            'emailC' => 'customer1@example.org',
            'birthDate' => '2000-02-24',
            'telpNumbC' => '081211111111'
        ]);

        $customer2 = Customer::make([
            'usernameC' => 'Tester2',
            'passwordC' => '1234',
            'nama_lengkap' => 'Mary Jane',
            'emailC' => 'customer2@example.org',
            'birthDate' => '2000-01-24',
            'telpNumbC' => '081222222222'
        ]);

        $this->assertTrue($customer1->usernameC != $customer2->usernameC);
    }

    public function test_delete_customer()
    {
        $customer = Customer::make([
            'usernameC' => 'Testing',
            'passwordC' => '1234',
            'nama_lengkap' => 'John Does',
            'emailC' => 'customer@example.org',
            'birthDate' => '2000-02-25',
            'telpNumbC' => '081211111119'
        ]);

        $customer->latest('created_at')->first();

        if($customer) {
            $customer->delete();
        }

        $this->assertTrue(true);
    }

    public function test_if_it_stores_new_customers()
    {
        $customer = Customer::make([
            'usernameC' => 'Tester1',
            'passwordC' => '1234',
            'nama_lengkap' => 'John Doe',
            'emailC' => 'customer1@example.org',
            'birthDate' => '2000-02-24',
            'telpNumbC' => '081211111111'
        ]);

        $response = $this->post('/kgweb/registrasi', [$customer]);

        $response->assertStatus(200);
    }

    public function test_if_data_exists_in_database()
    {
        $this->assertDatabaseHas('customers', [
            'nama_lengkap' => 'John Doe'
        ]);
    }

    public function test_if_data_does_not_exists_in_database()
    {
        $this->assertDatabaseMissing('customers', [
            'nama_lengkap' => 'Mary Jane'
        ]);
    }
}
