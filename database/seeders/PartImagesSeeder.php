<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PartImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Sample images mapping (using placeholder service with different colors)
        $imageUrls = [
            'Arduino Uno R3' => 'https://picsum.photos/400/400?random=1',
            'Raspberry Pi 4 Model B' => 'https://picsum.photos/400/400?random=2',
            'HC-SR04 Ultrasonic Sensor' => 'https://picsum.photos/400/400?random=3',
            'SG90 Micro Servo' => 'https://picsum.photos/400/400?random=4',
            'ESP32 Development Board' => 'https://picsum.photos/400/400?random=5',
            'DHT22 Temperature/Humidity Sensor' => 'https://picsum.photos/400/400?random=6',
            'L298N Motor Driver' => 'https://picsum.photos/400/400?random=7',
            'OLED Display 0.96"' => 'https://picsum.photos/400/400?random=8',
            'Soldering Station' => 'https://picsum.photos/400/400?random=9',
            'Breadboard 830 Points' => 'https://picsum.photos/400/400?random=10',
            'Jumper Wire Set' => 'https://picsum.photos/400/400?random=11',
            'Nema 17 Stepper Motor' => 'https://picsum.photos/400/400?random=12',
        ];

        // Ensure storage directory exists
        $storageDir = public_path('storage/parts');
        if (!File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        foreach ($imageUrls as $partName => $imageUrl) {
            $part = Part::where('name', $partName)->first();

            if ($part) {
                try {
                    // Download image
                    $imageContent = @file_get_contents($imageUrl);

                    if ($imageContent) {
                        $filename = time() . '_' . str_replace(' ', '_', strtolower($partName)) . '.jpg';
                        $filepath = $storageDir . '/' . $filename;

                        file_put_contents($filepath, $imageContent);

                        // Update part with image path
                        $part->update(['image' => 'storage/parts/' . $filename]);

                        $this->command->info("Added image for: {$partName}");

                        // Small delay to ensure unique filenames
                        sleep(1);
                    }
                } catch (\Exception $e) {
                    $this->command->error("Failed to add image for {$partName}: " . $e->getMessage());
                }
            }
        }

        $this->command->info('Part images seeded successfully!');
    }
}
