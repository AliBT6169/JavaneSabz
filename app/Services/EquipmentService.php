<?php

namespace App\Services;

use App\DTOs\Products\EquipmentWithDTO;
use App\DTOs\Site\CollectionWithPaginationDTO;
use App\DTOs\Site\PaginationDTO;
use App\Models\Equipment;
use App\Repositories\EquipmentRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use function Webmozart\Assert\Tests\StaticAnalysis\uuid;

class EquipmentService
{

    public function __construct(protected EquipmentRepository $equipmentRepository)
    {
        //
    }

    public function getWithPagination(): ?CollectionWithPaginationDTO
    {
        return $this->equipmentRepository->getWithPaginate();
    }

    /**
     * @return list<EquipmentWithDTO>
     */
    public function getAll(): array
    {
        return $this->equipmentRepository->getAll();
    }

    public function create(EquipmentWithDTO $equipmentDTO): EquipmentWithDTO
    {
        if ($equipmentDTO->icon == null)
            return $this->equipmentRepository->create($equipmentDTO);
        else {
            $imageName = uniqid() . '.' . $equipmentDTO->icon->getClientOriginalExtension();
            $path = '/images/equipments/' . $imageName;
            File::ensureDirectoryExists(public_path('images/equipments/'));
            $equipmentDTO->icon->move(public_path('images/equipments'), $imageName);
            $equipmentDTO->iconPath = $path;
            return $this->equipmentRepository->create($equipmentDTO);
        }
    }

    public function update(EquipmentWithDTO $equipmentDTO): bool
    {
        if ($equipmentDTO->icon == null)
            return $this->equipmentRepository->update($equipmentDTO->id, $equipmentDTO);
        else {
            $imageName = uniqid() . '.' . $equipmentDTO->icon->getClientOriginalExtension();
            $path = '/images/equipments/' . $imageName;
            $oldImagePath = $this->equipmentRepository->getIcon($equipmentDTO->id);
            if (isset($oldImagePath) && File::exists(public_path($oldImagePath)))
                File::delete(public_path($oldImagePath));
            $equipmentDTO->icon->move(public_path('images/equipments'), $imageName);
            $equipmentDTO->iconPath = $path;
            return $this->equipmentRepository->update($equipmentDTO->id, $equipmentDTO);
        }
    }

    public function search(string $text): ?CollectionWithPaginationDTO
    {
        return $this->equipmentRepository->findByName($text);
    }

    public function destroy(int $id): bool
    {
        $image = $this->equipmentRepository->getIcon($id);
        if ($image && File::exists(public_path($image)))
            unlink(public_path($image));
        return $this->equipmentRepository->delete($id);
    }

    public function find(int $id): EquipmentWithDTO
    {
        return $this->equipmentRepository->find($id);
    }

}
