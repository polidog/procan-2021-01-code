<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Gacha;
use App\Models\User;
use App\Service\ItemBoxService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GachaController extends Controller
{
    public function index()
    {
        $itemBoxService = $this->createItemBox();
        $gacha = Gacha::first();
        return view('gacha/index', [
            'gacha' => $gacha,
            'isFull' => $itemBoxService->isFull(),
        ]);
    }

    public function exec(int $id)
    {
        $gacha = Gacha::find($id);

        if (!$gacha instanceof Gacha) {
            throw new NotFoundHttpException('gacha not found.');
        }
        $itemBoxService = $this->createItemBox();
        $item = $gacha->draw($itemBoxService);
        return view('gacha/exec', ['item' => $item]);
    }

    private function createItemBox(): ItemBoxService
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            throw new \Exception('user not found');
        }
        return new ItemBoxService($user);
    }
}
