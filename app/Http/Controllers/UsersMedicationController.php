<?php

namespace App\Http\Controllers;

use App\Helpers\HttpHandler;
use App\Http\Requests\AddMedicationRequest;
use App\Repositories\UserMed\UsersMedicationRepositoryContract;
use App\Services\UsersMedicationService;
use Illuminate\Http\JsonResponse;
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
        $med = $this->userMedService->addMedication($user->id, $request->input('rxcui'));

        if($med === true) {
            return HttpHandler::successMessage("Medication is added for the user",  Response::HTTP_CREATED);
        }

        return HttpHandler::errorMessage("Medicine not found",  Response::HTTP_NOT_FOUND);
    }

    public function index()
    {
        /**
         * todo
         * - **Get User Drugs**:
         * - Description: Retrieve all drugs from the user's medication list.
         * - Returns: Rx ID, Drug name, baseNames (ingredientAndStrength), doseFormGroupName (doseFormGroupConcept).
         */

    }

    public function destroy(string $rxcui)
    {
        /**
         * todo
         * - **Delete Drug**:
         * - Description: Delete a drug from the user's medication list.
         * - Validation: Ensure `rxcui` is valid and exists in the user’s list.
         */

    }

}
