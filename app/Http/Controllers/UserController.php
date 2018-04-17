<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/9
 * Time: 13:53
 */

namespace App\Http\Controllers;



use App\model\Screen;
use App\model\Seat;
use App\model\User;
use App\model\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /*z主要处理用户的信息*/
    private $validate = [
        'verifyCode'      =>  '/^[A-Za-z0-9]{4}$/u',                                    //4个字符的英文字符串
        'username'      =>  '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,20}$/u',                //3-20位的中文、英文、数字、下划线
        'password'      =>  '/^[A-Za-z0-9]{6,20}$/u',                              //6-20位的英文、数字
        'email'         =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/u',    //邮箱匹配
        'phone'         =>  '/^1[34578]\d{9}$/u',                                   //电话号码匹配
    ];

    /*
     * 用户注册验证
     * */
    public function register(Request $request)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $r_password = $_POST['password_confirmation'];
        $phone = $_POST['phone'];
        $verifyCode = $_POST['verifyCode'];
        $verifyCode = strtolower($verifyCode);
        $r_verifyCode = $_POST['verifyCode_confirmation'];
//        dd($username,$password,$r_password,$phone,$verifyCode);

        if($username & $password & $verifyCode)
        {
            $user = User::where('username','=',$username)->first();
            if($user)
            {
                return response()->json(['warning' => '用户名已存在']);
            }
            if(!preg_match($this->validate['username'],$username))
            {
//                $request->session()->flash('warning','用户名不合法');
                return response()->json(['warning','用户名不合法']);
            }
            if(!preg_match($this->validate['password'],$password) && !preg_match($this->validate['password'],$r_password))
            {
                return response()->json(['warning','密码不合法']);
            }
            if(!preg_match($this->validate['phone'],$phone))
            {
                return response()->json(['warning','手机号码不合法']);
            }
            if(!preg_match($this->validate['verifyCode'],$verifyCode))
            {
                return response()->json(['warning','验证码不合法']);
            }

            if($password === $r_password)
            {
                if($verifyCode === $r_verifyCode)
                {
//                            dd($username,$password,$r_password,$phone,$verifyCode);
                    $password = bcrypt($password);
                    $user = User::create([
                        'username' => $username,
                        'password' =>$password,
                        'phone' => $phone,
                    ]);
                    if ($user)
                    {
                        return response()->json(['success' => '注册成功，欢迎登陆']);
                    }
                    else
                    {
                        return response()->json(['danger' => '注册失败' ]);
                    }
                }
                else
                {
                    return response()->json(['warning' => '验证码错误']);
                }
            }
            else
            {
                return response()->json(['warning' => '两次密码不一致']);
            }
        }
        else
        {
            return response()->json(['warning' => '用户名、密码、验证码不能为空']);
//            $request->session()->flash('warning','用户名、密码、验证码不能为空');
//            return redirect()->back();
        }

    }

    /*
     * 用户登录验证
     * */
    public function login(Request $request)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $verifyCode = $_POST['verifyCode'];
        $verifyCode = strtolower($verifyCode);
        $r_verifyCode = $_POST['verifyCode_confirmation'];
        $remember = $request->remember;
//        dd($username,$password,$verifyCode,$remember);
        if($username & $password & $verifyCode)
        {
            $user = User::where('username','=',$username)->first();
            if($user)
            {
                if(Hash::check($password,$user->password))
                {
                    if($verifyCode === $r_verifyCode)
                    {
                        if($remember){
                            return response()->json(['success' => '登陆成功'])->withCookie('username',$username,10080);
                        }
                        return response()->json(['success' => '登陆成功'])->withCookie('username',$username);
                    }
                    else
                    {
                        return response()->json(['warning' => '验证码错误']);
                    }
                }
                else
                {
                    return response()->json(['warning' => '密码错误']);
                }
            }
            else
            {
                return response()->json(['warning' => '此用户名错误']);
            }
        }
        else
        {
            return response()->json(['warning' => '用户名、密码、验证码不能为空']);
        }

    }

    public function logOut()
    {
        return redirect()->route('home')->cookie('username','',-1);
    }

    public function editPerson()
    {
        $username = $_GET['username'];
        $user = User::where('username','=',$username)->first();
        return view('user.editPerson',['user' => $user]);
    }

    public function editPersonInfo()
    {
        $password = $_POST['password'];
        $r_password = $_POST['password_confirmation'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
        if($password & $r_password & $phone)
        {
            if(!preg_match($this->validate['password'],$password) & !preg_match($this->validate['password'],$r_password))
            {
                return response()->json(['warning' => '密码格式不正确']);
            }
            if(!preg_match($this->validate['phone'],$phone))
            {
                return response()->json(['warning' => '电话号码格式不正确']);
            }
            if($password === $r_password)
            {
                $user = User::find($id);
                $user->password = bcrypt($password);
                $user->phone = $phone;
                $bool = $user->save();
                if($bool)
                {
                    return response()->json(['success' => '保存成功']);
                }
                else
                {
                    return response()->json(['warning' => '保存失败']);
                }
            }
            else
            {
                return response()->json(['warning' => '两次密码不一致']);
            }
        }
        else
        {
            return response()->json(['warning' => '密码、电话不能为空']);
        }
    }

    public function personal()
    {
        $username = $_COOKIE['username'];
        $user = User::where('username','=',$username)->first();
        $tickets = Ticket::where('username','=',$username)->get();
//        dd($ticket);
        return view('user.personal',['tickets' => $tickets,'user' => $user]);
    }

    public function dropTicket(Request $request)
    {
        $index = 0;
        $ticketId = $request->ticketId;
        $ticket = Ticket::find($ticketId);
//        dd($ticket);
        $price = $ticket->price;
//        dd($price);
        $row = $ticket->row;
        $column = $ticket->column;
        $sId = $ticket->sId;
        $ticket->delete();
        $seat = Seat::where('row','=',$row)->where('column','=',$column)->first();
        $seat->status = $index;
        $bool = $seat->save();
        $username = $_COOKIE['username'];
        $user = User::where('username','=',$username)->first();
        $user->money = $user->money+$price;
        $user->save();
        if($bool && $user)
        {
           return 'success';
        }
        else
        {
            return 'fail';
        }



    }


}