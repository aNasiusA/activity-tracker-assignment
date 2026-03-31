<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        $user1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Mike Johnson',
            'email' => 'mike@example.com',
        ]);

        // Create sample activities
        $activity1 = Activity::create([
            'title' => 'Daily SMS count in comparison to SMS count from logs',
            'description' => 'Compare the daily SMS count with the count from system logs to ensure accuracy',
            'date' => now()->toDateString(),
        ]);

        $activity2 = Activity::create([
            'title' => 'Email System Monitoring',
            'description' => 'Monitor email delivery system and check for any failures',
            'date' => now()->toDateString(),
        ]);

        $activity3 = Activity::create([
            'title' => 'Database Backup Verification',
            'description' => 'Verify that all database backups were completed successfully',
            'date' => now()->toDateString(),
        ]);

        // Create sample activity updates
        ActivityUpdate::create([
            'activity_id' => $activity1->id,
            'user_id' => $user1->id,
            'status' => 'done',
            'remark' => 'SMS count matches perfectly with logs',
            'updated_at_specific' => now()->subHours(4),
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity2->id,
            'user_id' => $user2->id,
            'status' => 'pending',
            'remark' => 'Found 3 failed emails, investigating issue',
            'updated_at_specific' => now()->subHours(2),
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity3->id,
            'user_id' => $user3->id,
            'status' => 'done',
            'remark' => 'All backups completed successfully',
            'updated_at_specific' => now()->subHours(1),
        ]);

        // Add another update to activity 2
        ActivityUpdate::create([
            'activity_id' => $activity2->id,
            'user_id' => $user1->id,
            'status' => 'done',
            'remark' => 'Issue resolved, all emails now sending correctly',
            'updated_at_specific' => now()->subMinutes(30),
        ]);
    }
}

