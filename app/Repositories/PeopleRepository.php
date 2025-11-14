<?php

namespace App\Repositories;

use App\Models\People;
use App\Repositories\Interfaces\PeopleRepositoryInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PeopleRepository implements PeopleRepositoryInterface
{
    public function all(): LengthAwarePaginator
    {
        return People::paginate(15);
    }

      /**
         * Find the desired person.
         * 
         * @param int $id
         * 
         * @return null|\App\Models\People
     */
    public function find(int $id): People
    {
        return People::findOrFail($id);
    }

    /**
         * Create a new person.
         * 
         * @param array $data
         * 
         * @return \App\Models\People
         * 
         * @throws \Exception
     */
    public function create(array $data): People
    {
        DB::beginTransaction();
        try {
            $people = new People();
            $people->nome = $data['nome'];
            $people->cpf = $data['cpf'];
            $people->data_nascimento = $data['data_nascimento'];
            $people->email = $data['email'];
            $people->telefone = $data['telefone'];
            
            $people->save();

            DB::commit();

            return $people;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Não foi possível criar a pessoa: ' . $e->getMessage());
        }
    }

    /**
         * Update the desired person.
         * 
         * @param int $id
         * @param array $data
         * 
         * @return bool
         * 
         * @throws \Exception
     */
    public function update(int $id, array $data): bool
    {
        DB::beginTransaction();
        try {
            $people = $this->find($id);

            if (array_key_exists('nome', $data)) {
                $people->nome = $data['nome'];
            }

            if (array_key_exists('cpf', $data)) {
                $people->cpf = $data['cpf'];
            }

            if (array_key_exists('data_nascimento', $data)) {
                $people->data_nascimento = $data['data_nascimento'];
            }

            if (array_key_exists('email', $data)) {
                $people->email = $data['email'];
            }

            if (array_key_exists('telefone', $data)) {
                $people->telefone = $data['telefone'];
            }

            $people->save();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Não foi possível atualizar a pessoa: ' . $e->getMessage());
        }
    }

    /**
         * Delete the desired person.
         * 
         * @param int $id
         * 
         * @return bool
         * 
         * @throws \Exception
     */
    public function delete($id): bool
    {
        $people = $this->find($id);

        DB::beginTransaction();
        try {
            $people->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Não foi possível deletar a pessoa: ' . $e->getMessage());
        }
    }
}