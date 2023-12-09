<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientApiException;
use App\Exceptions\DatabaseException;
use App\Helpers\HttpHandler;
use App\Repositories\Medicine\MedicineRepositoryContract;
use App\Services\MedicineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MedicineController extends Controller
{
    public function __construct(
        protected MedicineRepositoryContract $medicineRepo,
        protected MedicineService $medicineService
    ) {}
    public function searchMedicine(Request $request): JsonResponse
    {
        /**
         * todo: remove after unit test
         * 1. Call this endpoint: https://rxnav.nlm.nih.gov/REST/drugs.json?name=actos, for tty = “SBD”.
         * 1.1 from responseFetch the “name” of the top 5 results
         * 2. use getRxcuiHistoryStatus API from National Library of Medicine to fetch:
         * 2.1 All `baseName` under `ingredientAndStrength`
         * 2.2 Different `doseFormGroupName` from `doseFormGroupConcept`
         * 3. returns: [{id: rxcui, drug_name: DrugName, baseNames: [], doseFormGroupName: [] }]
         */
        try {
            $drugName = $request->query('drug_name');
            if (empty($drugName)) {
                return HttpHandler::errorMessage('Drug name is required.', 422);
            }

            $drugInfo = $this->medicineService->getDrugs($drugName);
            $drugData = $this->medicineService->extractDrugInfo($drugInfo);
            $details = $this->medicineService->getDrugDetails($drugData);

            return HttpHandler::successResponse($this->medicineRepo->saveDrugs($details));
        } catch (ClientApiException $cex) {
            return HttpHandler::errorMessage($cex->getMessage(), $cex->getCode());
        } catch (DatabaseException $dbex) {
            return HttpHandler::errorMessage($dbex->getMessage(), $dbex->getCode());
        } catch (\Exception $ex) {
            Log::error('Controller error: ' . $ex->getMessage());
            return HttpHandler::errorMessage($ex->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
