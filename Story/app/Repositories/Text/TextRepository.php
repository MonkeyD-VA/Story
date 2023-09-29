<?php

namespace App\Repositories\Text;

use App\Models\Text;
use App\Repositories\BaseRepository;
use App\Repositories\Text\TextRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TextRepository extends BaseRepository implements TextRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Text::class;
    }

    public function updateTextInList($data) {
        $listNewText = [];
        foreach ($data as $text) {
            if (!isset($text['text_id'])) {
                $newText = new Text();
                $newText->text_content = $text['text_content'];
                $newText->text_type = $text['text_type'];
                $newText->save();
                array_push($listNewText, $newText);
            }
        }
        return $listNewText;
    }
}
