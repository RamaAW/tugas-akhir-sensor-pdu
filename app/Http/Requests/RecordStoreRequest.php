<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Date-Time' => 'required|date_format:Y-m-d H:i:s',
            'BitDepth' => 'nullable|numeric',
            'Scfm' => 'nullable|numeric',
            'MudCondIn' => 'nullable|numeric',
            'BlockPos' => 'nullable|numeric',
            'WOB' => 'nullable|numeric',
            'ROPi' => 'nullable|numeric',
            'BVDepth' => 'nullable|numeric',
            'MudCondOut' => 'nullable|numeric',
            'Torque' => 'nullable|numeric',
            'RPM' => 'nullable|numeric',
            'Hkld' => 'nullable|numeric',
            'LogDepth' => 'nullable|numeric',
            'H2S_1' => 'nullable|numeric',
            'MudFlowOutp' => 'nullable|numeric',
            'TotSPM' => 'nullable|numeric',
            'SpPress' => 'nullable|numeric',
            'MudFlowIn' => 'nullable|numeric',
            'CO2_1' => 'nullable|numeric',
            'Gas' => 'nullable|numeric',
            'MudTempIn' => 'nullable|numeric',
            'MudTempOut' => 'nullable|numeric',
            'TankVolTot' => 'nullable|numeric',
            'RigId' => 'required|string|exists:rigs,id',
        ];
    }

    public function messages()
    {
        return [
            'Date-Time.required' => 'The Date-Time field is required.',
            'Date-Time.date_format' => 'The Date-Time must be in the format Y-m-d H:i:s.',
            'BitDepth.numeric' => 'The BitDepth must be a number.',
            'Scfm.numeric' => 'The Scfm must be a number.',
            'MudCondIn.numeric' => 'The MudCondIn must be a number.',
            'BlockPos.numeric' => 'The BlockPos must be a number.',
            'WOB.numeric' => 'The WOB must be a number.',
            'ROPi.numeric' => 'The ROPi must be a number.',
            'BVDepth.numeric' => 'The BVDepth must be a number.',
            'MudCondOut.numeric' => 'The MudCondOut must be a number.',
            'Torque.numeric' => 'The Torque must be a number.',
            'RPM.numeric' => 'The RPM must be a number.',
            'Hkld.numeric' => 'The Hkld must be a number.',
            'LogDepth.numeric' => 'The LogDepth must be a number.',
            'H2S_1.numeric' => 'The H2S_1 must be a number.',
            'MudFlowOutp.numeric' => 'The MudFlowOutp must be a number.',
            'TotSPM.numeric' => 'The TotSPM must be a number.',
            'SpPress.numeric' => 'The SpPress must be a number.',
            'MudFlowIn.numeric' => 'The MudFlowIn must be a number.',
            'CO2_1.numeric' => 'The CO2_1 must be a number.',
            'Gas.numeric' => 'The Gas must be a number.',
            'MudTempIn.numeric' => 'The MudTempIn must be a number.',
            'MudTempOut.numeric' => 'The MudTempOut must be a number.',
            'TankVolTot.numeric' => 'The TankVolTot must be a number.',
            'RigId.required' => 'The Rig Id field is required.',
            'RigId.exists' => 'The selected Rig Id is invalid.',
        ];
    }
}
