<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Models\Text;
use App\Models\Touch;
use App\Repositories\BaseRepository;
use App\Repositories\Position\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Position::class;
    }

    public function getPositionInPage(string $id)
    {
        $touch = DB::table('touches')
            ->where('page_id', '=', $id)
            ->first();

        $touches = DB::table('touches')
            ->where('page_id', '=', $id)
            ->get();

        $positions = DB::table('positions as pos')
            ->join('touches as tou', 'pos.touch_id', '=', 'tou.touch_id')
            ->join('texts as t', 't.text_id', '=', 'tou.text_id')
            ->select('*')
            ->where('tou.page_id', '=', $id)
            ->get();

        $texts = DB::table('texts')
            ->where('text_id', '=', $touch->text_id)
            ->get();


        return [
            'positions' => $positions,
            'page_id' => $id,
            'text_id' => $touch->text_id,
            'text' => $texts
        ];
    }

    public function createPositionByTouch($data)
    {
        foreach ($data as $touch) {
            foreach ($touch['positions'] as $position) {
                if (!isset($position['position_id'])) {
                    if (isset($touch['text_id'])) {
                        $this->createPositionWithText($touch['page_id'], $touch['text_id'], $position);
                    } else {
                        // $this->createPositionNewText($touch[])
                    }
                } else {
                    $this->updatePosition($position);
                }
            }
        }
    }

    public function createPositionWithText($page_id, $text_id, $positionData)
    {
        $touch = new Touch();
        $touch->page_id = $page_id;
        $touch->text_id = $text_id;
        $touch->save();

        $position = new Position();
        $position->touch_id = $touch->touch_id;
        $position->fill($positionData);
        $position->save();
        return true;
    }

    public function updatePosition($position)
    {
        $updatePosition = Position::query()->find($position['position_id']);
        $updatePosition->update($position);
        return true;
    }

    public function createWithNewText($data) {
        // Check if the text_content exists in the texts table
    $existingText = Text::where('text_content', $data['texts']['text_content'])->first();

    // If it exists, use the existing text, otherwise create a new one
    if ($existingText) {
        $text = $existingText;
    } else {
        $text = new Text();
        $text->text_content = $data['texts']['text_content'];
        $text->text_type = $data['texts']['text_type'];
        $text->save();
    }

        $touch = new Touch();
        $touch->page_id = $data['page_id'];
        $touch->text_id = $text->text_id;
        $touch->save();

        $position = new Position();
        $position->touch_id = $touch->touch_id;
        $position->fill($data['positions']);
        $position->save();
        return $position;

    }
}
