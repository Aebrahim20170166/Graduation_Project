<?php
namespace App\Http\Controllers\Announcement;
session()->start();

use App\Models\Announcement;

use App\Http\Controllers\Controller;
use App\Models\StudentCourses;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{


    public function makepost(Request $request)
    {

        if(Announcement::create(['course_id' => $request->courseID, 'body' => $request->announcement]))
        {
            $SERVER_API_KEY = 'AAAAPyzlfXg:APA91bGScyp2FtDUNyrPLzv4sCfnJLBtpdv7xHAQeuX7I9olst9indBNe7oU6r5T6Qy0hsnRAZ-bV-W9SZlygkawFHzfMdjUSspEvFdGV27BFuF6Sh_rTttVkFPEextdA22sfCZRXkXB';
            $records=StudentCourses::query()->join('courses','courses.course_id','=',
                'studentcourses.course_id')
                ->select('studentcourses.token','courses.name')
                ->where('course_id','=',$request->courseID)
                ->get();
            $tokens=array();
            foreach ($records as $record)
            {
                $tokens[]=$record->token;
            }
            //$token_1 = 'Test Token';

            $data = [

                "registration_ids" => [
                    $tokens
                ],

                "notification" => [

                    "title" => 'New Announcement',

                    "body" => $request->body,

                    "sound"=> "default" // required for sound on ios

                ],

            ];

            $dataString = json_encode($data);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);

            dd($response);
        }
        $Announcements = Announcement::query()
            ->where('course_id', '=', "$request->courseID")
            ->get();
        return view('staff/makeAnnouncement',['Announcements' => $Announcements]);
    }

    public function updatepost(Request $request)
    {
        return view('staff/updateAnnouncement', ['course_id' => $request->courseID, 'body' => $request->body, 'postid' => $request->postid]);
    }


    public function saveupdate(Request $request)
    {
        Announcement::where(['course_id'=>$request->courseID])
            ->where(['id'=>$request->postid])
            ->update([
                'body' => $request->body
            ]);
        $Announcements = Announcement::query()
            ->where([
                ['course_id', '=', $request->courseID]
            ])
            ->get();

        return view('staff/makeAnnouncement',['Announcements' => $Announcements]);
    }


    public function deletepost(Request $request)
    {
        Announcement::where(['course_id'=>$request->courseID])
            ->where(['id'=>$request->postid])
            ->delete();
        $Announcements = Announcement::query()
            ->where([
                ['course_id', '=', $request->courseID]
            ])
            ->get();

        return view('staff/makeAnnouncement',['Announcements' => $Announcements]);
    }
    public function getpost(Request $request){
        $Announcements = Announcement::query()
            ->where([
                ['course_id', '=', $request->courseID]
            ])
            ->get();
        return view('staff/makeAnnouncement',['Announcements' => $Announcements]);
    }

}
