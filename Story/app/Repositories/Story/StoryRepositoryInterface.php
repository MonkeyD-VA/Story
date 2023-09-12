<?php
namespace App\Repositories\Story;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface StoryRepositoryInterface extends RepositoryInterface
{
  public function findPage($id);
}
