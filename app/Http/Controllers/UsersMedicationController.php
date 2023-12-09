<?php

namespace App\Http\Controllers;

use App\Helpers\HttpHandler;
use App\Http\Requests\AddMedicationRequest;
use App\Repositories\UserMed\UsersMedicationRepositoryContract;
use App\Services\UsersMedicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersMedicationController extends Controller
{
    public function __construct(
        protected UsersMedicationRepositoryContract $userMedRepo,
        protected UsersMedicationService $userMedService
    ) {}

    public function store(AddMedicationRequest $request): JsonResponse
    {
        /**
         * todo
         * Ensure `rxcui` is valid (using National Library of Medicine API).
         */
        $user = $request->user();
        if ($user->medications()->where('rxcui',  $request->input('rxcui'))->exists()) {
            return HttpHandler::successMessage("This medication is already added for this user",  Response::HTTP_OK);
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

        /**
         * todo
         * - Validation: Ensure `rxcui` is valid and exists in the user’s list.
         */

        $medication = $this->userMedRepo->findMedication($user, $rxcui);

        if (!$medication) {
            return HttpHandler::errorMessage('Medication not found for this user.', Response::HTTP_NOT_FOUND);
        }

        $this->userMedRepo->delete($user->id, $medication->id);
        return HttpHandler::successMessage('Medication removed successfully.');
    }

}
