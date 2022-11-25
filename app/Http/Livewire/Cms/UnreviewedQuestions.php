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
use Illuminate\Support\Facades\DB;

class UnreviewedQuestions extends LivewireDatatable
{
    public $complex = true;

    public function builder()
    {
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
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
                    "live_questions.id",
                    "live_questions.label",
                    "live_questions.level",
                    "live_categories_questions.category_id",
                    "live_subcat.category_id as sub_parent_category_id",
                    "live_subcat.name as subcategory_name",
                    "live_subcat.id as subcategory_id",
                    "live_cat.id as parent_category_id",
                    "live_cat.name as parent_category_name"
                )
                ->whereNull('questions.deleted_at')
                ->whereNull('questions.approved_at')->whereNull('questions.rejected_at')
                ->whereNull('questions.published_at')
                ->join("{$livedb}.categories_questions as live_categories_questions", "live_categories_questions.question_id", "=", "questions.question_id")
                ->join("{$livedb}.questions as live_questions", "live_questions.id", "=", "questions.question_id")
                ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "live_categories_questions.category_id")
                ->join("{$livedb}.categories as live_cat", "live_subcat.category_id", "=", "live_cat.id")
                ->groupBy(
                    'questions.question_id',
                );
            return $query;
        }
        $query = AdminQuestion::query()
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
                "live_cat.name as parent_category_name"
            )
            ->whereNull('questions.deleted_at')
            ->whereNull('questions.approved_at')->whereNull('questions.rejected_at')
            ->whereNull('questions.published_at')->where('questions.user_id', auth()->user()->id)
            ->join("{$livedb}.categories_questions as live_categories_questions", "live_categories_questions.question_id", "=", "questions.question_id")
            ->join("{$livedb}.questions as live_questions", "live_questions.id", "=", "questions.question_id")
            ->join("{$livedb}.categories as live_subcat", "live_subcat.id", "=", "live_categories_questions.category_id")
            ->join("{$livedb}.categories as live_cat", "live_subcat.category_id", "=", "live_cat.id")
            ->groupBy(
                'questions.question_id',
            );

        return $query;
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
                        return view('components.table-actions', [
                            'id' => $question->id
                        ]);
                    },
                    'actions'
                )->unsortable(),

                Column::callback(['question_id'], function ($question_id) {
                    $subcategories = Question::find($question_id)->categories()->get();
                    $data = [];
                    foreach ($subcategories as $subcategory) {
                        $data[] = $subcategory->name;
                    };
                    return implode(" , ", $data);;
                }, 'subcategories')->label('Subcategories')
                    ->hideable(),

                // Column::name('live_subcat.name')
                //     ->label('Subcategory')
                //     ->filterable()
                //     ->searchable(),

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
