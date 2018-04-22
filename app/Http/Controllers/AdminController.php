<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/10
 * Time: 14:01
 */

namespace App\Http\Controllers;



use App\model\Seat;
use App\model\User;
use App\model\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*z主要处理用户的信息*/
    private $validate = [
        'verifyCode'      =>  '/^[A-Za-z0-9]{4}$/u',                                    //4个字符的英文字符串
        'username'      =>  '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,20}$/u',                //3-20位的中文、英文、数字、下划线
        'password'      =>  '/^[A-Za-z0-9]{6,20}$/u',                              //6-20位的英文、数字
        'email'         =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/u',    //邮箱匹配
        'phone'         =>  '/^1[34578]\d{9}$/u',                                   //电话号码匹配
    ];

    public function userList()
    {
        $users = User::all();
        return view('admin.userList',['users' => $users]);
    }

    public function deleteUser()
    {
        $uId = $_POST['uId'];
//        dd($uId);
        $user = User::find($uId);
        $user->delete();
        return '1';
    }

    public function userEdit()
    {
        $uId = $_GET['uId'];
        $user = User::where('uid','=',$uId)->first();
//        dd($uId,$user);
        return view('admin.userEdit',['user' => $user]);

    }

//编辑用户信息后保存
    public function editUserInfo()
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

//创建用户
    public function createUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $r_password = $_POST['password_confirmation'];
        $phone = $_POST['phone'];

        if($username & $password & $r_password & $phone)
        {
            if(!preg_match($this->validate['username'],$username))
            {
                return response()->json(['warning' => '用户名格式不正确']);
            }
            if(!preg_match($this->validate['password'],$password) & !preg_match($this->validate['password'],$r_password))
            {
                return response()->json(['warning' => '密码格式不正确']);
            }
            if(!preg_match($this->validate['phone'],$phone))
            {
                return response()->json(['warning' => '电话号码格式不正确']);
            }
            $num = User::where('username','=',$username)->count();
            if($num)
            {
                return response()->json(['warning' => '用户名已存在']);
            }

            if($password === $r_password)
            {
                $password = bcrypt($password);
                $user = User::create([
                    'username' => $username,
                    'password' => $password,
                    'phone' => $phone,
                ]);
                if($user)
                {
                    return response()->json(['success' => '创建成功']);
                }
                else
                {
                    return response()->json(['warning' => '创建失败']);
                }
            }
            else
            {
                return response()->json(['warning' => '两次密码不一致']);
            }

        }
        else
        {
            return response()->json(['warning' => '用户名、密码、手机号码不能为空']);
        }

    }

    /*退票页面*/
    public function ticketList()
    {
        $tickets = Ticket::all();
        return view('admin.ticketList',['tickets' => $tickets]);
    }


    /*退票确认*/
    public  function adminDropTicket(Request $request)
    {
        $ticketId = $request->ticketId;
        $ticket = Ticket::find($ticketId);
        $username = $ticket->username;
        $price = $ticket->price;
        $sId = $ticket->sId;
        $row = $ticket->row;
        $column = $ticket->column;
        $ticket = $ticket->delete();
        $user = User::where('username','=',$username)->first();
        $user->money = $user->money+$price;
        $user = $user->save();
        $seat = Seat::where('sId','=',$sId)->where('row','=',$row)->where('column','=',$column)->first();
        $seat->status = 0;
        $seat = $seat->save();
        if($ticket && $user && $seat)
        {
            return 'success';
        }
        else
        {
            return 'fail';
        }

    }










}