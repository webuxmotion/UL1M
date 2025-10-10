<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@robotics.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Create Workshops
        $kyiv1 = Workshop::create([
            'name' => 'KYIV-1',
            'city' => 'Kyiv',
            'address' => 'Khreshchatyk Street, 1, Kyiv, Ukraine',
            'phone' => '+380 44 123 4567',
        ]);

        $kyiv2 = Workshop::create([
            'name' => 'KYIV-2',
            'city' => 'Kyiv',
            'address' => 'Peremohy Avenue, 45, Kyiv, Ukraine',
            'phone' => '+380 44 987 6543',
        ]);

        $lviv1 = Workshop::create([
            'name' => 'LVIV-1',
            'city' => 'Lviv',
            'address' => 'Svobody Avenue, 28, Lviv, Ukraine',
            'phone' => '+380 32 234 5678',
        ]);

        // Create Workshop Admins
        $kyiv1Admin = User::create([
            'name' => 'Kyiv-1 Administrator',
            'email' => 'kyiv1@robotics.com',
            'password' => Hash::make('password'),
            'role' => 'workshop_admin',
            'workshop_id' => $kyiv1->id,
        ]);

        $kyiv2Admin = User::create([
            'name' => 'Kyiv-2 Administrator',
            'email' => 'kyiv2@robotics.com',
            'password' => Hash::make('password'),
            'role' => 'workshop_admin',
            'workshop_id' => $kyiv2->id,
        ]);

        $lviv1Admin = User::create([
            'name' => 'Lviv-1 Administrator',
            'email' => 'lviv1@robotics.com',
            'password' => Hash::make('password'),
            'role' => 'workshop_admin',
            'workshop_id' => $lviv1->id,
        ]);

        // Assign admins to workshops
        $kyiv1->update(['admin_id' => $kyiv1Admin->id]);
        $kyiv2->update(['admin_id' => $kyiv2Admin->id]);
        $lviv1->update(['admin_id' => $lviv1Admin->id]);

        // Create sample parts for KYIV-1
        Part::create([
            'name' => 'Arduino Uno R3',
            'description' => 'ATmega328P based microcontroller board with 14 digital I/O pins',
            'category' => 'Microcontroller',
            'manufacturer' => 'Arduino',
            'part_number' => 'A000066',
            'quantity' => 15,
            'price' => 23.50,
            'workshop_id' => $kyiv1->id,
        ]);

        Part::create([
            'name' => 'Raspberry Pi 4 Model B',
            'description' => 'Single-board computer with 4GB RAM',
            'category' => 'Microcontroller',
            'manufacturer' => 'Raspberry Pi Foundation',
            'part_number' => 'RPI4-MODBP-4GB',
            'quantity' => 8,
            'price' => 55.00,
            'workshop_id' => $kyiv1->id,
        ]);

        Part::create([
            'name' => 'HC-SR04 Ultrasonic Sensor',
            'description' => 'Distance measuring sensor module, range 2cm-400cm',
            'category' => 'Sensor',
            'manufacturer' => 'Generic',
            'part_number' => 'HC-SR04',
            'quantity' => 50,
            'price' => 2.99,
            'workshop_id' => $kyiv1->id,
        ]);

        Part::create([
            'name' => 'SG90 Micro Servo',
            'description' => '9g micro servo motor, 180 degree rotation',
            'category' => 'Motor',
            'manufacturer' => 'TowerPro',
            'part_number' => 'SG90',
            'quantity' => 30,
            'price' => 3.50,
            'workshop_id' => $kyiv1->id,
        ]);

        // Create sample parts for KYIV-2
        Part::create([
            'name' => 'ESP32 Development Board',
            'description' => 'WiFi + Bluetooth microcontroller with dual-core processor',
            'category' => 'Microcontroller',
            'manufacturer' => 'Espressif',
            'part_number' => 'ESP32-WROOM-32',
            'quantity' => 20,
            'price' => 8.99,
            'workshop_id' => $kyiv2->id,
        ]);

        Part::create([
            'name' => 'DHT22 Temperature/Humidity Sensor',
            'description' => 'Digital temperature and humidity sensor with high accuracy',
            'category' => 'Sensor',
            'manufacturer' => 'Aosong',
            'part_number' => 'DHT22',
            'quantity' => 25,
            'price' => 4.50,
            'workshop_id' => $kyiv2->id,
        ]);

        Part::create([
            'name' => 'L298N Motor Driver',
            'description' => 'Dual H-Bridge motor driver for DC and stepper motors',
            'category' => 'Motor',
            'manufacturer' => 'STMicroelectronics',
            'part_number' => 'L298N',
            'quantity' => 12,
            'price' => 3.75,
            'workshop_id' => $kyiv2->id,
        ]);

        Part::create([
            'name' => 'OLED Display 0.96"',
            'description' => '128x64 I2C OLED display module',
            'category' => 'Display',
            'manufacturer' => 'Generic',
            'part_number' => 'SSD1306',
            'quantity' => 18,
            'price' => 5.99,
            'workshop_id' => $kyiv2->id,
        ]);

        // Create sample parts for LVIV-1
        Part::create([
            'name' => 'Soldering Station',
            'description' => 'Digital soldering station with temperature control',
            'category' => 'Tool',
            'manufacturer' => 'Hakko',
            'part_number' => 'FX-888D',
            'quantity' => 3,
            'price' => 99.99,
            'workshop_id' => $lviv1->id,
        ]);

        Part::create([
            'name' => 'Breadboard 830 Points',
            'description' => 'Solderless prototyping breadboard',
            'category' => 'Tool',
            'manufacturer' => 'Generic',
            'part_number' => 'BB830',
            'quantity' => 40,
            'price' => 3.99,
            'workshop_id' => $lviv1->id,
        ]);

        Part::create([
            'name' => 'Jumper Wire Set',
            'description' => 'Male-to-Male jumper wires, 40pcs, 20cm',
            'category' => 'Cable/Connector',
            'manufacturer' => 'Generic',
            'quantity' => 100,
            'price' => 2.49,
            'workshop_id' => $lviv1->id,
        ]);

        Part::create([
            'name' => 'Nema 17 Stepper Motor',
            'description' => 'Bipolar stepper motor, 1.8 degree step angle',
            'category' => 'Motor',
            'manufacturer' => 'Generic',
            'part_number' => 'NEMA17-1.7A',
            'quantity' => 10,
            'price' => 12.99,
            'workshop_id' => $lviv1->id,
        ]);
    }
}
