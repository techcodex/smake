<?php

namespace Tests\Feature;

use App\Bank;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BankApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp():void
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user,'api-user');
    }

    /**
     * Banks Store Api Test
     *
     * @return void
     */
    public function testCanStoreBank()
    {
        $form_data = [
            'name' => 'JS'
        ];

        $this->withExceptionHandling();
        
        $this->json('POST', route('api.bank.store'), $form_data)
                ->assertStatus(200);
    }

    /**
     * Banks List Api Test
     *
     * @return void
     */
    public function testCanShowListOfBank()
    {
        $this->withExceptionHandling();

        $this->get(route('api.bank.index'))
                ->assertStatus(200);
    }

    /**
     * Banks Update Api Test
     */
    public function testCanUpdateBank()
    {
        $bank = factory(Bank::class)->create();
        $form_data = [
            'name' => 'sparkasse'
        ];
        $this->withExceptionHandling();

        $this->json('PUT', route('api.bank.update', $bank->id), $form_data)
                ->assertStatus(200);
    }

    /**
     * Bank Delete Api Test
     */
    public function testCanDeleteBank()
    {
        $bank = factory(Bank::class)->create();

        $this->withExceptionHandling();

        $this->delete(route('api.bank.delete',$bank->id))
                ->assertStatus(200);
    }

    /**
     * Bank All Transaction Total Test
     */
    public function testCanGetBankTransactionsTotal()
    {
        $bank = factory(Bank::class)->create();

        $transactions = factory(Transaction::class)->make();

        $bank->transactions()->save($transactions);

        $this->get(route('api.bank.getTransactionTotal',$bank->id))
            ->assertStatus(200);
    }
}
