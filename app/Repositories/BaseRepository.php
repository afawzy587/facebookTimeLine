<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

use function App\Http\Helpers\getLanguages;

class BaseRepository implements BaseRepositoryInterface
{
    protected $local;
    protected $languages;
    public function __construct(protected Model $model)
    {
      $this->local = app()->getLocale();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int|string $id): object
    {
        return (object) $this->model->findOrFail($id);
    }

    public function create(array $data): object
    {
        return $this->model->create([$data]);
    }

    public function update(string|int $id, array $data): object
    {
        return (object) tap($this->model->findOrFail($id))->update($data)->get();
    }

    public function delete(int|string $id): bool
    {
      return $this->model->findOrFail($id)->delete();
    }

}
