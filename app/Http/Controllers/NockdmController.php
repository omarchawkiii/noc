<?php

namespace App\Http\Controllers;

use App\Models\Nockdm;
use App\Models\Screen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NockdmController extends Controller
{
    public function uploadlocalkdm(Request $request)
    {
        try
        {
            foreach ($request->kdmfiles as $kdmfile )
            {
                $kdm_file_content = simplexml_load_file($kdmfile);

                $file_content = $kdm_file_content->asXML();

                $kdm_file_data ["MessageId"] = (string)$kdm_file_content->AuthenticatedPublic->MessageId;
                $kdm_file_data ["AnnotationText"] = (string)$kdm_file_content->AuthenticatedPublic->AnnotationText;
                $kdm_file_data ["CompositionPlaylistId"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->CompositionPlaylistId;
                $kdm_file_data ["ContentTitleText"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->ContentTitleText;
                $kdm_file_data ["ContentKeysNotValidBefore"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->ContentKeysNotValidBefore;
                $kdm_file_data ["ContentKeysNotValidAfter"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->ContentKeysNotValidAfter;
                $kdm_file_data ["SubjectName"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->Recipient->X509SubjectName;
                $kdm_file_data ["SerialNumber"] = (string)$kdm_file_content->Signer->X509SerialNumber;
                $kdm_file_data ["DeviceListDescription"] = (string)$kdm_file_content->AuthenticatedPublic->RequiredExtensions->KDMRequiredExtensions->AuthorizedDeviceInfo->DeviceListDescription;


                $file_name = $kdm_file_data['MessageId'].".xml" ;

                $cn_dn_table = $this->getDnCn($kdm_file_data ["SubjectName"]);
                $screen = $this->getScreenByDnCn($cn_dn_table['CN'], $cn_dn_table['dnQualifier']) ;
                dd($screen) ;
                $file_url = Storage::disk('local')->put( $file_name, $file_content) ;


                $noc_kdm = Nockdm::updateOrCreate([
                    'uuid' => $kdm_file_data['MessageId'],
                    //'location_id' => $location->id
                ],[
                    'uuid' => $kdm_file_data['MessageId'],
                    'name' => $kdm_file_data ["ContentTitleText"],
                    'ContentKeysNotValidBefore' => $kdm_file_data ["ContentKeysNotValidBefore"],
                    'ContentKeysNotValidAfter' => $kdm_file_data ["ContentKeysNotValidAfter"],
                   /* 'kdm_installed' => $kdm['kdm_installed'],
                    'content_present' => $kdm['content_present'], */
                    'serverName_by_serial' => $kdm_file_data ["SerialNumber"],
                    'cpl_uuid' => null,
                    'cpl_id' => null,
                    'screen_id' => null,
                    'location_id' => null,
                ]);



            }
            echo "Success" ;

        } catch (Exception $e) {
            echo "Failed" ;
            return $e;
        }

    }

    public function getDnCn($SubjectName)
    {
        $keys = ['dnQualifier', 'CN', 'O', 'OU'];
        $result = [];

        // Iterate through the keys and extract the corresponding values
        foreach ($keys as $key)
        {
            preg_match('/' . $key . '=([^,]+)/', $SubjectName, $matches);
            if (isset($matches[1]))
            {
                $result[$key] = $matches[1];
            }
        }
        return $result;
    }


    public function getScreenByDnCn($dn,$cn)
    {

        /*$screen = Screen::where('dolby_audio_processor_dnQualifier',$dn)
        ->orWhere(function ($q) {

            $q->where('jp2k_dnQualifier', $dn)->Where('jp2k_cn', $cn);
        })
       ->first() ;*/
       $screen = Screen::where('jp2k_dnQualifier', $dn)->Where('jp2k_cn', $cn)->first() ;
       dd($screen) ;
       return $screen ;
    }

}
