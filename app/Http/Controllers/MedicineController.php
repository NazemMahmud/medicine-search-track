<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientApiException;
use App\Exceptions\DatabaseException;
use App\Helpers\HttpHandler;
use App\Models\Medicines;
use App\Repositories\Medicine\MedicineRepositoryContract;
use App\Services\MedicineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MedicineController extends Controller
{
    public function __construct(
        protected MedicineRepositoryContract $medicineRepo,
        protected MedicineService $medicineService
    ) {}
    public function searchMedicine(Request $request): JsonResponse
    {
        try {
            $drugName = strtolower($request->query('drug_name'));
            if (empty($drugName)) {
                return HttpHandler::errorMessage('Drug name is required.', 422);
            }

            if(Redis::sismember('drugs', $drugName)) {
                return HttpHandler::successMessage('This medicine is already searched and stored', 200);
            }

            $drugInfo = $this->medicineService->getDrugs($drugName);
            $drugData = $this->medicineService->extractDrugInfo($drugInfo);
            $details = $this->medicineService->getDrugDetails($drugData);

            Redis::sadd('drugs', $drugName);
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
