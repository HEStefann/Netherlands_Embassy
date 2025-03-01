<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            CourseProfessorSeeder::class,
            ProfessorsDataSeeder::class,
            StudentDataSeeder::class,
            ModuleSeeder::class,
            LessonSeeder::class,
            UserProgressSeeder::class,
            MessageSeeder::class,
            AchievementSeeder::class,
            ForumThreadSeeder::class,
            ForumCommentSeeder::class,
            NewsletterSubscriptionSeeder::class,
            WishlistSeeder::class,
            ReviewSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            UserResponseSeeder::class,
            InterestSeeder::class,
            StudentInterestSeeder::class,
            LessonViewSeeder::class,
        ]);
    }
}
