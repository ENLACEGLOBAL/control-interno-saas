<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use Illuminate\Http\Request;

class MatrixDashboardController extends Controller
{
    public function index()
    {
        // Cargamos los riesgos junto con sus procesos, áreas y controles vinculados
        $risks = Risk::with(['process.area', 'controls'])->get();

        // Inicializamos la matriz 5x5 vacía para evitar errores de índice en Blade
        $matrixData = [];
        for ($p = 5; $p >= 1; $p--) {
            for ($i = 1; $i <= 5; $i++) {
                $matrixData[$p][$i] = [
                    'inherent_risks' => [],
                    'residual_risks' => []
                ];
            }
        }

        foreach ($risks as $risk) {
            // Mapa Inherente
            $matrixData[$risk->probability][$risk->impact]['inherent_risks'][] = $risk;

            // Asegurarnos de que el resultado matemático sea un entero estricto (int) entre 1 y 5
            $resProb = (int) max(1, min(5, round($risk->residual_probability)));
            $resImp  = (int) max(1, min(5, round($risk->residual_impact)));

            // Mapa Residual
            $matrixData[$resProb][$resImp]['residual_risks'][] = $risk;
        }

        return view('matriz_riesgo.matrix.dashboard', compact('risks', 'matrixData'));
    }
}