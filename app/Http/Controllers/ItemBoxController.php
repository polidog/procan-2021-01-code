<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\ItemBoxService;
use Illuminate\Support\Facades\Auth;

class ItemBoxController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $itemBoxService = $this->createItemBox();

        return view('itemBox.index', [
            'items' => $itemBoxService->getItems(),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(int $id): \Illuminate\Http\RedirectResponse
    {
        $itemBoxService = $this->createItemBox();
        $itemBoxService->remove($id);
        return redirect()->route('itemBox');
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
