<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::where('email', 'mwalimu@kgfdc.ac.tz')->delete();

User::create([
    'name'      => 'Mwalimu Test',
    'email'     => 'mwalimu@kgfdc.ac.tz',
    'password'  => Hash::make('password'),
    'role_name' => 'Teacher',
    'status'    => 'Active',
]);

$u = User::where('email', 'mwalimu@kgfdc.ac.tz')->first();
echo 'Done: ' . $u->name . ' | ' . $u->role_name . ' | ' . $u->status . PHP_EOL;
