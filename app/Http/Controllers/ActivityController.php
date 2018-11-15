<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $activity = DB::table('activities')->where('id', $id)->first();
        $reviews = DB::table('reviews')
            ->where('activity', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('activity')
            ->withActivity($activity)
            ->withReviews($reviews);
    }

    /**
     * Show the application dashboard.
     *
     * @return mixed
     */
    public function comment(Request $request, $id)
    {
        $data = $request->validate([
            'sid'     => 'bail | required | integer',
            'sname'   => [
                'bail',
                'required',
                'max:10',
                function ($attribute, $value, $fail) {
                    $stu = db::table("student_info")->find($_POST['sid']);
                    if ($stu == null || $stu->name != $value) {
                        $fail("错误代码01：学生信息 “". $_POST['sid']
                            . "-" . $value . "” 错误或无权限。如确认无误请联系管理员。");
                    }
                }],
            'comment' => 'bail | required | min:10 | max:500',
            'desire'  => 'max:500',
        ], $this->messages());

        $comment = clean($data['comment']);
        $desire = clean($data['desire']);
        db::table('reviews')->insert([
            'activity' => $id,
            'user' => 0, // anonymous
            'comment' => $comment,
            'desire' => $desire
        ]);
        return redirect()->back()
            ->withFlashSuccess("提交成功。");
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sid.required'     => '错误代码11：缺少学号。',
            'sid.integer'      => '错误代码12：学号非数字。',
            'sname.required'   => '错误代码13：缺少姓名。',
            'sname.max'        => '错误代码14：姓名过长。',
            'comment.required' => '错误代码15：没有填写反馈。',
            'comment.min'      => '错误代码16：反馈长度少于10字符。',
            'comment.max'      => '错误代码17：反馈长度超出500字符。',
            'desire.max'       => '错误代码18：期望长度超出500字符。',
        ];
    }
}
