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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublishedQuestions extends LivewireDatatable
{
    public $perPage = 100;
    public $persistPerPage = false;

    public function builder()
    {
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $livedb = config('database.connections.mysqllive.database');

        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:view')) {
            return AdminQuestion::query()
                ->select(
                    "questions.question_id",
                    "questions.deleted_at",
                    "questions.approved_at",
                    "questions.rejected_at",
                    "questions.published_at",
                    "live_questions.id",
                    "live_questions.label",
                    "live_questions.level",
                    "live_categories_questions.category_id",
                    "live_subcat.category_id as sub_parent_category_id",
                    "live_subcat.name as subcategory_name",
                    "live_subcat.id as subcategory_id",
                    "live_cat.id as parent_category_id",
                    "live_cat.name as parent_category_name",
                    "admin_users.name as created_by"
                )
                ->whereNotNull('questions.published_at')
                ->join("{$livedb}.categories_questions as live_categories_questions", "live_categories_questions.question_id", "=", "questions.question_id")
                ->join("{$livedb}.questions as live_questions", "live_questions.id", "=", "questions.question_id")
                ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "live_categories_questions.category_id")
                ->join("{$livedb}.categories as live_cat", "live_subcat.category_id", "=", "live_cat.id")
                ->join("users as admin_users", "live_questions.created_by", "=", "admin_users.id")
                ->groupBy(
                    'questions.question_id',
                );
        }
        return AdminQuestion::query()
            ->select(
                "questions.question_id",
                "questions.deleted_at",
                "questions.approved_at",
                "questions.rejected_at",
                "questions.published_at",
                "live_questions.id",
                "live_questions.label",
                "live_questions.level",
                "live_categories_questions.category_id",
                "live_subcat.category_id as sub_parent_category_id",
                "live_subcat.name as subcategory_name",
                "live_subcat.id as subcategory_id",
                "live_cat.id as parent_category_id",
                "live_cat.name as parent_category_name",
                "admin_users.name as created_by"
            )
            ->whereNotNull('questions.published_at')->where('questions.user_id', auth()->user()->id)
            ->join("{$livedb}.categories_questions as live_categories_questions", "live_categories_questions.question_id", "=", "questions.question_id")
            ->join("{$livedb}.questions as live_questions", "live_questions.id", "=", "questions.question_id")
            ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "live_categories_questions.category_id")
            ->join("{$livedb}.categories as live_cat", "live_subcat.category_id", "=", "live_cat.id")
            ->join("users as admin_users", "live_questions.created_by", "=", "admin_users.id")
            ->groupBy(
                'questions.question_id',
            );
    }

    public function columns()
    {
        return
            [
                Column::name('live_questions.id')
                    ->label('Id')
                    ->filterable()
                    ->searchable(),

                Column::name('live_questions.level')
                    ->label('Level')
                    ->filterable()
                    ->searchable(),

                Column::name('live_questions.label')
                    ->label('Question')
                    ->filterable()
                    ->searchable(),

                Column::callback(
                    ['question_id'],
                    function ($question_id) {
                        $question = Question::find($question_id);
                        if (!is_null($question)) {
                            return view('components.published-question-table-actions', [
                                'id' => $question->id, 'level'
                            ]);
                        }
                    },
                    ['actions']
                )->unsortable(),

                Column::callback(['question_id'], function ($question_id) {
                    $question = Question::find($question_id);
                    if (!is_null($question)) {
                        return $question->subcategories();
                    }
                }, ['subcategories'])->label('Subcategories')
                    ->hideable(),

                Column::name('live_cat.name')
                    ->label('Category')
                    ->filterable()
                    ->searchable(),

                Column::name('admin_users.name')
                    ->label('Created By')
                    ->filterable()
                    ->searchable(),

                Column::callback(['created_at'], function ($created_at) {
                    return Carbon::parse($created_at)
                        ->setTimezone('Africa/Lagos');
                })->label('Time Uploaded')->filterable(),
            ];
    }
}
