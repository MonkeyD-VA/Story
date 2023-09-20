<?php
namespace App\Repositories\Position;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface PositionRepositoryInterface extends RepositoryInterface
{
  public function getPositionInPage(string $id);
}
