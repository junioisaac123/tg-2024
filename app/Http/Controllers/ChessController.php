<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ChessController extends Controller
{
    const STOCKFISH_PATH = '/usr/local/stockfish/stockfish-ubuntu-x86-64';

    public function startGame()
    {
        $user = Auth::user();
        return view('chess.game', compact('user'));
    }


    private function calculateSkillLevel($elo)
    {
        // Asumimos que el skill level va de 0 a 20, basado en el ELO (800 a 1600)
        $skillLevel = max(0, min(20, intval(($elo - 800) / 40)));
        return $skillLevel;
    }
    // public function aimove(Request $request)
    // {
    //     try {
    //         $data = $request->json()->all();
    //         $fen = $data['fen'] ?? null;
    //         $elo = isset($data['elo']) ? intval($data['elo']) : null;

    //         if ($fen === null || $elo === null) {
    //             return response()->json(['error' => 'FEN o ELO faltante'], 400);
    //         }

    //         if ($elo < 800 || $elo > 1600) {
    //             return response()->json(['error' => 'ELO debe estar entre 800 y 1600'], 400);
    //         }

    //         $skillLevel = $this->calculateSkillLevel($elo);

    //         $stockfishPath = self::STOCKFISH_PATH;

    //         $descriptorspec = array(
    //             0 => array("pipe", "r"),  // stdin
    //             1 => array("pipe", "w"),  // stdout
    //             2 => array("pipe", "w")   // stderr
    //         );

    //         $process = proc_open($stockfishPath, $descriptorspec, $pipes);

    //         if (!is_resource($process)) {
    //             return response()->json(['error' => 'No se pudo iniciar el motor Stockfish'], 500);
    //         }

    //         $stdin = $pipes[0];
    //         $stdout = $pipes[1];
    //         $stderr = $pipes[2];

    //         // Configurar el nivel de habilidad del motor
    //         fwrite($stdin, "setoption name Skill Level value {$skillLevel}\n");

    //         // Cargar la posición FEN
    //         fwrite($stdin, "position fen {$fen}\n");

    //         // Iniciar la búsqueda
    //         fwrite($stdin, "go movetime 1000\n");

    //         // Leer la salida del motor
    //         $bestMove = null;
    //         while ($line = fgets($stdout)) {
    //             if (strpos($line, 'bestmove') !== false) {
    //                 $parts = explode(' ', $line);
    //                 if (isset($parts[1])) {
    //                     $bestMove = trim($parts[1]);
    //                 }
    //                 break;
    //             }
    //         }

    //         // Cerrar los recursos
    //         fclose($stdin);
    //         fclose($stdout);
    //         fclose($stderr);
    //         proc_close($process);

    //         if ($bestMove === null) {
    //             return response()->json(['error' => 'No se pudo obtener la mejor jugada de Stockfish'], 500);
    //         }

    //         // Procesar la mejor jugada
    //         $from = substr($bestMove, 0, 2);
    //         $to = substr($bestMove, 2, 2);
    //         $promotion = strlen($bestMove) > 4 ? substr($bestMove, 4, 1) : '';

    //         $response = [
    //             'from' => $from,
    //             'to' => $to,
    //             'promotion' => $promotion
    //         ];

    //         return response()->json($response);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function aimove(Request $request)
    {
        try {
            $data = $request->json()->all();
            $fen = $data['fen'] ?? null;
            $elo = isset($data['elo']) ? intval($data['elo']) : null;

            if ($fen === null || $elo === null) {
                return response()->json(['error' => 'FEN o ELO faltante'], 400);
            }

            if ($elo < 800 || $elo > 1600) {
                return response()->json(['error' => 'ELO debe estar entre 800 y 1600'], 400);
            }

            // Mapear ELO al nivel de habilidad de Stockfish (0 a 20)
            $skillLevel = intval(($elo - 800) / 40); // Esto convierte 800-1600 en el rango de 0-20
            $skillLevel = 0;
            $stockfishPath = self::STOCKFISH_PATH;

            $descriptorspec = array(
                0 => array("pipe", "r"),  // stdin
                1 => array("pipe", "w"),  // stdout
                2 => array("pipe", "w")   // stderr
            );

            $process = proc_open($stockfishPath, $descriptorspec, $pipes);

            if (!is_resource($process)) {
                return response()->json(['error' => 'No se pudo iniciar el motor Stockfish'], 500);
            }

            $stdin = $pipes[0];
            $stdout = $pipes[1];
            $stderr = $pipes[2];

            // Configurar el nivel de habilidad del motor
            fwrite($stdin, "setoption name Skill Level value {$skillLevel}\n");

            // Cargar la posición FEN
            fwrite($stdin, "position fen {$fen}\n");

            // Iniciar la búsqueda
            fwrite($stdin, "go movetime 10\n");

            // Leer la salida del motor
            $bestMove = null;
            while ($line = fgets($stdout)) {
                if (strpos($line, 'bestmove') !== false) {
                    $parts = explode(' ', $line);
                    if (isset($parts[1])) {
                        $bestMove = trim($parts[1]);
                    }
                    break;
                }
            }

            // Cerrar los recursos
            fclose($stdin);
            fclose($stdout);
            fclose($stderr);
            proc_close($process);

            if ($bestMove === null) {
                return response()->json(['error' => 'No se pudo obtener la mejor jugada de Stockfish'], 500);
            }

            // Procesar la mejor jugada
            $from = substr($bestMove, 0, 2);
            $to = substr($bestMove, 2, 2);
            $promotion = strlen($bestMove) > 4 ? substr($bestMove, 4, 1) : '';

            $response = [
                'from' => $from,
                'to' => $to,
                'promotion' => $promotion
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
