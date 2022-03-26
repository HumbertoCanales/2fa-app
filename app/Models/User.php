<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );

        $receiverNumber = auth()->user()->phone;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1 style="font-size: 50px">'.$code.'</h1>');
        $folder = getenv('DO_SPACES_FOLDER');
        $uuid = (string) Str::uuid();
        $fileName = $folder.'/'.$uuid.'.pdf';
        Storage::put($fileName, $pdf->output());
        $url = Storage::temporaryUrl($fileName, now()->addMinutes(5));
        $data = ["long_url" => $url];
        $json = json_encode($data);

        $response = Http::withBody($json, 'application/json')->withOptions([
            'headers' => ['Authorization' => 'Bearer '.getenv('BITLY_TOKEN'),]
        ])->post("https://api-ssl.bitly.com/v4/shorten");

        $message = $response['link'];

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
