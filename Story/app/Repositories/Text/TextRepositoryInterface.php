<?php
namespace App\Repositories\Text;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface TextRepositoryInterface extends RepositoryInterface
{
  public function getTextOfPage($story_id, $page_number);
}
