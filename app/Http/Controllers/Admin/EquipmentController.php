<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Products\EquipmentWithDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Equipment\EquipmentStoreRequest;
use App\Http\Requests\Admin\Equipment\EquipmentUpdateRequest;
use App\Http\Resources\Admin\Equipments\EquipmentResource;
use App\Repositories\EquipmentRepository;
use App\Services\EquipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EquipmentController extends Controller
{
    public function __construct(protected EquipmentService $equipmentService)
    {

    }

    public function index()
    {
        $equipments = $this->equipmentService->getWithPagination();
        if ($equipments == null) return Inertia::render('Admin/pages/Equipments/Index', []);
        return Inertia::render('Admin/pages/Equipments/Index', ['equipments' => $equipments->items, 'pagination' => $equipments->paginationDTO]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/pages/Equipments/Create');
    }

    public function store(EquipmentStoreRequest $request)
    {
        if ($this->equipmentService->create(EquipmentWithDTO::fromEquipmentController($request->validated())))
            return response()->noContent();
        else
            abort(500, 'مشکلی به وجود آمده است!');
    }

    public function edit(int $id): Response
    {
        return Inertia::render('Admin/pages/Equipments/Edit', ['equipment' => $this->equipmentService->find($id)]);
    }

    public function update(EquipmentUpdateRequest $request)
    {
        if ($this->equipmentService->update(EquipmentWithDTO::fromEquipmentController($request->validated())))
            return response()->noContent();
        else
            abort(500, 'مشکلی به وجود آمده است!');
    }

    public function search(string $word): Response
    {
        $equipments = $this->equipmentService->search($word);
        if ($equipments == null) return Inertia::render('Admin/pages/Equipments/Index', []);
        return Inertia::render('Admin/pages/Equipments/Index', ['equipments' => $equipments->items, 'pagination' => $equipments->paginationDTO]);
    }

    public function destroy(int $id): \Illuminate\Http\Response
    {
        $status = $this->equipmentService->destroy($id);
        if ($status)
            return response()->noContent();
        else
            abort(500, 'مشکلی پیش اومده!!!');
    }
}
