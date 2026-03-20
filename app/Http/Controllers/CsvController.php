<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    private const PRESETS = [
        'users' => ['name', 'email', 'phone', 'city', 'country'],
        'products' => ['product_name', 'price', 'category', 'sku', 'stock'],
        'orders' => ['order_id', 'customer', 'email', 'total', 'date', 'status'],
        'employees' => ['name', 'email', 'department', 'job_title', 'salary', 'hire_date'],
        'contacts' => ['first_name', 'last_name', 'email', 'phone', 'company', 'address'],
    ];

    private const AVAILABLE_COLUMNS = [
        'name', 'first_name', 'last_name', 'email', 'phone', 'address',
        'city', 'state', 'country', 'zipcode', 'company', 'job_title',
        'department', 'salary', 'date', 'datetime', 'url', 'ip',
        'uuid', 'username', 'password', 'age', 'gender', 'product_name',
        'price', 'category', 'sku', 'stock', 'order_id', 'customer',
        'total', 'status', 'description', 'color', 'hire_date',
    ];

    public function __invoke(Request $request)
    {
        $rows = min(max((int) $request->query('rows', 25), 1), 1000);
        $preset = $request->query('preset');
        $seed = $request->query('seed');
        $delimiter = $request->query('delimiter', ',') === 'tab' ? "\t" : ',';
        $format = in_array($request->query('format', 'csv'), ['csv', 'json']) ? $request->query('format', 'csv') : 'csv';

        if ($preset && isset(self::PRESETS[$preset])) {
            $columns = self::PRESETS[$preset];
        } else {
            $columnsParam = $request->query('columns', 'name,email,phone,city');
            $columns = array_slice(
                array_filter(
                    array_map('trim', explode(',', $columnsParam)),
                    fn($c) => in_array($c, self::AVAILABLE_COLUMNS)
                ),
                0,
                20
            );
            if (empty($columns)) {
                $columns = ['name', 'email', 'phone', 'city'];
            }
        }

        $faker = Factory::create();
        if ($seed !== null) {
            $faker->seed((int) $seed);
        }

        $data = [];
        for ($i = 0; $i < $rows; $i++) {
            $row = [];
            foreach ($columns as $col) {
                $row[$col] = $this->generateValue($faker, $col);
            }
            $data[] = $row;
        }

        if ($format === 'json') {
            return response()->json([
                'status' => 'success',
                'columns' => $columns,
                'count' => $rows,
                'data' => $data,
                'meta' => [
                    'seed' => $seed !== null ? (int) $seed : null,
                    'timestamp' => now()->toIso8601String(),
                ],
            ])->header('Cache-Control', $seed !== null ? 'public, max-age=3600' : 'no-cache, no-store, must-revalidate');
        }

        $output = fopen('php://temp', 'r+');
        fputcsv($output, $columns, $delimiter);
        foreach ($data as $row) {
            fputcsv($output, array_values($row), $delimiter);
        }
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        $ext = $delimiter === "\t" ? 'tsv' : 'csv';

        return response($csv)
            ->header('Content-Type', "text/{$ext}; charset=UTF-8")
            ->header('Content-Disposition', "attachment; filename=\"data.{$ext}\"")
            ->header('Cache-Control', $seed !== null ? 'public, max-age=3600' : 'no-cache, no-store, must-revalidate');
    }

    private function generateValue(\Faker\Generator $faker, string $column): string
    {
        return match ($column) {
            'name' => $faker->name(),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => $faker->safeEmail(),
            'phone' => $faker->phoneNumber(),
            'address' => $faker->streetAddress(),
            'city' => $faker->city(),
            'state' => $faker->state(),
            'country' => $faker->country(),
            'zipcode' => $faker->postcode(),
            'company' => $faker->company(),
            'job_title' => $faker->jobTitle(),
            'department' => $faker->randomElement(['Engineering', 'Marketing', 'Sales', 'HR', 'Finance', 'Operations', 'Legal', 'Support']),
            'salary' => (string) $faker->numberBetween(35000, 180000),
            'date' => $faker->date(),
            'datetime' => $faker->dateTime()->format('Y-m-d H:i:s'),
            'url' => $faker->url(),
            'ip' => $faker->ipv4(),
            'uuid' => $faker->uuid(),
            'username' => $faker->userName(),
            'password' => $faker->password(12, 16),
            'age' => (string) $faker->numberBetween(18, 85),
            'gender' => $faker->randomElement(['Male', 'Female', 'Non-binary']),
            'product_name' => $faker->words(3, true),
            'price' => number_format($faker->randomFloat(2, 1, 999), 2),
            'category' => $faker->randomElement(['Electronics', 'Clothing', 'Books', 'Home', 'Sports', 'Food', 'Toys', 'Health']),
            'sku' => strtoupper($faker->bothify('???-#####')),
            'stock' => (string) $faker->numberBetween(0, 500),
            'order_id' => (string) $faker->numberBetween(10000, 99999),
            'customer' => $faker->name(),
            'total' => number_format($faker->randomFloat(2, 10, 2000), 2),
            'status' => $faker->randomElement(['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled']),
            'description' => $faker->sentence(),
            'color' => $faker->safeColorName(),
            'hire_date' => $faker->date(),
            default => $faker->word(),
        };
    }
}
