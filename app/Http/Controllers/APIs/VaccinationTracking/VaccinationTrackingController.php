<?php

namespace App\Http\Controllers\APIs\VaccinationTracking;

use Exception;
use Illuminate\Http\Request;
use App\Models\VaccinationBooster;
use Illuminate\Support\Facades\DB;
use App\Models\VaccinationTracking;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\VaccinationBoosterResource;
use App\Http\Resources\VaccinationTrackingResource;
use App\Http\Requests\Vaccination\VaccinationBoosterRequest;
use App\Http\Requests\Vaccination\VaccinationTrackingRequest;

class VaccinationTrackingController extends Controller
{
    public function saveVaccinationTracking(VaccinationTrackingRequest $request)
    {
        $validator = $request->validated();

        try {
            $vaccinationTracking = new VaccinationTracking;
            $vaccinationTracking->user_id           = $validator['user_id']          ?? null;
            $vaccinationTracking->name              = $validator['name']             ?? null;
            $vaccinationTracking->type              = $validator['type']             ?? null;   
            $vaccinationTracking->primary_dose_date = $validator['primary_dose_date']?? null;
            $vaccinationTracking->status            = $validator['status']           ?? null;   
            $vaccinationTracking->hospital          = $validator['hospital']         ?? null;
            $vaccinationTracking->save();

            Log::info("Successfully create the Vaccination Tracking", ['create' => 'success']);
            return response()->apiSuccess(new VaccinationTrackingResource($vaccinationTracking),"Successfully create the Vaccination Tracking.");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function saveVaccinationBooster(VaccinationBoosterRequest $request)
    {
        $validator = $request->validated();

        try {
            $booster = new VaccinationBooster;
            $booster->user_id                 = $validator['user_id']                 ?? null;
            $booster->vaccination_tracking_id = $validator['vaccination_tracking_id'] ?? null; // FK to vaccination_trackings
            $booster->name                    = $validator['name']                    ?? null;
            $booster->due_date                = $validator['due_date']                ?? null;
            $booster->status                  = $validator['status']                  ?? 'active'; // active / pending
            $booster->save();

            Log::info("Successfully create the Vaccination Booster", ['create' => 'success']);
            return response()->apiSuccess(new VaccinationBoosterResource($booster),"Successfully create the Vaccination Booster.");
        } catch (Exception $e) {
            return response()->apiCatchError($e);
        }
    }

    public function getVaccinationData(Request $request)
    {
    try {
        $primaryDoseDate = $request->input('primary_dose_date');

        $vaccinations = VaccinationTracking::withCount('vaccinationBooster') 
            ->where('primary_dose_date', $primaryDoseDate)
            ->get();

        if ($vaccinations->isEmpty()) {
            Log::info('No vaccination records found for given primary_dose_date.', [
                'primary_dose_date' => $primaryDoseDate,
            ]);

            return response()->apiError(
                'No record found while fetching the vaccination information.'
            );
        }

        Log::info('Successfully fetched the Vaccination Information', [
            'count'             => $vaccinations->count(),
            'primary_dose_date' => $primaryDoseDate,
        ]);

        return response()->apiSuccess(
            VaccinationTrackingResource::collection($vaccinations),
            'Successfully fetched the Vaccination Information.'
        );

    } catch (Exception $e) {
        return response()->apiCatchError($e);
    }
}
}
