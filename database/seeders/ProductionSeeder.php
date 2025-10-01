<?php

namespace Database\Seeders;

use App\Enums\LevelType;
use App\Enums\RoleType;
use App\Enums\StatusType;
use App\Enums\TrainingStatusType;
use App\Models\CategoryPost;
use App\Models\CategoryTool;
use App\Models\CategoryTraining;
use App\Models\Chapter;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@pierre-site.com'],
            [
                'name' => 'Administrateur',
                'phone' => '+243971330007',
                'role' => RoleType::ADMIN,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create sample categories
        $categories = [
            'Cryptomonnaies',
            'Data Science',
            'Cybersécurité',
            'Intelligence Artificielle',
            'Blockchain',
            'Développement Web',
            'Mobile Development',
            'DevOps',
            'Cloud Computing',
            'Machine Learning'
        ];

        foreach ($categories as $category) {
            CategoryTraining::firstOrCreate(['name' => $category]);
            CategoryTool::firstOrCreate(['name' => $category]);
            CategoryPost::firstOrCreate(['name' => $category]);
        }

        // Create sample trainings
        $trainings = [
            [
                'title' => 'Introduction aux Cryptomonnaies',
                'description' => 'Apprenez les bases des cryptomonnaies et de la blockchain',
                'author' => 'Pierre Expert',
                'price' => 99.99,
                'level' => LevelType::BEGINNER,
                'status' => TrainingStatusType::PUBLISHED,
                'category_training_id' => CategoryTraining::where('name', 'Cryptomonnaies')->first()->id,
            ],
            [
                'title' => 'Cybersécurité Avancée',
                'description' => 'Maîtrisez les techniques avancées de cybersécurité',
                'author' => 'Pierre Security',
                'price' => 199.99,
                'level' => LevelType::ADVANCED,
                'status' => TrainingStatusType::PUBLISHED,
                'category_training_id' => CategoryTraining::where('name', 'Cybersécurité')->first()->id,
            ],
            [
                'title' => 'Data Science avec Python',
                'description' => 'Analysez et visualisez des données avec Python',
                'author' => 'Pierre Data',
                'price' => 149.99,
                'level' => LevelType::INTERMEDIATE,
                'status' => TrainingStatusType::PUBLISHED,
                'category_training_id' => CategoryTraining::where('name', 'Data Science')->first()->id,
            ]
        ];

        foreach ($trainings as $trainingData) {
            $training = Training::firstOrCreate(
                ['title' => $trainingData['title']],
                $trainingData
            );

            // Add sample chapters
            Chapter::firstOrCreate(
                [
                    'training_id' => $training->id,
                    'title' => 'Introduction - ' . $training->title
                ],
                [
                    'description' => 'Chapitre d\'introduction pour ' . $training->title,
                    'video_url' => 'https://example.com/video1.mp4',
                    'order' => 1,
                ]
            );

            Chapter::firstOrCreate(
                [
                    'training_id' => $training->id,
                    'title' => 'Concepts Fondamentaux'
                ],
                [
                    'description' => 'Apprenez les concepts de base',
                    'video_url' => 'https://example.com/video2.mp4',
                    'order' => 2,
                ]
            );
        }
    }
}
