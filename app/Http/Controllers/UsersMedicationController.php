<?php

namespace App\Http\Controllers;

use App\Repositories\UserMed\UsersMedicationRepositoryContract;
use App\Services\UsersMedicationService;
use Illuminate\Http\Request;

class UsersMedicationController extends Controller
{
    public function __construct(
        protected UsersMedicationRepositoryContract $userMedRepo,
        protected UsersMedicationService $userMedService
    ) {}

    public function store()
    {
        /**
         * todo
         * - **Add Drug**:
         * - Description: Add a new drug to the user's medication list.
         * - Payload: `rxcui` (string)
         * - Validation: Ensure `rxcui` is valid (using National Library of Medicine API).
         */

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
