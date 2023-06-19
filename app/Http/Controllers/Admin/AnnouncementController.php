<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $validator = null;
        $input = null;
        $auth_user = Auth::user();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'post_date' => 'required|date',
                'expiration_date' => 'required|date',
                'announcement_category' => 'required',
                'message' => 'required',
                'attachment' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ])->setAttributeNames([
                'title' =>  trans('public.title'),
                'post_date' =>  trans('public.post_date'),
                'expiration_date' =>  trans('public.expiration_date'),
                'announcement_category' =>  trans('public.announcement_category'),
                'message' =>  trans('public.message'),
                'attachment' =>  trans('public.attachment'),
            ]);

            if (!$validator->fails()) {
                if ($request->has('require_participation')) {
                    $require_participation = true;
                } else {
                    $require_participation = false;
                }
                $announcement = Announcements::create([
                    'title' => $request->input('title'),
                    'messages' => $request->input('message'),
                    'category' => $request->input('announcement_category'),
                    'participation' => $require_participation,
                    'post_date' => $request->input('post_date'),
                    'expiration_date' => $request->input('expiration_date'),
                    'user_id' => $auth_user->id,
                ]);

                $attachment = $request->file('attachment');
                if ($attachment) {
                    if ($announcement->$attachment) {
                        // Delete the previous file if needed
                        File::delete('/uploads/announcements' . $announcement->$attachment);
                    }
                    $file_attachment = time() . '.' . $attachment->getClientOriginalExtension();
                    $attachment->move(public_path('/uploads/announcements'), $file_attachment);
                    $announcement->attachment = $file_attachment;
                };

                $announcement->save();

                Alert::success(trans('public.success'), trans('public.successfully_added_department'));
                return redirect()->route('announcements_index');
            }

            $input = (object) $request->all();
        }


        return view('announcements.index', [
            'title' => trans('public.announcements'),
            'records' => Announcements::all(),
            'categories' => array(
                Announcements::CATEGORY_ANNOUNCEMENT => trans('public.company_announcement'),
                Announcements::CATEGORY_ACTIVITY => trans('public.company_activity'),
            ),
            'input' => $input,

        ])->withErrors($validator);
    }

    public function update(Request $request)
    {
        $validator = null;
        $input = null;

        if ($request->isMethod('post')) {
            $announcement = Announcements::find($request->id);
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'post_date' => 'required|date',
                'expiration_date' => 'required|date',
                'announcement_category' => 'required',
                'message' => 'required',
                'attachment' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ])->setAttributeNames([
                'title' =>  trans('public.title'),
                'post_date' =>  trans('public.post_date'),
                'expiration_date' =>  trans('public.expiration_date'),
                'announcement_category' =>  trans('public.announcement_category'),
                'require_participation' =>  trans('public.require_participation'),
                'message' =>  trans('public.message'),
                'attachment' =>  trans('public.attachment'),
            ]);;

            if (!$validator->fails()) {
                if ($request->has('require_participation')) {
                    $require_participation = true;
                } else {
                    $require_participation = false;
                }
                $update_info = [
                    'title' => $request->input('title'),
                    'messages' => $request->input('message'),
                    'category' => $request->input('announcement_category'),
                    'participation' => $require_participation,
                    'post_date' => $request->input('post_date'),
                    'expiration_date' => $request->input('expiration_date'),
                ];
                $announcement->update($update_info);

                $attachment = $request->file('attachment');
                if ($attachment) {
                    if ($announcement->$attachment) {
                        // Delete the previous file if needed
                        File::delete('/uploads/announcements' . $announcement->$attachment);
                    }
                    $file_attachment = time() . '.' . $attachment->getClientOriginalExtension();
                    $attachment->move(public_path('/uploads/announcements'), $file_attachment);
                    $announcement->attachment = $file_attachment;
                };

                $announcement->save();

                Alert::success(trans('public.success'), trans('public.update_announcement'));
                return redirect()->route('announcements_index');
            }

            $input = (object)$request->all();
        }

        return view('announcements.index', [
            'title' => trans('public.announcements'),
            'records' => Announcements::all(),
            'categories' => array(
                Announcements::CATEGORY_ANNOUNCEMENT => trans('public.company_announcement'),
                Announcements::CATEGORY_ACTIVITY => trans('public.company_activity'),
            ),
            'input' => $input,

        ])->withErrors($validator);
    }

    public function getData($id)
    {
        $data = Announcements::find($id);

        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $announcement = Announcements::find($request->input('id'));

        if (!$announcement) {
            Alert::error(trans('public.invalid_announcement'), trans('public.try_again'));
            return redirect('announcements_index');
        }

        $announcement->delete();

        Alert::success(trans('public.success'), trans('public.successfully_deleted_announcement'));
        return redirect()->route('announcements_index');
    }
}
