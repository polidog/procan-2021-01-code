<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Gacha;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GachaController extends Controller
{
    public function index()
    {
        $gacha = Gacha::first();
        return view('gacha/index', ['gacha' => $gacha]);
    }

    public function exec(int $id)
    {
        $gacha = Gacha::find($id);
        if (!$gacha instanceof Gacha) {
            throw new NotFoundHttpException('gacha not found.');
        }
        $item = $gacha->draw();
        return view('gacha/exec', ['item' => $item]);
    }
}
