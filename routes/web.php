<?php

use App\DomainService\FilesExport;
use Illuminate\Support\Facades\Route;

// Route::get('/{any}', function () {
//     return response()->json([
//         'message' => 'Something went wrong'
//     ], 400);
// })->where('any','.*');

Route::get('/surveyExport/{id}', [FilesExport::class, 'surveyExport']);
