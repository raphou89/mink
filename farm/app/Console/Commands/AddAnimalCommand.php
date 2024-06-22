<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Animal;
use App\Models\Type;
use App\Models\Race;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AddAnimalCommand extends Command
{
    protected $signature = 'animal:add 
                            {name : The name of the animal}
                            {age : The age of the animal}
                            {type_id : The ID of the animal type}
                            {race_id : The ID of the animal race}
                            {description : The description of the animal}
                            {price : The price of the animal}
                            {status : The status of the animal (e.g., en vente, vendu)}
                            {pictures : The pictures of the animal in JSON format}';

    protected $description = 'Add a new animal';

    public function handle()
{
    $data = [
        'name' => $this->argument('name'),
        'age' => $this->argument('age'),
        'type_id' => $this->argument('type_id'),
        'race_id' => $this->argument('race_id'),
        'description' => $this->argument('description'),
        'price' => $this->argument('price'),
        'status' => $this->argument('status'),
        'pictures' => json_decode($this->argument('pictures')),
    ];

    // Validate the data
    $validator = Validator::make($data, [
        'name' => 'required|string',
        'age' => 'required|integer',
        'type_id' => 'required|exists:types,id',
        'race_id' => 'required|exists:races,id',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'status' => 'required|string',
        'pictures' => 'required|array',
        'pictures.*' => 'required|string',
    ]);

    // Handle validation errors
    if ($validator->fails()) {
        $this->error('Validation failed:');
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }
        return 1;
    }

    // Process pictures
    try {
        $picturesPaths = [];
        foreach ($data['pictures'] as $filePath) {
            if (file_exists($filePath)) {
                $fileName = Str::random(10) . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                $storagePath = public_path('storage/animals');
                copy($filePath, $storagePath . '/' . $fileName);
                $picturesPaths[] = '/storage/animals/' . $fileName;
            } else {
                $this->error("File not found: $filePath");
                return 1;
            }
        }

        // Encode pictures paths as JSON
        $data['pictures'] = json_encode($picturesPaths);

        // Create the animal
        Animal::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'type_id' => $data['type_id'],
            'race_id' => $data['race_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            'status' => $data['status'],
            'pictures' => $data['pictures'],
        ]);

        $this->info('Animal added successfully.');

        return 0;
    } catch (\Exception $e) {
        Log::error('Error adding animal: ' . $e->getMessage());
        $this->error('Internal Server Error');
        return 1;
    }
}

}
