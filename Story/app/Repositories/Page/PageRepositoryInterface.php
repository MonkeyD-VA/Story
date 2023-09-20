<?php
namespace App\Repositories\Page;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface PageRepositoryInterface extends RepositoryInterface
{
  public function getAllOfPage($story_id, $page_number);
}
