<?php

namespace App\Http\Livewire\Cms;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Illuminate\Support\Facades\Gate;
use App\Models\Live\Question;
use App\Models\Question as AdminQuestion;
use App\Models\Live\Category;
use App\Models\User;
use Illuminate\Support\Carbon;


class RejectedQuestions extends LivewireDatatable
{
    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');
        if (
            Gate::allows('super-admin-access') ||
            Gate::allows('content-admin-access')
        ) {
            $query = AdminQuestion::query()
                ->select(
                    "questions.question_id",
                    "questions.deleted_at",
                    "questions.approved_at",
                    "questions.rejected_at",
                    "questions.published_at",
                    "live_questions.label",
                    "live_questions.category_id",
                    "live_subcat.category_id as sub_parent_category_id",
                    "live_subcat.name as subcategory_name",
                    "live_subcat.id as subcategory_id",
                    "live_cat.id as parent_category_id",
                    "live_cat.name as parent_category_name"
                )
                ->whereNotNull('questions.rejected_at')
                ->join("{$livedb}.questions as live_questions", "live_questions.id", "=", "questions.question_id")
                ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "live_questions.category_id")
                ->join("{$livedb}.categories as live_cat", "live_subcat.category_id", "=", "live_cat.id");

            return $query;
        }
        $query = AdminQuestion::query()
            ->select(
                "questions.question_id",
                "questions.deleted_at",
                "questions.approved_at",
                "questions.rejected_at",
                "questions.published_at",
                "live_questions.label",
                "live_questions.category_id",
                "live_subcat.category_id as sub_parent_category_id",
                "live_subcat.name as subcategory_name",
                "live_subcat.id as subcategory_id",
                "live_cat.id as parent_category_id",
                "live_cat.name as parent_category_name"
            )
            ->whereNotNull('questions.rejected_at')->where('questions.user_id', auth()->user()->id)
            ->join("{$livedb}.questions as live_questions", "live_questions.id", "=", "questions.question_id")
            ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "live_questions.category_id")
            ->join("{$livedb}.categories as live_cat", "live_subcat.category_id", "=", "live_cat.id");

        return $query;
    }

    public function columns()
    {
        return
            [
                Column::callback(['question_id'], function ($question_id) {
                    return Question::find($question_id)->id;
                })->label('Id')
                    ->searchable()
                    ->hideable()
                    ->filterable(),

                Column::callback(['question_id'], function ($question_id) {
                    return Question::find($question_id)->level;
                }, 'level')->label('level')
                    ->searchable()
                    ->hideable()
                    ->filterable(),

                Column::name('live_questions.label')
                    ->label('Question')
                    ->filterable()
                    ->searchable(),

                Column::callback(
                    ['question_id'],
                    function ($question_id) {
                        $question = Question::find($question_id);
                        $subcategory = Category::find($question->category_id);
                        return view('components.rejected-question-table-actions', [
                            'id' => $question->id, 'level' => $question->level,
                            'label' => $question->label, 'subcategory' => $subcategory->name
                        ]);
                    },
                    'actions'
                )->unsortable(),

                Column::name('live_subcat.name')
                    ->label('Subcategory')
                    ->filterable()
                    ->searchable(),

                Column::name('live_cat.name')
                    ->label('Category')
                    ->filterable()
                    ->searchable(),

                Column::callback(['user_id'], function ($user_id) {
                    $creator = User::find($user_id);
                    if ($creator === null) {
                        $admin = User::where('is_content_admin', true)->first();
                        if ($admin == null) {
                            return '';
                        }
                        return $admin->name;
                    }
                    return $creator->name;
                })->label('Created By'),

                Column::callback(['created_at'], function ($created_at) {
                    return Carbon::parse($created_at)
                        ->setTimezone('Africa/Lagos');
                })->label('Time Uploaded')->filterable(),
            ];
    }
}
