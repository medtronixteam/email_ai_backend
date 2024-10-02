<?php
namespace App\Http\Controllers;

use App\Jobs\GmailJob;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\User;
use Google\Service\Gmail;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect'));
        $this->client->addScope("https://www.googleapis.com/auth/gmail.send");
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }
    public function generateUrl(Request $request)
    {
        if (auth('sanctum')->check()) {

            $authUrl = Str::random(100);
            $authUrlCode = Str::random(40);
            User::find(auth('sanctum')->user()->id)->update(['google_url' => $authUrl]);
            $urlToSend=url('/auth/redirect/google') . "?q=" . $authUrlCode . "&from=" . $authUrl;
            return response()->json(['message' => $urlToSend,'status'=>'success'], 200);
        }

        return redirect('/login');

    }

    public function redirectToGoogle(Request $request)
    {
        if (!$request->has('from')) {
            return redirect('/login');
        }

        $GoogleFinder = User::where('google_url', $request->get('from'));
        if ($GoogleFinder->count() === 0) {
            return redirect('/login');
        }
        $GoogleFinder = $GoogleFinder->first();
        session(['google_access_token' => $request->get('from')]);
        $authUrl = $this->client->createAuthUrl();

        return redirect($authUrl);

    }

    public function handleGoogleCallback(Request $request)
    {


        if (!session('google_access_token')) {
            return redirect('/login');
        }
        $accessToken = $this->client->fetchAccessTokenWithAuthCode($request->input('code'));
        User::where('google_url',session('google_access_token'))->update(['google_access_token' => $accessToken,'google_url'=>null]);
        session()->forget('google_access_token');
        return redirect(env('OTHER_URL'));
    }
    public function sendGmails($compainId)
    {

        $compains=Campaign::find($compainId);
        if($compains->user->google_access_token!=null){

            Log::info("<-------email config-------->");
            $emails = Group::join('contacts', 'groups.id', '=', 'contacts.group_id')->where('groups.id', $compains->group_id)->where('contacts.is_sent',1);
            if($emails->count() > 0){
                $compains->update(['status' => 'started']);

                    foreach ($emails->get() as $contact) {
                        Log::info("<-------email loop-------->" .$contact->email);

                        Log::info("<-------email loop-------->".$compains);

                        GmailJob::dispatch('ranashahroz.shabbir786@gmail.com ');
                    }

            }else{
                $compains->update(['status' => 'completed']);
            }
        }

    }
    public function sendEmails(Request $request)
    {
        $accessToken = session('google_access_token');

        if (!$accessToken) {
            return redirect('/auth/google');
        }

        $this->client->setAccessToken($accessToken);

        $service = new Google_Service_Gmail($this->client);

        foreach ($request->emails as $recipient) {
            $message = new Google_Service_Gmail_Message();
            $rawMessageString = "From: user@gmail.com\r\n";
            $rawMessageString .= "To: {$recipient}\r\n";
            $rawMessageString .= "Subject: {$request->subject}\r\n\r\n";
            $rawMessageString .= $request->body;

            $encodedMessage = base64_encode($rawMessageString);
            $encodedMessage = str_replace(['+', '/', '='], ['-', '_', ''], $encodedMessage);

            $message->setRaw($encodedMessage);

            try {
                $service->users_messages->send('me', $message);
            } catch (\Exception $e) {
                // Handle error
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['message' => 'Emails sent successfully!']);
    }
}
/////
