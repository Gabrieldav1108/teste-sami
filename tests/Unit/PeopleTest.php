<?php

namespace Tests\Unit;

use App\Models\People;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a people can be created
     */
    public function test_it_can_create_a_people(): void
    {
        $people = People::factory()->create([
            'nome' => 'João Silva',
            'email' => 'joao@example.com',
            'cpf' => '12345678909', 
            'telefone' => '11999998888', 
            'data_nascimento' => '1990-05-15',
        ]);

        $this->assertInstanceOf(People::class, $people);
        $this->assertEquals('João Silva', $people->nome);
        $this->assertEquals('joao@example.com', $people->email);
        $this->assertEquals('12345678909', $people->cpf); 
        $this->assertEquals('11999998888', $people->telefone); 
        $this->assertEquals('1990-05-15', $people->data_nascimento);
    }

    /**
     * Test if fillable attributes are correctly defined
     */
    public function test_it_has_fillable_attributes(): void
    {
        $fillable = ['nome', 'cpf', 'data_nascimento', 'email', 'telefone'];
        $people = new People();

        $this->assertEquals($fillable, $people->getFillable());
    }

    /**
     * Test if CPF formatting works correctly (frontend only)
     */
    public function test_it_formats_cpf_correctly_for_display(): void
    {
        $people = People::factory()->create(['cpf' => '12345678909']);
        
        $formattedCpf = $people->cpf_formatted;

        $this->assertEquals('123.456.789-09', $formattedCpf);
    }

    /**
     * Test if phone formatting works correctly (frontend only)
     */
    public function test_it_formats_phone_correctly_for_display(): void
    {
        $people = People::factory()->create(['telefone' => '11999998888']);
        
        $formattedPhone = $people->phone_formatted;

        $this->assertEquals('(11) 99999-8888', $formattedPhone);
    }

    /**
     * Test if birth date formatting works correctly
     */
    public function test_it_formats_birth_date_correctly_for_display(): void    
    {
        $people = People::factory()->create(['data_nascimento' => '1990-05-15']);
        $formattedDate = $people->birth_date_formatted;

        $this->assertEquals('15/05/1990', $formattedDate);
    }

    /**
     * Test that database stores clean data (no formatting)
     */
    public function test_database_stores_clean_unformatted_data(): void
    {
        $people = People::factory()->create([
            'cpf' => '12345678909',
            'telefone' => '11999998888'
        ]);

        $this->assertEquals('12345678909', $people->getAttributes()['cpf']);
        $this->assertEquals('11999998888', $people->getAttributes()['telefone']);
    }
}