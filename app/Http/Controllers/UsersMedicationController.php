<?php

namespace App\Http\Controllers;

use App\Helpers\HttpHandler;
use App\Http\Requests\AddMedicationRequest;
use App\Repositories\UserMed\UsersMedicationRepositoryContract;
use App\Services\MedicineService;
use App\Services\UsersMedicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersMedicationController extends Controller
{
    public function __construct(
        protected UsersMedicationRepositoryContract $userMedRepo,
        protected UsersMedicationService $userMedService,
        protected MedicineService $medicineService
    ) {}

    public function store(AddMedicationRequest $request): JsonResponse
    {
        $user = $request->user();
        if ($user->medications()->where('rxcui',  $request->input('rxcui'))->exists()) {
            return HttpHandler::successMessage("This medication is already added for this user",  Response::HTTP_OK);
        }

        if($this->medicineService->isDrugExist($request->input('rxcui')) === false) {
            return HttpHandler::errorMessage("This is not a valid medicine",  Response::HTTP_NOT_FOUND);
        }

        $med = $this->userMedService->addMedication($user->id, $request->input('rxcui'));

        if($med === true) {
            return HttpHandler::successMessage("Medication is added for the user",  Response::HTTP_CREATED);
        }

        return HttpHandler::errorMessage("Medicine not found",  Response::HTTP_NOT_FOUND);
    }

    public function index(Request $request): JsonResponse
    {
        return HttpHandler::successResponse(
            ['medications' => $this->userMedRepo->getMedications($request->user())]
        );
    }

    public function destroy(string $rxcui): JsonResponse
    {
        $user = auth()->user();

        if($this->medicineService->isDrugExist($rxcui) === false) {
            return HttpHandler::errorMessage("This is not a valid medicine",  Response::HTTP_NOT_FOUND);
        }

        $medication = $this->userMedRepo->findMedication($user, $rxcui);

        if (!$medication) {
            return HttpHandler::errorMessage('Medication not found for this user.', Response::HTTP_NOT_FOUND);
        }

        $this->userMedRepo->delete($user->id, $medication->id);
        return HttpHandler::successMessage('Medication removed successfully.');
    }

}
